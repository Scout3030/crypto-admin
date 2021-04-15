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
                $table->string('full_name')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->text('address')->nullable();
                $table->string('country', 5)->nullable();
                $table->string('state', 5)->nullable();
                $table->string('state_other')->nullable();
                $table->string('city', 5)->nullable();
                $table->string('city_other')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('skype_id')->nullable();
                $table->unsignedInteger('identification_document')->nullable();
                $table->string('other_document')->nullable();
                $table->text('upload_document')->nullable();
                $table->string('document_number')->nullable();
                $table->string('tax_id')->nullable();
                $table->integer('step')->default(0);
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
