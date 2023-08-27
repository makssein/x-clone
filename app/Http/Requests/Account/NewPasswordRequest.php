<?php

namespace App\Http\Requests\Account;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class NewPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'current_password' => 'current_password',
            'new_password' => ['required', Password::min(8), 'confirmed', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'Текущий пароль',
            'new_password' => 'Новый пароль',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ":attribute является обязательным полем.",
            'min' => ':attribute должен быть минимум :min символов.',
            'max' => ':attribute может быть максимум :max символов.',
            'current_password' => ':attribute неверный.',
            'confirmed' => 'Пароли не совпадают.'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'type' => 'error',
            'message' => $validator->errors()->first()
        ]));

    }

    public function failedAuthorization(): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'type' => 'error',
            'message' => 'Вы не можете выполнить данное действие.'
        ]));
    }
}
