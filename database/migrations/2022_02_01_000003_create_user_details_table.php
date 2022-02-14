<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('course_id');
            $table->foreignId('gender_id');
            $table->string('image_url');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->date('birthday');
            $table->string('contact_no');
            $table->string('address');
            $table->string('barangay');
            $table->string('city');
            $table->string('zip_code');
            $table->string('stud_number');
            $table->string('faculty_code');
            $table->string('employee_number');
            $table->integer('employee_status');

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('gender_id')->references('id')->on('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
        $table->dropForeign('role_id');
    }
}
