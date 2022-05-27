<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_copies', function (Blueprint $table) {
            $table->id('material_copy_id');
            $table->foreignId('materials_id');
            $table->string('accession_number')->unique();
            $table->date('date_recieved');
            $table->tinyInteger('is_available')->nullable()->default(1);

            $table->foreign('materials_id')->references('materials_id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials_copies');
        $table->dropForeign('materials_id');
    }
}
