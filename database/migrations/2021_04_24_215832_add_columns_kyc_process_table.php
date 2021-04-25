<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsKycProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_kyc_applications', function (Blueprint $table) {
            $table->string('code_phone')->nullable();
            $table->boolean('status');
            $table->string('company_name')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('doing_business_as')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_country', 5)->nullable();
            $table->string('company_state', 5)->nullable();
            $table->string('company_state_other')->nullable();
            $table->string('company_city', 5)->nullable();
            $table->string('company_city_other')->nullable();

            $table->dropColumn('identification_document');
            $table->dropColumn('other_document');
            $table->dropColumn('upload_document');
            $table->dropColumn('document_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_kyc_applications', function (Blueprint $table) {
            $table->dropColumn('code_phone');
            $table->dropColumn('status');
            $table->dropColumn('company_name');
            $table->dropColumn('registration_number');
            $table->dropColumn('doing_business_as');
            $table->dropColumn('company_address');
            $table->dropColumn('company_country');
            $table->dropColumn('company_state');
            $table->dropColumn('company_state_other');
            $table->dropColumn('company_city');
            $table->dropColumn('company_city_other');
        });
    }
}
