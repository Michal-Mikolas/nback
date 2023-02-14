<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTestCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_test_cards', function(Blueprint $t){
            $t->integer('level')->nullable()->after('content');
            $t->string('if')->nullable()->after('clicked');
            $t->integer('next')->nullable()->after('if');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_test_cards', function(Blueprint $t){
            $t->dropColumn(['level', 'if', 'next']);
        });
    }
}
