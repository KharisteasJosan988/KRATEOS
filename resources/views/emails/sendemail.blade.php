<!DOCTYPE html>
<html>

<head>
    <title>REGISTER KRATEOS</title>
</head>

<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; text-align:center">
    <h1 style="color: #333;">Halo, {{ $user->name }}</h1>
    <h2 style="color: #555;">Anda menerima email ini sebagai notifikasi bahwa Anda telah berhasil mendaftar di aplikasi
        KRATEOS.</h2>

    <p><a href="{{ route('auth.index', ['token' => $user->activation_token]) }}">Aktivasi Akun</a></p>

    <p style="color: #555;">Terima kasih telah bergabung dengan KRATEOS.</p>
</body>

</html>
