<?php

namespace Tests\Feature;

use App\Contracts\DescriptionImprover;
use App\Services\Ai\GeminiDescriptionImprover;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Tests\TestCase;

class AiDescriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_form_displays_the_ai_improvement_controls(): void
    {
        $business = collect(config('demo-businesses'))->first();

        $response = $this->get(route('quote.create', [
            'business' => $business['name'],
            'service' => $business['category'],
            'location' => $business['location'],
        ]));

        $response->assertOk();
        $response->assertSee('Improve with AI');
        $response->assertSee('maxlength="1500"', false);
        $response->assertSee(route('quote.improve-description'), false);
    }

    public function test_description_can_be_improved_without_submitting_a_quote(): void
    {
        $this->app->instance(DescriptionImprover::class, new class implements DescriptionImprover
        {
            public function improve(string $description): string
            {
                return 'The kitchen tap is leaking and needs to be inspected.';
            }
        });

        $response = $this->postJson(route('quote.improve-description'), [
            'description' => 'kitchen tap leaking',
        ]);

        $response
            ->assertOk()
            ->assertHeader('X-RateLimit-Limit', '10')
            ->assertHeader('X-RateLimit-Remaining', '9')
            ->assertJson([
                'description' => 'The kitchen tap is leaking and needs to be inspected.',
                'message' => 'Description improved. Review and edit it before continuing.',
            ]);

        $this->assertDatabaseCount('quote_requests', 0);
    }

    public function test_empty_description_is_rejected_without_using_the_provider(): void
    {
        $this->app->instance(DescriptionImprover::class, new class implements DescriptionImprover
        {
            public function improve(string $description): string
            {
                throw new RuntimeException('The provider should not be called.');
            }
        });

        $this->postJson(route('quote.improve-description'), ['description' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['description'])
            ->assertJsonPath('errors.description.0', 'Enter a job description before using AI.')
            ->assertHeader('X-RateLimit-Remaining', '9');
    }

    public function test_description_longer_than_the_quote_limit_is_rejected(): void
    {
        $this->app->instance(DescriptionImprover::class, new class implements DescriptionImprover
        {
            public function improve(string $description): string
            {
                return $description;
            }
        });

        $this->postJson(route('quote.improve-description'), [
            'description' => str_repeat('a', 1501),
        ])
            ->assertUnprocessable()
            ->assertJsonPath(
                'errors.description.0',
                'The job description must not exceed 1500 characters.',
            );
    }

    public function test_provider_failure_returns_a_safe_message(): void
    {
        $this->app->instance(DescriptionImprover::class, new class implements DescriptionImprover
        {
            public function improve(string $description): string
            {
                throw new RuntimeException('Secret provider failure details.');
            }
        });

        $this->postJson(route('quote.improve-description'), [
            'description' => 'pipe damaged',
        ])
            ->assertStatus(503)
            ->assertJsonMissing(['message' => 'Secret provider failure details.'])
            ->assertJsonPath(
                'message',
                'We could not improve the description right now. Your original text is still available, so please try again later.',
            )
            ->assertHeader('X-RateLimit-Remaining', '9');
    }

    public function test_provider_configuration_failure_returns_the_same_safe_message(): void
    {
        config()->set('ai.default_provider', 'unsupported-provider');

        $this->postJson(route('quote.improve-description'), [
            'description' => 'pipe damaged',
        ])
            ->assertStatus(503)
            ->assertJsonPath(
                'message',
                'We could not improve the description right now. Your original text is still available, so please try again later.',
            );
    }

    public function test_only_ten_improvement_requests_are_allowed_per_day(): void
    {
        $this->app->instance(DescriptionImprover::class, new class implements DescriptionImprover
        {
            public function improve(string $description): string
            {
                return 'Improved: '.$description;
            }
        });

        foreach (range(1, 10) as $attempt) {
            $this->postJson(route('quote.improve-description'), [
                'description' => "Attempt {$attempt}",
            ])->assertOk();
        }

        $this->postJson(route('quote.improve-description'), [
            'description' => 'Attempt 11',
        ])
            ->assertTooManyRequests()
            ->assertJson([
                'message' => "You have used today's 10 AI improvements. Please try again tomorrow.",
                'remaining' => 0,
            ]);
    }

    public function test_gemini_adapter_sends_the_api_key_in_a_header_and_reads_the_response(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'There is a damaged pipe under the sink, and water is leaking from it.'],
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $improver = new GeminiDescriptionImprover(
            apiKey: 'test-api-key',
            model: 'gemini-3.5-flash-lite',
            baseUrl: 'https://generativelanguage.googleapis.com/v1beta',
            timeoutSeconds: 15,
            maxOutputCharacters: 1500,
        );

        $result = $improver->improve('pipe damaged under sink water coming');

        $this->assertSame(
            'There is a damaged pipe under the sink, and water is leaking from it.',
            $result,
        );

        Http::assertSent(function ($request) {
            return $request->url() === 'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash-lite:generateContent'
                && $request->hasHeader('x-goog-api-key', 'test-api-key')
                && $request['contents'][0]['parts'][0]['text'] === 'pipe damaged under sink water coming'
                && str_contains(
                    $request['system_instruction']['parts'][0]['text'],
                    'Do not invent or assume',
                );
        });
    }
}
