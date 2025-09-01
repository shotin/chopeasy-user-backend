<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // $redirect = 'http://localhost:5173/login';
        $redirect = 'https://chopwells.netlify.app/login';

        $verificationUrl = route('auth.verify.email', [
            'id' => $this->user->id,
            'token' => sha1($this->user->email)
        ]) . '?redirect=' . urlencode($redirect);

        return (new MailMessage)
            ->subject('Verify Your Email')
            ->view('verify_email', [
                'user' => $this->user,
                'verificationUrl' => $verificationUrl
            ]);
    }
}
