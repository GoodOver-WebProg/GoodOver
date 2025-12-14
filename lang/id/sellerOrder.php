<?php

return [
    'title' => 'Manajemen Pesanan',

    'header' => [
        'title' => 'Manajemen Pesanan',
        'subtitle' => 'Kelola pesanan pending dan lihat riwayat.',
    ],

    'filter' => [
        'finished_only' => 'Hanya Pesanan Selesai',
        'pending_only' => 'Hanya Pesanan Pending',
        'all' => 'Semua Pesanan (Riwayat)',
    ],

    'sort' => [
        'latest' => 'Pesanan Terbaru',
        'oldest' => 'Pesanan Terlama',
    ],

    'table' => [
        'order_number' => 'Nomor Pesanan',
        'customer_name' => 'Nama Pelanggan',
        'product_name' => 'Nama Produk',
        'product_quantity' => 'Jumlah Produk',
        'order_date' => 'Tanggal Pesan',
        'order_time' => 'Waktu Pesan',
        'pickup_deadline' => 'Batas Ambil',
        'action' => 'Aksi',
        'empty' => 'Tidak ada pesanan.',
    ],

    'status' => [
        'finished' => 'Selesai',
    ],

    'action' => [
        'finish_order' => 'Selesaikan Pesanan',
    ],

    'modal' => [
        'title' => 'Selesaikan pesanan ini?',
        'body' => 'Pesanan :order akan ditandai selesai.',
        'cancel' => 'Batal',
        'confirm' => 'Konfirmasi',
    ],

    'pending_order_error' => 'Hanya pesanan dengan status "Pending" yang bisa diselesaikan',
    'finish_update_order' => 'Pesanan sudah ditandai selesai',
];
