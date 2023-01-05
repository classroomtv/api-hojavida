<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInLmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_in_lms', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('lms_id');
            $table->string('institution_id');
            $table->enum('status', ['active', 'inactive', 'unconfirmed'])->default('active');
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
        Schema::dropIfExists('users_in_lms');
    }
}
