<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function manager(){
        return $this->belongsTo('App\User', 'manager_id');
    }

    public function subordinates(){
        return $this->hasMany('App\User', 'manager_id');
    }

    public function friends(){
        return $this->belongsToMany('App\User', 'friendship', 'user_id', 'friend_id')
                    ->withPivot('approved');
    }

    public function conversations(){
        return $this->belongsToMany('App\User', 'conversation', 'host_id', 'recipient_id')
                    ->using('App\Conversation')
                    ->withPivot('conversation_code');
    }
}
