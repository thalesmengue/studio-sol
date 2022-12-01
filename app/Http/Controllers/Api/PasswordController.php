<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Rules\MinDigit;
use App\Rules\MinLowercase;
use App\Rules\MinSpecialCharacters;
use App\Rules\MinUppercase;
use App\Rules\NoRepeted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = Validator::make($request->only('password'), [
            'password' => [
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols(),
                    new MinLowercase, // password must contain at least one lowercase word
                    new MinUppercase, // password must contain at least one uppercase word
                    new NoRepeted // password must not contain two repeated words
            ],
        ]);

        if ($validated->fails()) {
            return response()->json([
                'verify' => false,
                'noMatch' => $validated->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'verify' => true,
            'noMatch' => [],
        ]);
    }
}
