<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifikasi Email</title>
</head>
<body>
    <h1>Verifikasi Email Anda</h1>
    <p>
        Kami telah mengirim link verifikasi ke email Anda.
        Silakan cek email Anda untuk menyelesaikan proses registrasi.
    </p>

    @if (session('message'))
        <p style="color: green">{{ session('message') }}</p>
    @endif

    <form  class="mb-3" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Kirim Ulang Email Verifikasi</button>
    </form>
</body>
</html>