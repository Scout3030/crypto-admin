<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtpTokenToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('users', ['otp_token', 'token_status'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('otp_token')->nullable()->after('remember_token');
                $table->enum('token_status',
                    [User::INACTIVED_TOKEN, User::ACTIVED_TOKEN]
                )->default(User::INACTIVED_TOKEN)->after('otp_token');
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
        if (Schema::hasColumns('users', ['otp_token', 'token_status'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('otp_token');
                $table->dropColumn('token_status');
            });
        }
    }
}
