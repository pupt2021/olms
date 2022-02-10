<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_link_id')->nullable()->default(NULL);
            $table->string('link_name')->nullable()->default(NULL);
            $table->string('slug_name')->nullable()->default(NULL);
            $table->integer('display_status')->nullable()->default(NULL);

            $table->foreign('parent_link_id')->references('id')->on('user_links_parent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_links');
        $table->dropForeign('parent_link_id');
    }
}
