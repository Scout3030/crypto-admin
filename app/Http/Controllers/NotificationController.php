<?php

namespace App\Http\Controllers;

use App\Helpers\Enums\YesNo;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $newNotifications = Notification::whereRead(YesNo::NO)->get();
        $earlierNotifications = Notification::paginate(4);
        return view('notifications.index', compact('newNotifications', 'earlierNotifications'));
    }
}
