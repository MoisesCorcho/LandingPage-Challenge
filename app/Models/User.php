<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [];

    protected $guarded = [];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Returns all users except the one with name 'Admin'
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllExceptAdmin()
    {
        return static::whereNot('name', 'Admin')->get();
    }

    /**
     * Counts the number of registered users excluding the 'Admin' user.
     *
     * @return int The count of registered users.
     */
    public static function countRegisteredUsers()
    {
        return static::whereNot('name', 'Admin')->count();
    }
}
