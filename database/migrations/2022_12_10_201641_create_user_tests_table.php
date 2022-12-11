<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests', function (Blueprint $t) {
            $t->id();

            $t->foreignId('user_id')->constrained();
            $t->smallInteger('is_main_test');

            $t->integer('total_symbols')->nullable();
            $t->integer('total_same')->nullable();
            $t->integer('clicked_same')->nullable();
            $t->integer('passed_same')->nullable();
            $t->integer('total_ordinary')->nullable();
            $t->integer('clicked_ordinary')->nullable();
            $t->integer('passed_ordinary')->nullable();
            $t->integer('total_points')->nullable();

            $t->timestamps();
        });

        Schema::create('user_test_cards', function (Blueprint $t) {
            $t->id();

            $t->foreignId('user_test_id')->constrained();
            $t->string('type');
            $t->text('content');
            $t->smallInteger('same');
            $t->string('badge')->nullable();
            $t->smallInteger('clicked')->default('0');

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_test_cards');
        Schema::dropIfExists('user_tests');
    }
}
