<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function billingAddress(){
        return $this->hasOne(OrderBillingAddress::class);
    }

    public function payment(){
        return $this->hasOne(OrderPayment::class);
    }

    public function shipping(){
        return $this->hasOne(Shipping::class);
    }

    public function paymentInfo(){
        return $this->hasMany(OrderPaymentInfo::class);
    }

    public function appliedTaxes(){
        return $this->hasMany(OrderAppliedTax::class);
    }

    public function itemAppliedTaxes(){
        return $this->hasMany(OrderItemAppliedTax::class);
    }
}
