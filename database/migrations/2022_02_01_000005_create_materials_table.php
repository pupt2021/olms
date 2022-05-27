<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id('materials_id');
            $table->foreignId('category_id');
            $table->string('isbn',250);
            $table->string('title',250);
            $table->string('callno',50)->nullable()->default(NULL);
            $table->string('author',50)->nullable()->default(NULL);
            $table->string('publisher',50)->nullable()->default(NULL);
            $table->string('edition',50)->nullable()->default(NULL);
            $table->string('copyright',50)->nullable()->default(NULL);
            $table->integer('status')->default(1);
            $table->integer('type')->nullable()->default(NULL);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('materials_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials_subject');
        $table->dropForeign('category_id');
    }
}
