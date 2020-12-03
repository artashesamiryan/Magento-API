<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceInfo extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function prices()
    {
        return $this->belongsTo(Price::class, 'price_info_id');
    }

    public function extensionAttributes(){
        return $this->hasOne(ProductPriceInfoExtensionAttribute::class, 'product_info_id');
    }
}
