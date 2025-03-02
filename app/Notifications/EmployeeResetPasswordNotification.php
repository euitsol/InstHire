<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class EmployeeResetPasswordNotification extends Notification
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
        $resetUrl = URL::route('employee.reset', ['token' => $this->token, 'email' => $notifiable->email]);

        Log::info('Reset URL: ' . $resetUrl);
        return (new MailMessage)
            ->subject('Employee Password Reset')
            ->line('Click the button below to reset your password:')
            ->action('Reset Password', $resetUrl)
            ->line('If you did not request a password reset, ignore this email.');
    }
}
