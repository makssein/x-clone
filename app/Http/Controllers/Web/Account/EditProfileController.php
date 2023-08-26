<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\EditProfileRequest;
use App\Models\ProfileInfoModel;
use Illuminate\Http\Request;

class EditProfileController extends Controller {
    public function edit(EditProfileRequest $request) {
        $profile_info = ProfileInfoModel::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'bio' => $request->post('bio'),
                'link' => $request->post('link')
            ]
        );

        auth()->user()->name = $request->name;
        $save = auth()->user()->save();


        if($profile_info && $save) {
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
