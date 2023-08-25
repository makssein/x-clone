<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SignInRequest;
use App\Http\Requests\Account\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function signin(SignInRequest $request) {

        if(Auth::attempt($request->only('email', 'password'), $request->post('remember'))) {
            if(!Auth::user()->email_verified_at) {
                Auth::logout();
                return response()->json([
                    'status' => false,
                    'type' => "error",
                    'message' => 'Вам необходимо подтвердить адрес электронной почты.'
                ]);
            }

            return response()->json([
                'status' => true,
                'type' => "success",
                'message' => 'Вы успешно авторизовались.'
            ]);
        }

        return response()->json([
            'status' => false,
            'type' => "error",
            'message' => 'Пользователь с такими данными не найден.'
        ]);
    }

    public function signup(SignUpRequest $request) {
        $user = User::create($request->validated());

        if($user) {
            return response()->json([
                'status' => true,
                'type' => "success",
                'message' => 'Вы успешно зарегистрировались. Мы выслали письмо с дальнейшими действиями на Вашу почту.'
            ]);
        }

        return response()->json([
            'status' => false,
            'type' => "error",
            'message' => 'Произошла ошибка. Попробуйте еще раз.'
        ]);
    }
}
