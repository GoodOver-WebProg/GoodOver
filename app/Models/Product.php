<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'store_id',
        'image_path',
        'status',
        'total_quantity',
        'pickup_duration',
        'category_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the image URL, handling relative paths and storage paths
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }

        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        if (str_starts_with($this->image_path, 'images/') || str_starts_with($this->image_path, '/images/')) {
            $path = ltrim($this->image_path, '/');
            return asset($path);
        }

        if (str_starts_with($this->image_path, 'storage/') || str_starts_with($this->image_path, '/storage/')) {
            $path = ltrim($this->image_path, '/');
            return asset($path);
        }

        return asset('images/' . basename($this->image_path));
    }
}
