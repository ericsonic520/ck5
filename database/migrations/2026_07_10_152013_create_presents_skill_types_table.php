<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentsSkillTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presents_skill_types', function (Blueprint $table) {
            $table->id('resume_skill_type_id');
            $table->string('resume_skill_type_name', 255)->nullable();
            $table->string('resume_skill_type_display', 1)->nullable();
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
        Schema::dropIfExists('presents_skill_types');
    }
}
