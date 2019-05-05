<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

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
            $table->string('name');
            $table->string('father_last_name');
            $table->string('mother_last_name');
            $table->string('curp')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('image_url')->default('profile-images/user-default.png');
            $table->bigInteger('id_school')->unsigned();
            $table->timestamps();
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
