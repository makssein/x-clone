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
            'website' => 'nullable|active_url',
            'banner' => 'nullable|image|max:5120|mimes:jpg,png',
            'avatar' => 'nullable|image|max:5120|mimes:jpg,png',
            'delete_banner' => 'sometimes'
        ];
    }

    public function attributes() : array {
        return [
            'name' => 'Имя',
            'bio' => 'Описание',
            'website' => 'Ссылка',
            'banner' => 'Баннер',
            'avatar' => 'Аватар'
        ];
    }

    public function messages() : array {
        return [
            'required' => ":attribute является обязательным полем.",
            'name.min' => ':attribute должен быть минимум :min символов.',
            'string' => ':attribute должен быть строкой.',
            'name.max' => ':attribute может быть максимум :max символов.',
            'active_url' => ':attribute должна быть рабочей ссылкой.',
            'image' => ':attribute должен быть изображением.',
            'banner.max' => ':attribute может быть максимум :max КБ',
            'avatar.max' => ':attribute может быть максимум :max КБ',
            'mimes' => ':attribute может быть только в формате PNG, JPG.'
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
