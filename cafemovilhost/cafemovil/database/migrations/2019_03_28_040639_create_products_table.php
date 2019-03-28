<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->string('name')->nullable($value = false);
            $table->string('unit_price')->nullable($value = false);
            $table->string('description')->nullable($value = false);
            $table->string('imag_url')->nullable($value = false);
            $table->timestamps();
            $table->bigInteger('id_seller')->unsigned();
        });

        Schema::table('products', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_seller')->references('id')->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
