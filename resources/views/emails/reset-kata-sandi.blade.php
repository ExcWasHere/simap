<!DOCTYPE html>
<html>

<head>
    <title>Reset Kata Sandi</title>
</head>

<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; text-align: justify">
    <h3 style="font-size: 24px">Halo {{ $name }},</h3>
    <h5 style="font-size: 16px; font-weight: normal">
        Anda menerima email ini karena kami menerima permintaan reset kata sandi untuk akun
        Anda. Tautan reset kata sandi ini akan kedaluwarsa dalam 24 jam. Jika Anda tidak meminta reset kata sandi,
        abaikan email ini.
    </h5>
    <a
        href="{{ url('reset-kata-sandi', ['token' => $token]) }}?nip={{ $nip }}"
        style="margin: 0 auto; background-color: #1a4167; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px"
    >
        Reset Kata Sandi
    </a>
    <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee">
    <h5 style="color: #666; font-size: 12px">
        © {{ date('Y') }} Direktorat Jenderal Bea dan Cukai. All rights reserved.
    </h5>
</body>

