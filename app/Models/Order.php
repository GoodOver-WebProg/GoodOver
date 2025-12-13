<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * Atribut yang bisa diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'user_id',
        'store_id',
        'status',
        'order_number',
    ];

    /**
     * Relasi ke User (Setiap Order dimiliki oleh satu User).
     * Cara panggil: $order->user->name
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
