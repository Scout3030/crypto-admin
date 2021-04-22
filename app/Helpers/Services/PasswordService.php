<?php

namespace App\Helpers\Services;

use App\Models\User;
use Exception;
use Hash;

class PasswordService
{
    /**
     * @var \App\Models\User
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function make(User $user): PasswordService
    {
        return new static($user);
    }

    /**
     * @param string $newPassword
     *
     * @throws \Exception
     */
    public function checkNewPassword(string $newPassword)
    {
        $rememberedPasswords = $this->user->properties['passwords'] ?? [];

        foreach ($rememberedPasswords as $oldPassword) {
            if (Hash::check($newPassword, $oldPassword)) {
                //TODO Any logic here
                throw new Exception('Old password use');
            }
        }

        $hash = Hash::make($newPassword);

        if (count($rememberedPasswords) >= 3) {
            array_shift($rememberedPasswords);
        }

        $rememberedPasswords[] = $hash;

        $properties = [
            'passwords' => $rememberedPasswords,
        ];

        $this->user->password = $hash;
        $this->user->properties = $properties;
        $this->user->save();
    }
}
