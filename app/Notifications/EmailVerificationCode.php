<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $code
    ) {}

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
            ->subject('Verification de votre adresse e-mai')
            ->greeting('Bonjour ' . $notifiable -> name . ' !')
            ->line('Voici votre pour vérifier votre compte sur TrashGL : ')
            ->line($this -> code)
            ->line('Ce code est valable pendant 05 minutes')
            ->line('Si vous n\'etes pas à l\'origine de cette demande, vous pouvez ignorez cet e-mal.')
            ->action('TrashGL', route('login.form'));
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
