<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBorrowsColumnToMaterialCopies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materials_copies', function (Blueprint $table) {
            $table->foreignId('borrows_id')->nullable()->default(NULL)->after('materials_id');
            $table->foreign('borrows_id')->references('id')->on('borrowings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('borrows_id');
    }
}
