<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'seller_id',
        'Brand',
        'description',
        'price',
        'condition',
        'in_stock',
        'contact method',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function seller(){
        return $this->belongsTo(User::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function cartitems(){
        return $this->hasMany(CartItem::class);
    }
    public function favourites(){
        return $this->hasMany(Favourite::class);
    }
    public function ordertemss(){
        return $this->hasMany(OrderItem::class);
    }
    public function specs(){
        return $this->hasMany(ProductSpec::class);
    }


}
