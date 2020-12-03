<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function extensionAttribute()
    {
        return $this->hasOne(ProductPriceInfoExtension::class, 'tax_id');
    }

    public function productPriceInfo()
    {
        return $this->hasOne(ProductPriceInfo::class, 'price_info_id');
    }
}
