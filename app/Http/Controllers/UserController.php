<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::with(['addresses'])->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Users Fetch Successfully',
            'data' => $users,
            'code' => 200
        ]);
    }

    public function login(LoginRequest $request) {
        $token = auth()->attempt($request->only([
            'email', 'password'
        ]));

        $data = [
            'token' => $token
        ];

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data,
            'code' => 200
        ]);
    }

    public function create(UserStoreRequest $request) {
        $input = $request->only(['email', 'name']);
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'data' => [],
            'code' => 200
        ]);
    }

    public function edit(UserUpdateRequest $request) {
        $input = $request->only(['email', 'name']);
        $input['password'] = Hash::make($request->password);
        User::where('id', $request->id)->update($input);

        return response()->json([
            'status' => true,
            'message' => 'User Updated Successfully',
            'data' => [],
            'code' => 200
        ]);
    }

    public function delete($id) {
        $user = User::where('id', $id)->first();
        if($user){
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'User Deleted Successfully',
                'data' => [],
                'code' => 200
            ]);
        }
        
        return response()->json([
            'status' => false,
            'message' => 'User not found',
            'data' => [],
            'code' => 200
        ]);
    }
}
