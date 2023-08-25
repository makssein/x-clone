<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;

class SignInRequest extends FormRequest {
    public function authorize() : bool {
        return !Auth::check();
    }

    protected function prepareForValidation(){
        $this->merge([
            'remember' => (bool) $this->active,
        ]);
    }

    public function rules(): array {
        return [
            'email' => 'required|email',
            'password' => ['required', Password::min(8)],
            'remember' => 'nullable|boolean'
        ];
    }

    public function attributes() : array {
        return [
            'email' => 'Адрес электронной почты',
            'password' => 'Пароль'
        ];
    }

    public function messages() : array {
        return [
            'required' => ":attribute является обязательным полем.",
            'email' => ':attribute должен быть в формате name@company.com.',
            'min' => ':attribute должен быть минимум :min символов.'
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
