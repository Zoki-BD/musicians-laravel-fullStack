<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //racno se vnesuva ova se dola -inaku se kuca:
        // -php artisan make:migration update_users_table i na kraj  -php artisan migrate
        Schema::table('users', function (Blueprint $table) {
            $table->integer('deactivated')->default(0)->after('remember_token');
            $table->integer('deleted')->default(0)->after('remember_token');
            $table->integer('is_admin')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //ova kaj sportski go nema .vaka vidi mozda e najpravilno za da ako sakame da vratime po staro so rollback
        //ne sum siguren deka vaka se deklariraat -prover na net

//        Schema::table('users', function (Blueprint $table) {
//            $table->dropColumn('deactivated');
//            $table->dropColumn('deleted');
//            $table->dropColumn('is_admin');
//        });
    }
}
