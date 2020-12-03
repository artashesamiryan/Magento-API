<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function priceInfo()
    {
        return $this->hasOne(ProductPriceInfo::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function fitment(){
        return $this->hasOne(Fitment::class);
    }
}
