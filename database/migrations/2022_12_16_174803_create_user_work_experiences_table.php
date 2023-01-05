<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('industry')->nullable();
            $table->string('position');
            $table->string('position_start');
            $table->string('position_end')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive', 'unconfirmed'])->default('active');
            $table->integer('institution_id')->nullable();
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
        Schema::dropIfExists('user_work_experiences');
    }
}
