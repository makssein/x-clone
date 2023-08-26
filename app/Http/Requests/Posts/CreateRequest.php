<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateRequest extends FormRequest
{
    public function authorize() : bool {
        return Auth::check();
    }

    public function rules(): array {
        return [
            'text' => 'required|min:5|max:255'
        ];
    }

    public function attributes() : array {
        return [
            'text' => 'Текст',
        ];
    }

    public function messages() : array {
        return [
            'required' => ":attribute является обязательным полем.",
            'min' => ':attribute должен быть минимум :min символов.',
            'max' => ':attribute может быть минимум :min символов.'
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
