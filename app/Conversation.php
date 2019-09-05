<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Conversation extends Pivot
{
    public $timestamps = false;

    public function host()
    {
        return $this->belongsTo('App\User', 'host_id');
    }

    public function recipient()
    {
        return $this->belongsTo('App\User', 'recipient_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Messages', 'conversation_id', 'conversation_code');
    }
}
