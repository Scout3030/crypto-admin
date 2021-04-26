<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsKycProcessStep3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_kyc_applications', function (Blueprint $table) {
            $table->text('short_description_business')->nullable();
            $table->integer('business_document')->nullable();
            $table->text('upload_business_plan')->nullable();
            $table->enum('pci_compliant', ['yes', 'no'])->nullable();
            $table->text('upload_pci_certificate')->nullable();
            $table->text('data_protection')->nullable();
            $table->enum('have_license', ['yes', 'no'])->nullable();
            $table->string('license_number')->nullable();
            $table->text('upload_license_image')->nullable();
            $table->string('target_countries')->nullable();
            $table->string('maximum_ticket_size')->nullable();
            $table->string('average_ticket_size')->nullable();
            $table->string('curriencies')->nullable();
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
            $table->dropColumn('short_description_business');
            $table->dropColumn('business_document');
            $table->dropColumn('upload_business_plan');
            $table->dropColumn('pci_compliant');
            $table->dropColumn('upload_pci_certificate');
            $table->dropColumn('data_protection');
            $table->dropColumn('have_license');
            $table->dropColumn('license_number');
            $table->dropColumn('upload_license_image');
            $table->dropColumn('target_countries');
            $table->dropColumn('maximum_ticket_size');
            $table->dropColumn('average_ticket_size');
            $table->dropColumn('curriencies');
        });
    }
}
