<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKycApplicationsPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_kyc_applications_person')) {
            Schema::create('user_kyc_applications_person', function (Blueprint $table) {
                $table->id();
                $table->string('person_name');
                $table->string('person_address');
                $table->foreignId('user_id')->constrained('users');
                $table->string('country', 5);
                $table->string('state', 5);
                $table->string('state_other')->nullable();
                $table->string('city', 5);
                $table->string('city_other')->nullable();
                $table->integer('type_person');
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
        if (Schema::hasTable('user_kyc_applications_person')) {
            Schema::dropIfExists('user_kyc_applications_person');
        }
    }
}
