<?php

namespace Database\Factories;

use App\Helpers\Constants\NotificationEvents;
use App\Helpers\Enums\YesNo;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'event' => $this->faker->randomElement([
                NotificationEvents::EMAIL_CHANGED, NotificationEvents::PASSWORD_CHANGED
            ]),
            'read' => (string) $this->faker->randomElement([YesNo::NO, YesNo::YES])
        ];
    }
}
