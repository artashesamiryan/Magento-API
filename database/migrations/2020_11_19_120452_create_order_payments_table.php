<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('account_status')->nullable();
            $table->string('additional_information');
            $table->integer('amount_ordered');
            $table->integer('amount_paid');
            $table->integer('base_amount_ordered');
            $table->integer('base_amount_paid');
            $table->integer('base_shipping_amount');
            $table->integer('base_shipping_captured');
            $table->string('cc_last4')->nullable();
            $table->integer('entity_id');
            $table->string('method');
            $table->integer('parent_id');
            $table->integer('shipping_amount');
            $table->integer('shipping_captured');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_payments');
    }
}
