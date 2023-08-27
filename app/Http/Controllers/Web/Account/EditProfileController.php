<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\EditProfileRequest;
use App\Models\ProfileInfoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditProfileController extends Controller {
    public function edit(EditProfileRequest $request) {
        auth()->user()->name = $request->post('name');
        auth()->user()->bio = $request->post('bio');
        auth()->user()->website = $request->post('website');

        if($request->hasFile('avatar')) {
            auth()->user()->avatar = $request->file('avatar')->store('avatars');
        }

        if($request->hasFile('banner')) {
            auth()->user()->banner = $request->file('banner')->store('banners');
        }

        if($request->has('delete_banner')) {
            if(auth()->user()->banner) {
                Storage::disk('public')->delete(auth()->user()->banner);
            }

            auth()->user()->banner = null;
        }

        $save = auth()->user()->save();

        if($save) {
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => 'Данные успешно сохранены.'
            ]);
        }

        return response()->json([
            'status' => false,
            'type' => 'error',
            'message' => 'Произошла ошибка. Попробуйте еще раз.'
        ]);
    }
}
