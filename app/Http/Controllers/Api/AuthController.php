<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Регистрация пользователя
    public function register(RegisterRequest $request)
    {
        // Извлекаем role_id для роли 'Пользователь'
        $role_id = Role::where('code', 'user')->first()->id;

        // Извлекаем валидированные данные
        $validated = $request->validated();

        // Создаем нового пользователя
        $user = User :: create([ ... $validated, 'role_id' => $role_id]);

        // Создание токена для пользователя
        $token = $user->createToken('token')->plainTextToken;

        // Возвращаем ответ с токеном
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ])->setStatusCode(201);

    }

    // Авторизация

    // Выход
}
