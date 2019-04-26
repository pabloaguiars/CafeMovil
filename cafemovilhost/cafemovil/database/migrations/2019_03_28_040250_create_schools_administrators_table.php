<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateSchoolsAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools_administrators', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->string('id_at_school')->unique();
            $table->string('name')->nullable($value = false);
            $table->string('father_last_name')->nullable($value = false);
            $table->string('mother_last_name')->nullable($value = false);
            $table->string('curp')->unique()->nullable($value = false);
            $table->string('email')->unique()->nullable($value = false);
            $table->string('phone')->unique()->nullable($value = false);
            $table->timestamp('email_verified_at')->nullable($value = true);
            $table->string('image_url')->nullable($value = false)->default('user-default.png');
            $table->timestamps();
            $table->bigInteger('id_school')->unsigned();
        });

        Schema::table('schools_administrators', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_school')->references('id')->on('schools');
        });

        DB::table('schools_administrators')->insert(
            array(
                'id_at_school' => '1958',
                'name' => 'Pablo',
                'father_last_name' => 'Aguiar',
                'mother_last_name' => 'Solis',
                'curp' => 'AUSP980730HBCGLB00',
                'email' => 'paguiar_school_administrator@uwu.com',
                'phone' => '6644437802',
                'id_school' => 1
            )
        );

        DB::table('users')->insert(
            array(
                'email' => 'paguiar_school_administrator@uwu.com',
                'password' => Hash::make('password'),
                'status' => false,
                'id_user_type' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools_administrators');
    }
}
