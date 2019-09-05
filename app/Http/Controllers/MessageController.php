<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function list_conversation(User $user)
    {
        return $user->conversations;
    }

    public function send_message(Request $request)
    {
        $user_id = $request->Input('user_id');
        $recipient_id = $request->Input('recipient_id');

        $user = User::findOrFail($request->Input('user_id'));
        $recipient = User::findOrFail($recipient_id);

        $conversation_code = strval($user->id).'_'.strval($recipient_id);

        if(!$user->conversations()->where('recipient_id', $recipient_id)->exists()){
            $user->conversations()->attach($recipient_id, ['conversation_code' => $conversation_code]);
            $recipient->conversations()->attach($user_id, ['conversation_code' => $conversation_code]);
        }

        $conversation = $user->conversations()->where('recipient_id', $recipient_id)->first();
        $message = Message::create(['body' => $request->Input('message')]);

        $message->conversation()->associate($conversation->pivot->conversation_code);
        $message->sender()->associate($user);
        $message->recipient()->associate($recipient);
        $message->save();

        return $message;
    }

    public function list_message(string $conversation_code)
    {
        return Message::where('conversation_id', $conversation_code)->get();
    }
}
