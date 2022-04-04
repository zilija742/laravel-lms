<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('baptism_name');
            $table->string('birth_place');
            $table->string('candidate_number');
            $table->string('driver_license_number');
            $table->string('driver_license_category');
            $table->date('driver_card_expire');
            $table->date('code95_expire');
            $table->string('vca_number');
            $table->string('personal_number');
            $table->integer('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_profiles');
    }
}
