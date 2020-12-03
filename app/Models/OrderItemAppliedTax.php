<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemAppliedTax extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function appliedTax(){
        return $this->belongsTo(OrderAppliedTax::class);
    }
}
