<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBillingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('address_type');
            $table->string('city');
            $table->string('country_id');
            $table->integer('customer_address_id');
            $table->string('email');
            $table->integer('entity_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('parent_id');
            $table->string('postcode');
            $table->string('region');
            $table->string('region_code');
            $table->integer('region_id');
            $table->string('street');
            $table->string('telephone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_billing_addresses');
    }
}
