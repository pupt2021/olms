<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookExtensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_extension', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrowings_id');
            $table->foreignId('users_id');
            $table->tinyInteger('status')->nullable()->default(0);

            $table->foreign('borrowings_id')->references('id')->on('borrowings');
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
        Schema::dropIfExists('book_extension');
        $table->dropForeign('borrowings_id');
        $table->dropForeign('users_id');
    }
}
