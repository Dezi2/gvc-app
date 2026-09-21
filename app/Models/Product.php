<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'image',
        'status',
    ];

    // A product belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A product can appear in many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper: is the product available?
    public function isInStock()
    {
        return $this->stock_quantity > 0 && $this->status === 'active';
    }
}