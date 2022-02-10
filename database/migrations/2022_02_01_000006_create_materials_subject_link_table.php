<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsSubjectLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_subject_link', function (Blueprint $table) {
            $table->foreignid('mat_id');
            $table->foreignId('sub_id');
            $table->foreign('mat_id')->references('materials_id')->on('materials');
            $table->foreign('sub_id')->references('id')->on('materials_subject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials_subject_link');
        $table->dropForeign('mat_id');
        $table->dropForeign('sub_id');
    }
}
