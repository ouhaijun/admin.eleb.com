<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //
    protected $fillable=[
        'events_id','name','description','member_id'
    ];
}
