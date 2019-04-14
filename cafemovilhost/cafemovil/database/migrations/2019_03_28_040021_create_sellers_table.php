<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //colums
            $table->bigIncrements('id');
            $table->string('id_at_school')->unique();
            $table->string('name')->nullable($value = false);
            $table->string('father_last_name')->nullable($value = false);
            $table->string('mother_last_name')->nullable($value = false);
            $table->string('curp')->unique()->nullable($value = false);
            $table->string('email')->unique()->nullable($value = false);
            $table->string('phone')->unique()->nullable($value = false);
            $table->timestamp('email_verified_at')->nullable($value = true);
            $table->boolean('status');
            $table->string('imag_url')->nullable($value = true);
            $table->timestamps();
            $table->bigInteger('id_school')->unsigned();
        });

        Schema::table('sellers', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_school')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
