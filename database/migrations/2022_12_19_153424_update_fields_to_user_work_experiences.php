<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToUserWorkExperiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_work_experiences', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_work_experiences', function (Blueprint $table) {
            //
            $table->date('position_start');
            $table->date('position_end')->nullable();
        });
    }
}
