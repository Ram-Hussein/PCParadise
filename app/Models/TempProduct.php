<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempProduct extends Model
{
    /** @use HasFactory<\Database\Factories\TempProductFactory> */
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
        return $this->hasMany(TempProductImage::class);
    }
    public function specs(){
        return $this->hasMany(ProductSpec::class);
    }
}
