<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();           
            $table->string('engineering_technology');
            $table->string('scienceFor_technology');
            $table->string('ict');
            $table->string('final_result');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_results');
    }
}
