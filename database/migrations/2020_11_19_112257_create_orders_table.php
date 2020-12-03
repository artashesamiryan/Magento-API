<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('applied_rule_ids');
            $table->string('base_currency_code');
            $table->integer('base_discount_amount');
            $table->integer('base_discount_invoiced');
            $table->integer('base_grand_total');
            $table->integer('base_discount_tax_compensation_amount');
            $table->integer('base_discount_tax_compensation_invoiced');
            $table->integer('base_shipping_amount');
            $table->integer('base_shipping_discount_amount');
            $table->integer('base_shipping_discount_tax_compensation_amnt');
            $table->integer('base_shipping_incl_tax');
            $table->integer('base_shipping_invoiced');
            $table->integer('base_shipping_tax_amount');
            $table->integer('base_subtotal');
            $table->integer('base_subtotal_incl_tax');
            $table->integer('base_subtotal_invoiced');
            $table->integer('base_tax_amount');
            $table->integer('base_tax_invoiced');
            $table->integer('base_total_due');
            $table->integer('base_total_invoiced');
            $table->integer('base_total_invoiced_cost');
            $table->integer('base_total_paid');
            $table->integer('base_to_global_rate');
            $table->integer('base_to_order_rate');
            $table->bigInteger('billing_address_id');
            $table->date('created_at');
            $table->date('customer_dob');
            $table->string('customer_email');
            $table->string('customer_firstname');
            $table->integer('customer_gender');
            $table->integer('customer_group_id');
            $table->integer('customer_id');
            $table->integer('customer_is_guest');
            $table->string('customer_lastname');
            $table->integer('customer_note_notify');
            $table->integer('discount_amount');
            $table->integer('discount_invoiced');
            $table->integer('entity_id');
            $table->string('global_currency_code');
            $table->integer('grand_total');
            $table->integer('discount_tax_compensation_amount');
            $table->integer('discount_tax_compensation_invoiced');
            $table->integer('increment_id');
            $table->integer('is_virtual');
            $table->string('order_currency_code');
            $table->string('protect_code');
            $table->integer('quote_id');
            $table->integer('shipping_amount');
            $table->string('shipping_description');
            $table->integer('shipping_discount_amount');
            $table->integer('shipping_discount_tax_compensation_amount');
            $table->integer('shipping_incl_tax');
            $table->integer('shipping_invoiced');
            $table->integer('shipping_tax_amount');
            $table->string('state');
            $table->string('status');
            $table->string('store_currency_code');
            $table->integer('store_id');
            $table->string('store_name');
            $table->integer('store_to_base_rate');
            $table->integer('store_to_order_rate');
            $table->integer('subtotal');
            $table->integer('subtotal_incl_tax');
            $table->integer('subtotal_invoiced');
            $table->integer('tax_amount');
            $table->integer('tax_invoiced');
            $table->integer('total_due');
            $table->integer('total_invoiced');
            $table->integer('total_item_count');
            $table->integer('total_paid');
            $table->integer('total_qty_ordered');
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
        Schema::dropIfExists('orders');
    }
}
