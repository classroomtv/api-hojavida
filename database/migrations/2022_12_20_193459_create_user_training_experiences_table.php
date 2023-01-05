<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTrainingExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_training_experiences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('grade');
            $table->timestamp('end_date');
            $table->mediumText('backrest')->nullable();
            $table->integer('lms_course_id')->nullable();
            $table->integer('lms_degree_id')->nullable();
            $table->string('institution_id')->nullable();
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
        Schema::dropIfExists('user_training_experiences');
    }
}
