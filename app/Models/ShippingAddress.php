<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function shipping(){
        return $this->belongsTo(Shipping::class);
    }
}
