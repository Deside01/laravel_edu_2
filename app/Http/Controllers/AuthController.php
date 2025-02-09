<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());

        return response()->json([
            'data' => [
                'user' => [
                    'name' => $user->getFullNameAttribute(),
                    'email' => $user->email,
                ],
                'code' => 201,
                'message' => 'Пользователь создан'
            ]
        ], 201);
    }

    /**
     * @throws AuthenticationException
     */
    public function authorization(AuthRequest $request)
    {
        if (auth()->attempt($request->validated())) {
            /** @var User $user */
            $user = auth()->user();

            return response()->json([
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->getFullNameAttribute(),
                        'birth_date' => $user->birth_date,
                        'email' => $user->email,
                    ],
                    'token' => $user->createToken('api')->plainTextToken,
                ]
            ]);
        }

        throw new AuthenticationException();
    }
    public function logout(): Response
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
