<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',
        'is_primary',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    // Relations
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessors
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            Storage::delete($image->path);
        });
    }
}