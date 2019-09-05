<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    public $timestamps = false;

    protected $fillable = ['body'];

    protected $with = ['sender', 'recipient', 'conversation'];

    public function sender(){
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function recipient(){
        return $this->belongsTo('App\User', 'recipient_id');
    }

    public function conversation(){
        return $this->belongsTo('App\Conversation', 'conversation_id', 'conversation_code');
    }
}
