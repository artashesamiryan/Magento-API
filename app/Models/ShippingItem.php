<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function shipping(){
        return $this->belongsTo(Shipping::class);
    }

    public function shippingOption(){
        return $this->hasMany(ShippingItemOption::class, 'item_id');
    }
}
