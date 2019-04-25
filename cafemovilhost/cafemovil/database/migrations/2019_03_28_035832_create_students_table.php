<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
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
            $table->string('image_name')->nullable($value = false)->default('user-default.png');
            $table->timestamps();
            $table->bigInteger('id_school')->unsigned();
        });

        Schema::table('students', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_school')->references('id')->on('schools');
        });

        DB::table('students')->insert(
            array(
                'id_at_school' => '16211958',
                'name' => 'Pablo',
                'father_last_name' => 'Aguiar',
                'mother_last_name' => 'Solis',
                'curp' => 'AUSP980730HBCGLB00',
                'email' => 'paguiar_student@uwu.com',
                'phone' => '6644437802',
                'id_school' => 1
            )
        );

        DB::table('users')->insert(
            array(
                'email' => 'paguiar_student@uwu.com',
                'password' => Hash::make($request->input('password')),
                'status' => false,
                'id_user_type' => 3
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
        Schema::dropIfExists('students');
    }
}
