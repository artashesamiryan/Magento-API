<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function orderItem(){
        return $this->belongsTo(OrderItem::class);
    }
}
