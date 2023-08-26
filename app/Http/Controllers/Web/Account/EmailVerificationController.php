<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Notifications\Account\VerifyEmailNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller {
    public function notice() {
        return view('pages/account/verify-email');
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/');
    }

    public function send(Request $request) {
        $request->user()->notify(new VerifyEmailNotification);

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => 'Письмо отправлено на Вашу электронную почту.'
        ]);
    }
}
