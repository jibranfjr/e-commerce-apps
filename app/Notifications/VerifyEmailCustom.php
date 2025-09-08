<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class VerifyEmailCustom extends VerifyEmailBase
{
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verifikasi Akunmu di Toko Permata Puri Bali 🚀')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Terima kasih sudah mendaftar. Klik tombol di bawah untuk verifikasi email kamu:')
            ->action('Verifikasi Sekarang', $this->verificationUrl($notifiable))
            ->line('Kalau kamu tidak merasa daftar, abaikan email ini.')
            ->salutation('Salam hangat, Tim Toko Permata Puri Bali 🛒');
    }
}
