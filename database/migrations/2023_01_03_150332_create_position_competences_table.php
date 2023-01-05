<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionCompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_competences', function (Blueprint $table) {
            $table->id();
            $table->integer('position_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('measurement')->nullable();
            $table->integer('compliance')->default(0);
            $table->enum('verification', ['umine', 'no_verificated', 'third_party'])->default('umine');
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
        Schema::dropIfExists('position_competences');
    }
}
