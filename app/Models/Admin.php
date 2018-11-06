<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable

{

    use HasRoles;

    //Authenticatable
    protected $fillable=['name','email','password','remember_token','pwd','olpwd'];
}
