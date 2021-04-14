<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->char('iso3', 3)->nullable();
                $table->char('iso2', 2)->nullable();
                $table->string('phonecode')->nullable();
                $table->string('currency')->nullable();
                $table->string('currency_symbol')->nullable();
                $table->text('timezones');
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
        if (Schema::hasTable('countries')) {
            Schema::dropIfExists('countries');
        }
    }
}
