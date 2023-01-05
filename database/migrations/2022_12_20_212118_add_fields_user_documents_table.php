<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsUserDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_documents', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('document_name');
            $table->string('document_type')->default('pdf');
            $table->string('document_url');
            $table->string('document_status')->default('A');
            $table->string('document_description');
            $table->timestamp('document_date')->nullable();
            $table->string('document_expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
