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
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = Validator::make($request->only('password'), [
            'password' => [
                'min: 8',
                new MinDigit, // password must contain at least one digit
                new MinLowercase, // password must contain at least one lowercase word
                new MinUppercase, // password must contain at least one uppercase word
                new MinSpecialCharacters, // password must contain at least one special character
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
