<?php

namespace App\Models;

use App\Traits\Followable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'banner'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function feed() {
        $ids = $this->follows->pluck('id');
        $ids->push($this->id);

        return PostsModel::whereIn('user_id', $ids)->latest()->with('user')->get();
    }

    public function posts() {
        return $this->hasMany(PostsModel::class)->with('user')->latest();
    }

    public function profileLink() {
        return route('profile.profile', $this->username);
    }

    public function getAvatarLink() {
        return url('/storage/'.$this->avatar);
    }

    public function getBannerLink() {
        return url('/storage/'.$this->banner);
    }
}
