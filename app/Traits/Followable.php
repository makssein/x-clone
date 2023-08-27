<?php

namespace App\Traits;

use App\Models\User;

trait Followable
{
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows',
            'user_id', 'following_user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows',
            'following_user_id', 'user_id');
    }

    public function toggleFollow(User $user) {
        return $this->follows()->toggle($user);
    }


    public function isFollowing(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }
}
