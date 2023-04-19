<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddInterruptionToUserTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_tests', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            DB::statement('TRUNCATE TABLE user_test_cards;');
            DB::statement('TRUNCATE TABLE user_tests;');
            DB::statement('TRUNCATE TABLE users;');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

            $table->smallInteger('interruption')->after('total_points');
            $table->text('interruption_reason')->nullable()->after('interruption');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_tests', function (Blueprint $table) {
            $table->dropColumn('interruption');
            $table->dropColumn('interruption_reason');
        });
    }
}
