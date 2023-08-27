<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SignInRequest;
use App\Http\Requests\Account\SignUpRequest;
use App\Models\User;
use App\Notifications\Account\VerifyEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function signin(SignInRequest $request) {

        if(Auth::attempt($request->only('email', 'password'), $request->post('remember'))) {
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

    public function signup(SignUpRequest $request)
    {
        $user = User::create($request->validated());

        if ($user) {
            Auth::login($user);
            $user->notify(new VerifyEmailNotification);

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

    public function logout() {
        Auth::logout();

        return redirect('/');
    }
}
