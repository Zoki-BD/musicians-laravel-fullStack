<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bands', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();


            $table->string('address',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('email',100)->nullable();


            $table->string('comment',1000)->nullable();
            $table->string('pictures',100)->nullable();


            $table->integer('id_cities')->nullable();
            $table->string('sex',2)->nullable();



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
        Schema::dropIfExists('bands');
    }
}
