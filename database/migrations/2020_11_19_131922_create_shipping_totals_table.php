<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_totals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('base_shipping_amount');
            $table->integer('base_shipping_discount_amount');
            $table->integer('base_shipping_discount_tax_compensation_amnt');
            $table->integer('base_shipping_incl_tax');
            $table->integer('base_shipping_invoiced');
            $table->integer('base_shipping_refunded')->nullable();
            $table->integer('base_shipping_tax_amount');
            $table->integer('base_shipping_tax_refunded')->nullable();
            $table->integer('shipping_amount');
            $table->integer('shipping_discount_amount');
            $table->integer('shipping_discount_tax_compensation_amount');
            $table->integer('shipping_incl_tax');
            $table->integer('shipping_invoiced');
            $table->integer('shipping_refunded')->nullable();
            $table->integer('shipping_tax_amount');
            $table->integer('shipping_tax_refunded')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_totals');
    }
}
