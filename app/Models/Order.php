<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_address_id',
        'Total',
    ];
    public function address(){
        return $this->belongsTo(UserAddress::class);
    }
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function status(){
        return $this->hasOne(OrderStatus::class);
    }
}
