<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'image',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The product that belongs to the cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
