@component('mail::message')
{{-- Header Logo --}}
<div style="text-align:center;margin-bottom:25px;">
</div>

{{-- Greeting --}}
<h2 style="font-weight:600; color:#333;">Halo {{ $notifiable->name }},</h2>

<p style="font-size:16px; color:#555; line-height:1.5;">
Terima kasih telah mendaftar di <strong>Toko Permata Puri Bali</strong>. Silakan klik tombol di bawah untuk memverifikasi email Anda.
</p>

{{-- Verifikasi Button --}}
@component('mail::button', ['url' => $url, 'color' => 'success'])
Verifikasi Email
@endcomponent

<p style="font-size:14px; color:#888; margin-top:20px;">
Jika tombol di atas tidak berfungsi, salin dan tempel link berikut ke browser Anda:
<br>
<a href="{{ $url }}" style="color:#1a73e8;">{{ $url }}</a>
</p>

{{-- Footer --}}
<p style="font-size:14px; color:#aaa; margin-top:30px; text-align:center;">
Terima kasih,<br>
Toko Permata Puri Bali
</p>
@endcomponent