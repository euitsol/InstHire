<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class AdminResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = URL::route('admin.reset', ['token' => $this->token, 'email' => $notifiable->email]);

        Log::info('Reset URL: ' . $resetUrl);
        return (new MailMessage)
            ->subject('Admin Password Reset')
            ->line('Click the button below to reset your password:')
            ->action('Reset Password', $resetUrl)
            ->line('If you did not request a password reset, ignore this email.');
    }
}
