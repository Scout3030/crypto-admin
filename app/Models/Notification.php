<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    protected $fillable = ['user_id', 'event', 'read'];

    public static function boot ()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->setCreatedAt($model->freshTimestamp());
        });
    }

}
