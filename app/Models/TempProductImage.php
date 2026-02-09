<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\TempProductImageFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'is_main',
    ];

    public function product(){
        return $this->belongsTo(TempProduct::class);
    }
}
