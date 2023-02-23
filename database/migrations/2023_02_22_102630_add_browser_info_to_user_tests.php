<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrowserInfoToUserTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('browser_info');
            $table->dropColumn('device_category');
        });
        Schema::table('user_tests', function (Blueprint $table) {
            $table->text('browser_info')->nullable()->after('total_points');
            $table->string('device_category')->nullable()->after('browser_info');
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
            $table->text('browser_info')->nullable()->after('active_languages');
            $table->string('device_category')->nullable()->after('browser_info');
        });
        Schema::table('user_tests', function (Blueprint $table) {
            $table->dropColumn('browser_info');
            $table->dropColumn('device_category');
        });
    }
}
