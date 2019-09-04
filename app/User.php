<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $with = ['friends', 'manager', 'subordinates'];

    public function manager(){
        return $this->belongsTo('App\User', 'manager_id');
    }

    public function subordinates(){
        return $this->hasMany('App\User', 'manager_id');
    }

    public function friends(){
        return $this->belongsToMany('App\User', 'friendship', 'user_id', 'friend_id')->withPivot('approved');
    }
}
