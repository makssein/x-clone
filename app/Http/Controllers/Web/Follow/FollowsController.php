<?php

namespace App\Http\Controllers\Web\Follow;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function follow(User $user) {
        auth()->user()->toggleFollow($user);

        return response()->json([
            'status' => true
        ]);
    }
}
