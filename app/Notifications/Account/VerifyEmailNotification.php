<?php

namespace App\Notifications\Account;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function viaQueues(): array {
        return [
            'mail' => 'mails',
        ];
    }

    public function toMail($notifiable) {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->greeting("Привет, @$notifiable->username!")
            ->subject('Подтверждение регистрации! | Y.com')
            ->line('Используйте действие ниже, чтобы подтвердить регистрацию.')
            ->action('Подтвердить почту', $verificationUrl)
            ->salutation('Спасибо за регистрацию на нашем сайте!');
    }

}
