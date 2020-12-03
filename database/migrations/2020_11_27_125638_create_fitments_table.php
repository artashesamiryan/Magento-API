<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fitments', function (Blueprint $table) {
            $table->id();
            $table->string('part#');
            $table->string('year');
            $table->string('make');
            $table->string('model');
            $table->string('sub_model')->nullable();
            $table->string('engine');
            $table->string('trim');
            $table->string('notes')->nullable();
            $table->string('product_sku');
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
        Schema::dropIfExists('fitments');
    }
}
