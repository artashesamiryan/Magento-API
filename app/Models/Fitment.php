<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitment extends Model
{
    use HasFactory;

    protected $fillable = ['part#', 'year', 'make', 'model', 'sub_model', 'engine', 'trim', 'notes', 'product_sku'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
