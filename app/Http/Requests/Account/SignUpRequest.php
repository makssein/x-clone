<?php

namespace App\Http\Requests\Account;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest {
    public function authorize() : bool {
        return !Auth::check();
    }

    public function rules(): array {
        return [
            'name' => 'required|min:3|string|max:255',
            'username' => 'required|min:3|max:25|unique:users,username|regex:/^[a-zA-Z0-9_.]*$/',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)]
        ];
    }

    public function attributes() : array {
        return [
            'email' => 'Адрес электронной почты',
            'password' => 'Пароль',
            'username' => 'Имя пользователя',
            'name' => 'Имя'
        ];
    }

    public function messages() : array {
        return [
            'required' => ":attribute является обязательным полем.",
            'unique' => ':attribute уже занят.',
            'email' => ':attribute должен быть в формате name@company.com.',
            'min' => ':attribute должен быть минимум :min символов.',
            'max' => ':attribute может быть минимум :max символов.',
            'regex' => ':attribute не удовлетворяет разрешенному формату.'
        ];
    }

    protected function failedValidation(Validator $validator) : void {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'type' => 'error',
            'message' => $validator->errors()->first()
        ]));

    }

    public function failedAuthorization() : void {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'type' => 'error',
            'message' => 'Вы не можете выполнить данное действие.'
        ]));
    }
}
