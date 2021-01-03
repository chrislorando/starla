<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role_id'
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

    public function role() {
        return $this->belongsTo(Role::class);
    }
    
    public function hasPermission($permission) {
        return $this->role->permissions()->where('name', $permission)->first() ?: false;
    }

    public function generateToken()
    {
        $this->api_token = base64_encode(sha1(rand(1, 10000) . uniqid() . time()));
        $this->save();

        return $this->api_token;
    }

    public function extractToken($token)
    {
        $access_token = '';
        
        if($token){
            $split_token = explode(" ", $token);
            $access_token = trim($split_token[1]);
        }

        return $access_token;
    }
}
