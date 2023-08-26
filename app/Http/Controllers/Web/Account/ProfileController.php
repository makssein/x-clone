<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function render(User $user) {
        $profile_info = $user->profileInfo;
        return view('pages/account/profile', compact('user', 'profile_info'));
    }
}
