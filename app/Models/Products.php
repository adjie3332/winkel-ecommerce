<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected  $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Mendefinisikan relasi one-to-many dengan model CartItem
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
