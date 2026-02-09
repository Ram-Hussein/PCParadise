<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    /** @use HasFactory<\Database\Factories\SpecFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function products(){
        return $this->hasMany(ProductSpec::class);
    }
}
