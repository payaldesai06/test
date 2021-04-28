<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name','email','phone','password','avatar','role_id','company_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    } 

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value;
        //$this->attributes['password'] = \Hash::make($value);
    } 
    public function getAvatarAttribute($value)
    {
        return $value ? env('APP_URL').'/'.$value : "";
    }
    
    public function setRoleIdAttribute($input)
    {
        $this->attributes['role_id'] = $input ? $input : null;
    }
}
