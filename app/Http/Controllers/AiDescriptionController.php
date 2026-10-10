<?php

namespace App\Http\Controllers;

use App\Contracts\DescriptionImprover;
use App\Http\Requests\ImproveDescriptionRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class AiDescriptionController extends Controller
{
    public function __invoke(
        ImproveDescriptionRequest $request,
        DescriptionImprover $descriptionImprover,
    ): JsonResponse {
        try {
            $description = $descriptionImprover->improve(
                $request->validated()['description'],
            );
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => 'We could not improve the description right now. Your original text is still available, so please try again later.',
            ], 503);
        }

        return response()->json([
            'description' => $description,
            'message' => 'Description improved. Review and edit it before continuing.',
        ]);
    }
}
