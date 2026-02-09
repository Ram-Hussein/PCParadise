<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function specs()
    {
        return $this->hasMany(Spec::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
