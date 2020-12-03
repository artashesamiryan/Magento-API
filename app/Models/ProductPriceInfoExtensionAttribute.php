<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceInfoExtensionAttribute extends Model
{
    use HasFactory;

    public function tax()
    {
        return $this->belongsTo(Price::class, 'tax_id');
    }

    public function priceInfo(){
        return $this->belongsTo(ProductPriceInfo::class, 'product_info_id');
    }
}
