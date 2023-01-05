<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Campos para el perfil del usuario necesarios para el registro
            $table->string('last_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('dni')->nullable();
            $table->text('about_me')->nullable();
            $table->string('avatar')->nullable();
            $table->string('occupation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('birthdate');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('dni');
            $table->dropColumn('about_me');
            $table->dropColumn('avatar');
            $table->dropColumn('occupation');
        });
    }
}
