<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'opening_time',
        'closing_time',
        'image_path',
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
