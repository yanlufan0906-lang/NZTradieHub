<?php

namespace App\Providers;

use App\Contracts\DescriptionImprover;
use App\Services\Ai\GeminiDescriptionImprover;
use App\Services\Ai\UnavailableDescriptionImprover;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DescriptionImprover::class, function () {
            $provider = config('ai.default_provider');

            return match ($provider) {
                'gemini' => new GeminiDescriptionImprover(
                    apiKey: (string) config('ai.providers.gemini.api_key'),
                    model: (string) config('ai.providers.gemini.model'),
                    baseUrl: (string) config('ai.providers.gemini.base_url'),
                    timeoutSeconds: (int) config('ai.description.timeout_seconds'),
                    maxOutputCharacters: (int) config('ai.description.max_characters'),
                ),
                default => new UnavailableDescriptionImprover((string) $provider),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('ai-description', function (Request $request) {
            $dailyLimit = max(1, (int) config('ai.description.daily_limit', 10));
            $userIdentifier = $request->user()?->getAuthIdentifier();
            $limiterKey = $userIdentifier
                ? "user:{$userIdentifier}"
                : "ip:{$request->ip()}";

            return Limit::perDay($dailyLimit)
                ->by($limiterKey)
                ->response(fn (Request $request, array $headers) => response()->json([
                    'message' => "You have used today's {$dailyLimit} AI improvements. Please try again tomorrow.",
                    'remaining' => 0,
                ], 429, $headers));
        });
    }
}
