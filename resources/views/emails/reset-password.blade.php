<!DOCTYPE html>
<html>

<head>
    <title>Reset Kata Sandi</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333">
    <main style="max-width: 600px; margin: 0 auto; padding: 20px">
        <h2 style="color: #1a4167">Reset Kata Sandi</h2>

        <p>Halo {{ $name }},</p>

        <p>Anda menerima email ini karena kami menerima permintaan reset kata sandi untuk akun Anda.</p>

        <a
            href="{{ url('reset-kata-sandi', ['token' => $token]) }}?nip={{ $nip }}"
            style="margin: 30px 0; background-color: #1a4167; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px"
        >
            Reset Kata Sandi
        </a>
        <h5>Tautan reset kata sandi ini akan kedaluwarsa dalam 24 jam.</h5>
        <h5>Jika Anda tidak meminta reset kata sandi, abaikan email ini.</h5>
        <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">
        <h5 style="color: #666; font-size: 12px">
            © {{ date('Y') }} Direktorat Jenderal Bea dan Cukai. All rights reserved.
        </h5>
    </main>
</body>