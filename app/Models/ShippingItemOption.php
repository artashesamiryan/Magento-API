<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingItemOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function items(){
        return $this->belongsTo(ShippingItem::class);
    }
}
