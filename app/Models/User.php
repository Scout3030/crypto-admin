<?php

namespace App\Models;

use App\Helpers\Facades\Permissions;
use App\Helpers\Roles;
use App\Notifications\ResetPasswordNotification;
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

    protected $appends = ['isRoot'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'blocked_at'        => 'datetime',
        'exp_date'          => 'date',
        'properties'        => 'array'
    ];

    protected $with = ['roles'];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * @return bool
     * @deprecated
     */
    public function getIsSuperAdminAttribute(): bool
    {
        return $this->role === Roles::ROOT;
    }

    public function getIsRootAttribute()
    {
        return Permissions::isRoot($this);
    }

    public function unlock(): void
    {
        $left = $this->blocked_at
            ->addMinutes(config('auth.block_time'))
            ->diffInMinutes(now(), false);

        if ($left >= 0) {
            $this->blocked_at = null;
            $this->login_attempts = 0;
            $this->save();
        }
    }
  
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
