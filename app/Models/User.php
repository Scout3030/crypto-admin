<?php

namespace App\Models;

use App\Helpers\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @property bool $isSuperAdmin
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ACTIVED_TOKEN   = 1;
    public const INACTIVED_TOKEN = 2;

    public const NO  = 0;
    public const YES = 1;

    protected $guarded = ['password', 'id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_token',
        'token_status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['roles'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getIsSuperAdminAttribute(): bool
    {
        return $this->role === Roles::SU;
    }
}
