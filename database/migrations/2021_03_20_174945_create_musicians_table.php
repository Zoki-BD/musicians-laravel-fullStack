<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusiciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musicians', function (Blueprint $table) {
            $table->id();

            $table->string('name',100)->nullable();
            $table->string('surname',100)->nullable();
            $table->timestamp('date_birth')->nullable();

            $table->string('email',100)->nullable();

            $table->integer('id_instruments')->nullable();
            $table->integer('id_cities')->nullable();
            $table->integer('id_bands')->nullable();



            $table->string('sex',2)->nullable();
            $table->string('pictures',100)->nullable();
            $table->string('comment',1000)->nullable();

            $table->integer('deactivated')->default(0);
            $table->integer('deleted')->default(0);
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
        Schema::dropIfExists('musicians');
    }
}
