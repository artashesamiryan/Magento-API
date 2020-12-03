<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->integer('final_price');
            $table->integer('max_price');
            $table->integer('max_regular_price')->nullable();
            $table->integer('minimal_regular_price')->nullable();
            $table->integer('special_price')->nullable();
            $table->integer('minimal_price');
            $table->integer('regular_price');
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
        Schema::dropIfExists('prices');
    }
}
