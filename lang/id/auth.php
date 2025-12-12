<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'sign_up' => 'Daftarkan akun mu',
    'sub_1' => 'Dan mulai eksplorasi mu di GoodOver',
    'agree_text' => 'Dengan melanjutkan, Anda menyetujui :privacy_link dan :terms_link GoodOver.',
    'privacy_policy' => 'Kebijakan Privasi',
    'terms' => 'Syarat dan Ketentuan',
    'account_reminder' => 'Sudah mempunyai akun?',

    'login' => 'Login ke akun mu',
    'sub_2' => 'Dan lanjutkan perjalanan mu di GoodOver',
    'register_reminder' => 'Belum mempunyai akun?',


    'registerMessages' => [
        'required'    => 'Semua atribut wajib diisi',
        'email'       => 'Format email belum sesuai (harus mengandung @)',
        'min'         => ':Attribute minimal berisi :min karakter',
        'date_format' => 'Format waktu harus HH:MM',
        'mimes'       => 'File harus berupa jpg, jpeg, atau png',
        'in'          => 'Pilihan tidak valid',
        'alpha_num'   => ':Attribute hanya boleh huruf dan angka',
        'unique'      => ':Attribute have already been taken',
    ],

    'attributes' => [
        //user register
        'email'    => 'Email',
        'username' => 'Username',
        'password' => 'Password',

        //seller register
        'name'         => 'Nama toko',
        'address'      => 'Alamat toko',
        'contact'      => 'Kontak toko',
        'location'     => 'Lokasi toko',
        'opening_time' => 'Jam buka',
        'closing_time' => 'Jam tutup',
        'image_path'   => 'Foto profil toko',
    ],
];
