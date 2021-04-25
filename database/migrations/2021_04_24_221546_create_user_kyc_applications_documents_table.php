<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKycApplicationsDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_kyc_applications_documents')) {
            Schema::create('user_kyc_applications_documents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users');
                $table->integer('identification_document');
                $table->string('other_document')->nullable();
                $table->string('document_number');
                $table->text('image');
                $table->boolean('status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('user_kyc_applications_documents')) {
            Schema::dropIfExists('user_kyc_applications_documents');
        }
    }
}
