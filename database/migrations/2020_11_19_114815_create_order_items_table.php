<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('amount_refunded');
            $table->integer('applied_rule_ids');
            $table->integer('base_amount_refunded');
            $table->integer('base_discount_amount');
            $table->integer('base_discount_invoiced');
            $table->integer('base_discount_tax_compensation_amount');
            $table->integer('base_discount_tax_compensation_invoiced');
            $table->integer('base_original_price');
            $table->integer('base_price');
            $table->integer('base_price_incl_tax');
            $table->integer('base_row_invoiced');
            $table->integer('base_row_total');
            $table->integer('base_row_total_incl_tax');
            $table->integer('base_tax_amount');
            $table->integer('base_tax_invoiced');
            $table->date('created_at');
            $table->integer('discount_amount');
            $table->integer('discount_invoiced');
            $table->integer('discount_percent');
            $table->integer('free_shipping');
            $table->integer('discount_tax_compensation_amount');
            $table->integer('discount_tax_compensation_invoiced');
            $table->boolean('is_qty_decimal');
            $table->integer('item_id');
            $table->string('name');
            $table->boolean('no_discount');
            $table->integer('original_price');
            $table->integer('price');
            $table->integer('price_incl_tax');
            $table->bigInteger('product_id')->nullable();
            $table->string('product_type');
            $table->boolean('qty_canceled');
            $table->boolean('qty_invoiced');
            $table->boolean('qty_ordered');
            $table->boolean('qty_refunded');
            $table->boolean('qty_shipped');
            $table->integer('row_invoiced');
            $table->integer('row_total');
            $table->integer('row_total_incl_tax');
            $table->integer('row_weight');
            $table->string('sku');
            $table->integer('store_id');
            $table->integer('tax_amount');
            $table->integer('tax_invoiced');
            $table->integer('tax_percent');
            $table->date('updated_at');
            $table->integer('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
