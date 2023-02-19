<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyBirthdateInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            DB::statement('TRUNCATE TABLE user_test_cards;');
            DB::statement('TRUNCATE TABLE user_tests;');
            DB::statement('TRUNCATE TABLE users;');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

            $table->dropColumn('birthdate');
            $table->integer('age')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->date('birthdate')->after('password');
        });
    }
}
