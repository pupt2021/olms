<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timein', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->dateTime('timein')->nullable()->default(NULL);
            $table->dateTime('timeout')->nullable()->default(NULL);
            $table->integer('status')->nullable()->default(NULL);

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timein');
        $table->dropForeign('users_id');
    }
}
