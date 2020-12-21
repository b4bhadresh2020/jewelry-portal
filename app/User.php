<?php

namespace App;

use App\Traits\MediaRelationship;
use Laravel\Passport\HasApiTokens;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Junges\ACL\Traits\UsersTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, UsersTrait, SoftDeletes, MediaRelationship;

    const BACKEND_USER = 1;
    const CUSTOMER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password', 'type'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return City|null
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function socialiteProvider()
    {
        return $this->hasMany(SocialiteProvider::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if a user has any permission.
     *
     * @param array $permissions
     *
     * @return bool
     */
    public function hasAnyHavePermission($permissions)
    {

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
