<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKycApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_kyc_applications')) {
            Schema::create('user_kyc_applications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained();
                $table->string('full_name');
                $table->date('date_of_birth');
                $table->text('address');
                $table->string('country', 5);
                $table->string('state', 5)->nullable();
                $table->string('state_other')->nullable();
                $table->integer('city')->nullable();
                $table->string('city_other')->nullable();
                $table->string('phone_number');
                $table->string('skype_id');
                $table->unsignedInteger('identification_document');
                $table->text('upload_document');
                $table->string('document_number');
                $table->string('tax_id')->nullable();
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
        if (Schema::hasTable('user_kyc_applications')) {
            Schema::dropIfExists('user_kyc_applications');
        }
    }
}
