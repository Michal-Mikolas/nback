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
        Schema::table('users', function(Blueprint $t){
            $t->integer('lang_level')->after('password');
            $t->string('sex')->after('birthdate');
            $t->text('browser_info')->nullable()->after('active_languages');
            $t->text('device_category')->nullable()->after('browser_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $t){
            $t->dropColumn(['lang_level', 'sex', 'browser_info', 'device_category']);
        });
    }
}
