<?php

return [
    'page_title' => 'Status Pesanan - GoodOver',

    'header' => [
        'title' => 'Status Pesanan',
        'subtitle' => 'Pantau detail pesanan dan batas waktu pengambilan.',
    ],

    'order_number' => 'Nomor Pesanan',
    'status' => [
        'pending' => 'Pending',
        'finished' => 'Selesai',
        'canceled' => 'Dibatalkan',
    ],

    'fields' => [
        'product' => 'Produk',
        'quantity' => 'Jumlah',
        'total_price' => 'Total Harga',
        'order_time' => 'Waktu Pesan',
        'pickup_deadline' => 'Batas Ambil',
        'deadline_hint' => 'Deadline dihitung dari waktu order + pickup duration produk.',
    ],

    'actions' => [
        'back' => 'Kembali',
        'go_history' => 'Ke Riwayat',
    ],
];
