@component('mail::message')
# Akun Teregistrasi

Selamat! Akun SIMOL Anda telah teregistrasi. <br>
Silahkan Login Melalui tombol di bawah
@component('mail::button', ['url' => $url, 'color' => 'success'])
Login
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent