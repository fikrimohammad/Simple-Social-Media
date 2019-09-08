<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Successfully retrieved',
            'data' => $users
        ], 200);
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->Input('name')
        ]);

        return response()->json([
            'message' => 'User with name '. $user->name .' successfully created.',
            'data' => $user
        ], 200);
    }

    public function show_manager(User $user)
    {
        return response()->json([
            'message' => 'Successfully retrieved',
            'data' => $user->manager
        ], 200);
    }

    public function show_subordinates(User $user)
    {
        return response()->json([
            'message' => 'Successfully retrieved',
            'data' => $user->subordinates
        ], 200);
    }

    public function assign_manager(Request $request, User $user)
    {
        $manager = User::findOrFail($request->Input('manager_id'));
        $user->manager()->associate($manager);
        $user->save();

        return response()->json([
            'message' => 'The appointment of '. $manager->name.' as manager of '. $user->name .' was successfully carried out.',
            'data' => $user
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json([
            'message' => 'User with name '. $user->name .' successfully updated.',
            'data' => $user
        ], 201);
    }

    public function destroy(User $user)
    {
        $user_name = $user->name;
        $user->manager()->dissociate();
        $user->friends()->detach();
        $user->delete();

        return response()->json([
            'message' => 'User with name '. $user_name .' successfully deleted.'
        ], 204);
    }
}
