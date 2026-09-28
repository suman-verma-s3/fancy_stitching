<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'price',
        'cost_price',
        'selling_price',
        'stock',
        'low_stock_limit',
        'image',
        'description',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'stock' => 'integer',
        'low_stock_limit' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}