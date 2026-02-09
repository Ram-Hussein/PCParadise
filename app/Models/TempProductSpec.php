<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempProductSpec extends Model
{
    /** @use HasFactory<\Database\Factories\TempProductSpecFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'spec_id',
        'value',
    ];
    public function spec(){
        return $this->belongsTo(Spec::class);
    }
    public function product(){
        return $this->belongsTo(TempProduct::class);
    }
}
