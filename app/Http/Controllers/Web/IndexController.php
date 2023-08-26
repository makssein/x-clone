<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PostsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function render() {
        if(Auth::check()) {
            return Auth::user()->email_verified_at ?
                view('pages/home') :
                view('/pages/account/verify-email');
        }

        return view('index');
    }
}
