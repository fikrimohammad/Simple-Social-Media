<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function list_friend_request(User $user)
    {
        $friend_requests = $user->friends()->wherePivot('approved', '=', 0)->get();
        return $friend_requests;
    }

    public function create_friend_request(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $friend =  User::findOrFail($request->input('friend_id'));

        $friend->friends()->attach($request->input('user_id'), ['approved' => 0]);

        return $user->friends()->wherePivot('approved', '=', 0)->get();
    }

    public function approve_friend_request(Request $request, User $user)
    {
        $friend_id = $request->input('friend_id');
        $friend = User::findOrFail($request->input('friend_id'));

        $user->friends()->updateExistingPivot($friend_id, ['approved' => 1]);
        $friend->friends()->attach($user->id, ['approved' => 1]);

        return $user->friends()->wherePivot('approved', '=', 1)->get();
    }

    public function list_friend(User $user)
    {
        $friends = $user->friends()->wherePivot('approved', '=', 1)->get();
        return $friends;
    }
}
