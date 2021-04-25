<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{

    public function run()
    {
        $notifications = Notification::count();

        if ($notifications === 0) {
            Notification::factory()->count(120)->create();
        }
    }
}
