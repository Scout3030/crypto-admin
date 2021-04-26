<?php

namespace App\Services;

use App\Enums\NotificationTypes;
use App\Events\NewNotification;
use App\Helpers\Constants\NotificationEvents;
use App\Helpers\Enums\YesNo;
use App\Models\Notification;
use App\Models\User;
use stdClass;

class NotificationService
{
    public function count(User $user)
    {
        return Notification::whereUserId($user->id)
            ->whereRead((string) YesNo::NO)
            ->get()
            ->count();
    }

    public function getLatest(User $user)
    {
        return Notification::whereUserId($user->id)
            ->whereRead((string) YesNo::NO)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function send(User $user, array $data, String $type)
    {
        $notification = null;
        $theUser = new stdClass();
        $theUser->id = $user->id;
        $theData = [];

        if ($type === NotificationTypes::USER_FIELD_CHANGE) {
            $messages = [
                'email' => NotificationEvents::EMAIL_CHANGED,
                'password' => NotificationEvents::PASSWORD_CHANGED,
                'is_active' => $user->is_active === YesNo::YES ? NotificationEvents::ACCOUNT_ENABLED :  NotificationEvents::ACCOUNT_DISABLED,
            ];

            if (isset($data['field']) && isset($messages[$data['field']])) {
                $notification = Notification::create([
                    'user_id' => $user->id,
                    'event' => $messages[$data['field']],
                    'read' => (string) YesNo::NO,
                ]);
                $theData = [
                    'count' => $this->count($user),
                    'html' => view('partials.notification-list', ['notifications' => $this->getLatest($user)])->render(),
                ];
            }
        }

        if (isset($notification)) {
            event(new NewNotification($theUser, $theData));
        }
    }
}
