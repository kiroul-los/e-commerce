<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'quantity',
        'price',
        'discount_price'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')
            ->withPivot('quantity', 'price', 'product_name', 'image')
            ->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
