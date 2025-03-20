<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ 
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'price', 'category_id', 'description', 'images']; // ✅ Added description & images

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }
}