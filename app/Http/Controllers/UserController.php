<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->Input('name')
        ]);

        return $user;
    }

    public function show_manager(User $user)
    {
        return $user->manager;
    }

    public function show_subordinates(User $user)
    {
        return $user->subordinates;
    }

    public function assign_manager(Request $request, User $user)
    {
        $manager = User::findOrFail($request->Input('manager_id'));

        $user->manager()->associate($manager);
        // $manager->subordinates()->save($user);
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->manager()->dissociate();
        $user->friends()->detach();
        $user->delete();

        return response()->json(null, 204);
    }
}
