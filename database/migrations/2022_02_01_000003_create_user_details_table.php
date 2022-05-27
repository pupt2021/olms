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
            $table->foreignId('user_id')->nullable();
            $table->foreignId('course_id')->nullable()->default(NULL);
            $table->foreignId('gender_id')->nullable()->default(NULL);
            $table->string('image_url')->nullable()->default(NULL);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable()->default(NULL);
            $table->date('birthday')->nullable()->default(NULL);
            $table->string('contact_no')->nullable()->default(NULL);
            $table->string('address')->nullable()->default(NULL);
            $table->string('barangay')->nullable()->default(NULL);
            $table->string('city')->nullable()->default(NULL);
            $table->string('zip_code')->nullable()->default(NULL);
            $table->string('stud_number');
            $table->string('faculty_code')->nullable()->default(NULL);
            $table->string('employee_number')->nullable()->default(NULL);
            $table->integer('employee_status')->nullable()->default(NULL);

            $table->foreign('user_id')->references('id')->on('users');
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
        $table->dropForeign('course_id');
        $table->dropForeign('gender_id');
    }
}
