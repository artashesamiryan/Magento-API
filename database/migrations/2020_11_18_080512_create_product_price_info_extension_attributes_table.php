<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceInfoExtensionAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price_info_extension_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('msrp_price');
            $table->string('is_applicable')->nullable();
            $table->boolean('is_shown_price_on_gesture');
            $table->string('msrp_message')->nullable();
            $table->text('explanation_message')->nullable();
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->foreign('tax_id')->references('id')->on('prices')->onDelete('set null')->onUpdate('set null');
            $table->unsignedBigInteger('product_info_id');
            $table->foreign('product_info_id')->references('id')->on('product_price_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_price_info_extension_attributes');
    }
}
