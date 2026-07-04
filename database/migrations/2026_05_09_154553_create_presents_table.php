<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presents', function (Blueprint $table) {
            $table->id('resume_id');
            $table->string('resume_nickname', 255)->nullable();
            $table->string('resume_name', 255)->nullable();
            $table->string('resume_picme', 255)->nullable();
            $table->string('resume_sex', 255)->nullable();
            $table->string('resume_age', 255)->nullable();
            $table->string('resume_marry', 255)->nullable();
            $table->string('resume_education', 255)->nullable();
            $table->string('resume_cellphone', 10)->nullable();
            $table->string('resume_email', 255)->nullable();
            $table->string('resume_summary', 255)->nullable();
            $table->string('resume_introduction', 255)->nullable();
            $table->string('resume_experience', 255)->nullable();
            $table->string('resume_skill', 255)->nullable();
            $table->string('resume_sideproject', 255)->nullable();
            $table->string('resume_display', 1)->nullable();
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
        Schema::dropIfExists('presents');
    }
}
