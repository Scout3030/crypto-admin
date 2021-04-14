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

    const ACTIVED_TOKEN = 1;
    const INACTIVED_TOKEN = 2;

    const NO = 0;
    const YES = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'otp_token',
        'token_status',
        'first_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_token',
        'token_status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsSuperAdminAttribute(): bool
    {
        return $this->roles === Roles::SU;
    }
}
