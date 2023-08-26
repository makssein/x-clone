<?php

namespace App\Notifications\Account;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function viaQueues(): array {
        return [
            'mail' => 'mails',
        ];
    }

}
