<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'provider', 'provider_id', 'access_token'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = true;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
