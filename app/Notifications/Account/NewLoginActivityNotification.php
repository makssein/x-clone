<?php

namespace App\Notifications\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLoginActivityNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Привет, @$notifiable->username!")
            ->subject('Новый вход в аккаунт!')
            ->line('В Ваш аккаунт был выполнен вход. Если это были не Вы, перейдите по ссылке и измените пароль!')
            ->action('Настройки', route('settings.settings'))
            ->salutation('Спасибо, что используете наш сайт!');
    }

    public function viaQueues(): array {
        return [
            'mail' => 'mails',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
