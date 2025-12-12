<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerStore extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'contact',
        'opening_time',
        'closing_time',
        'image_path',
    ];
}
