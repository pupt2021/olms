<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_reservation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('material_copy_id');
            $table->tinyInteger('status')->default(0);

            $table->foreign('material_copy_id')->references('material_copy_id')->on('materials_copies');
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
