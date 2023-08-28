<?php

namespace App\Http\Controllers\Web\Follow;

use App\Http\Controllers\Controller;
use App\Models\User;

class FollowsController extends Controller
{
    public function follow(User $user) {
        if(auth()->user()->is($user)) { //нельзя подписаться на себя же
            return response()->json([
                'status' => true
            ]);
        }

        auth()->user()->toggleFollow($user);

        return response()->json([
            'status' => true
        ]);
    }
}
