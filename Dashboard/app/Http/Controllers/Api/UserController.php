<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * SELECT.
     */
    public function index()
    {
        $users = User::get();
        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }

    /**
     * INSERT.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
            'loyalty_points' => 'required|integer',
            'loyalty_level_id' => 'required|exists:loyalty_levels,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'loyalty_points' => $request->loyalty_points,
            'loyalty_level_id' => $request->loyalty_level_id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'User has been created succesfully.',
            'data' => $user
        ], 201);
    }

    /**
     * SELECT.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * UPDATE.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'loyalty_points' => 'sometimes|integer',
            'loyalty_level_id' => 'sometimes|exists:loyalty_levels,id',
        ]);
        if (empty($request->all())) {
        return response()->json([
            'success' => false,
            'message' => 'No change applied.'
        ], 200);
        }
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }
        $user->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'User has been updated succesfully.',
            'data' => $user
        ], 200);
    }

    /**
     * DELETE.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
                ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User has been deleted succesfully.'
        ], 200);
    }
}