<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\NewInfoRequest;
use App\Http\Requests\Account\NewPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function render() {
        return view('pages/account/settings');
    }

    public function newInfo(NewInfoRequest $request) {
        auth()->user()->username = $request->post('username');
        $save = auth()->user()->save();

        if($save) {
            return response()->json([
                'status' => true,
                'type' => 'success',
                'redirect' => auth()->user()->profileLink()
            ]);
        }

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Произошла ошибка. Попробуйте еще раз.'
        ]);
    }

    public function newPassword(NewPasswordRequest $request) {
        auth()->user()->password = Hash::make($request->post('new_password'));
        $save = auth()->user()->save();

        if($save) {
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => 'Пароль успешно обновлен.'
            ]);
        }

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Произошла ошибка. Попробуйте еще раз.'
        ]);
    }
}
