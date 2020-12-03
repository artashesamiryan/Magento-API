<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function address(){
        return $this->hasOne(ShippingAddress::class);
    }

    public function total(){
        return $this->hasOne(ShippingTotal::class);
    }

    public function items(){
        return $this->hasMany(ShippingItem::class);
    }
}
