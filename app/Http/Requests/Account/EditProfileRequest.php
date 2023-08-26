<?php

namespace App\Http\Requests\Account;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class EditProfileRequest extends FormRequest
{
    public function authorize() : bool {
        return Auth::check();
    }

    public function rules(): array {
        return [
            'name' => 'required|min:3|string|max:255',
            'bio' => 'nullable|string|min:5|max:255',
            'link' => 'nullable|active_url'
        ];
    }

    public function attributes() : array {
        return [
            'name' => 'Имя',
            'bio' => 'Описание',
            'link' => 'Ссылка'
        ];
    }

    public function messages() : array {
        return [
            'required' => ":attribute является обязательным полем.",
            'min' => ':attribute должен быть минимум :min символов.',
            'string' => ':attribute должен быть строкой.',
            'max' => ':attribute может быть максимум :max символов.',
            'active_url' => ':attribute должна быть рабочей ссылкой.'
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
