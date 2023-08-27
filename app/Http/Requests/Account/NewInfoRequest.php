<?php

namespace App\Http\Requests\Account;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NewInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'min:3', 'max:25', Rule::unique('users')->ignore(auth()->user()), 'regex:/^[a-zA-Z0-9_.]*$/'],
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => 'Имя пользователя',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ":attribute является обязательным полем.",
            'unique' => ':attribute уже занято.',
            'min' => ':attribute должен быть минимум :min символов.',
            'max' => ':attribute может быть максимум :max символов.',
            'regex' => ':attribute не удовлетворяет разрешенному формату.'
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
