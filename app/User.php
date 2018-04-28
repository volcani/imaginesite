<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'server_hash', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get a user based on their username.
     *
     * @param $query Database query object
     * @param $username Username of the \App\User object to find.
     * @return \App\User
     */
    public function scopeUsername($query, $username) // User::username()
    {
        return $query->where('username', $username);
    }

    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));

        return "http://www.gravatar.com/avatar/$hash?s=32";
    }
}
