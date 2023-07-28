<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel
    protected $table = 'cart_items';

    // Mendefinisikan atribut yang dapat diisi
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'subtotal',
    ];

    // Mendefinisikan relasi many-to-one dengan model Product
    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    // Mendefinisikan relasi many-to-one dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
