<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->string('name')->nullable($value = false);
            $table->string('alias')->nullable();
            $table->string('campus')->nullable();
            $table->string('address')->nullable($value = false);
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        // Insert
        DB::table('schools')->insert(
            array(
                'name' => 'Instituto Tecnológico de Tijuana',
                'alias' => 'ITT',
                'campus' => 'Tomas Aquino',
                'address' =>  'Av Castillo de Chapultepec 562, Tomas Aquino, 22414 Tijuana, B.C.',
                'phone' => '6646078400',
                'email' => 'tomasaquino@tectijuana.com.mx'
            )
        );

        DB::table('schools')->insert(
            array(
                'name' => 'Universidad Autonoma de Baja California',
                'alias' => 'UABC',
                'campus' => 'Tijuana',
                'address' =>  'Universidad 14418, UABC, Parque Internacional Industrial Tijuana, 22427 Tijuana, B.C.',
                'phone' => '6649797500',
                'email' => 'tijuana@uabc.com.mx'
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
        Schema::dropIfExists('schools');
    }
}
