<?php

use App\Models\Store;

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
    'failed' => 'Email atau password salah',


    'Messages' => [
        'required'    => 'Semua atribut wajib diisi',
        'email'       => 'Format email belum sesuai (harus mengandung @)',
        'min'         => ':Attribute minimal berisi :min karakter',
        'max'         => ':Attribute maksimal berisi :max karakter',
        'date_format' => 'Format waktu harus HH:MM',
        'mimes'       => 'File harus berupa jpg, jpeg, atau png',
        'in'          => 'Pilihan tidak valid',
        'alpha_num'   => ':Attribute hanya boleh huruf dan angka',
        'unique'      => ':Attribute sudah ada',
        'integer'     => ':Attribute harus berisi angka',
        'exists'      => ':Attribute belum terdaftar'
    ],

    'attributes' => [
        //user register
        'email'    => 'Email',
        'username' => 'Username',
        'password' => 'Password',

        //seller register
        'store_name'        => 'Nama toko',
        'store_address'     => 'Alamat toko',
        'store_contact'     => 'Kontak toko',
        'store_location'    => 'Lokasi toko',
        'opening_time'      => 'Jam buka',
        'closing_time'      => 'Jam tutup',
        'store_image_path'  => 'Foto profil toko',

        // add product
        'product_image_path'    => 'Foto produk',
        'product_name'          => 'Nama produk',
        'product_price'         => 'Harga produk',
        'product_description'   => 'Deskripsi produk',
        'product_status'        => 'Status produk',
        'product_total_quantity'=> 'Jumlah stok',
        'product_category'      => 'Kategori produk',
        'pickup_duration'       => 'Durasi pengambilan (menit)',
    ],
];
