<?php

return [
    'title' => 'Order Management',

    'header' => [
        'title' => 'Order Management',
        'subtitle' => 'Handle pending orders and view history.',
    ],

    'filter' => [
        'finished_only' => 'Finished Order Only',
        'pending_only' => 'Pending Order Only',
        'all' => 'All Order (History)',
    ],

    'sort' => [
        'latest' => 'Latest Order',
        'oldest' => 'Oldest Order',
    ],

    'table' => [
        'order_number' => 'Order Number',
        'customer_name' => 'Customer Name',
        'product_name' => 'Product Name',
        'product_quantity' => 'Product Quantity',
        'order_date' => 'Order Date',
        'order_time' => 'Order Time',
        'pickup_deadline' => 'Pick up deadline',
        'action' => 'Action',
        'empty' => 'No orders found.',
    ],

    'status' => [
        'finished' => 'Finished',
    ],

    'action' => [
        'finish_order' => 'Finish Order',
    ],

    'modal' => [
        'title' => 'Finish this order?',
        'body' => 'Order :order will be marked as finished.',
        'cancel' => 'Cancel',
        'confirm' => 'Confirm',
    ],

    'pending_order_error' => 'Only pending orders can be finished.',
    'finish_update_order' => 'Order marked as finished.',
];
