<?php

return [
    'page_title' => 'Order Status - GoodOver',

    'header' => [
        'title' => 'Order Status',
        'subtitle' => 'View order details and pickup deadline.',
    ],

    'order_number' => 'Order Number',
    'status' => [
        'pending' => 'Pending',
        'finished' => 'Finished',
        'canceled' => 'Canceled',
    ],

    'fields' => [
        'product' => 'Product',
        'quantity' => 'Quantity',
        'total_price' => 'Total Price',
        'order_time' => 'Order Time',
        'pickup_deadline' => 'Pickup Deadline',
        'deadline_hint' => 'Deadline is calculated from order time + product pickup duration.',
    ],

    'actions' => [
        'back' => 'Back',
        'go_history' => 'Go to History',
    ],
];
