<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileInfoModel extends Model
{
    protected $table = 'profile_info';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'bio',
        'link'
    ];


}
