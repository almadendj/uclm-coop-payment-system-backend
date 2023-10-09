<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    
    /**
     * display a listing of all users, return JSON
     */
    public function index() {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * store a newly created user in storage, return JSON
     */
    public function store(Request $request) {
        $validatedData = $request->validate(
            [
                "username" => "required|string|unique:users",
                "first_name" => "required|string",
                "last_name" => "required|string",
                "email" => "required|string",
                "usergroup" => "required|string",
                "profile_pic_src" => "string",
                "password" => "required|string",
                "status" => "required|string",
            ]
        );

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    /**
     * display the specified user, return JSON
     */
    public function show(User $user) {
        return response()->json($user);
    }

    /**
     * update the specified user in storage, return JSON
     */
    public function update(Request $request, User $user) {
        return response()->json(["hello" => "Youve entered update."], 200);
        // $validatedData = $request->validate(
        //     [
        //         "username" => "string|unique:users,username," . $user->id . "|nullable",
        //         "first_name" => "string|nullable",
        //         "last_name" => "string|nullable",
        //         "email" => "string|nullable",
        //         "usergroup" => "string|nullable",
        //         "profile_pic_src" => "string|nullable",
        //         "password" => "string|nullable",
        //     ],
        //     [
        //         "username.unique" => "That username is already taken.",
        //     ]
        // );

        // $user->update($validatedData);
        // return response()->json($user, 200);
    }

    /**
     * update the status of the specified user in storage, return JSON
     */
    public function setStatus(Request $request, User $user) {
        $validatedData = $request->validate(
            [
                "status" => "required|string",
            ]
        );

        // validate that the provided status is 'active' or 'inactive'
        if ($validatedData["status"] !== "active" && $validatedData["status"] !== "inactive") {
            return response()->json(["error" => "Invalid status provided."], 400);
        }

        $user->status = $validatedData["status"];
        $user->save();

        return response()->json($user, 200);
    }

    /**
     * remove the specified user from storage, return JSON
     */
    public function destroy(User $user) {
        $user->delete();
        return response()->json(null, 204);
    }
}