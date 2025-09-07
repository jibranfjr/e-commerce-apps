<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class VerifyEmailCustom extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', 
            Carbon::now()->addMinutes(60), 
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }

    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
                    ->markdown('emails.verify', [
                        'url' => $url,
                        'notifiable' => $notifiable
                    ]);
    }
}
