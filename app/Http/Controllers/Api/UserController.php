<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUserId($id)
    {
        $user = User::find($id);
        return response([
            'message' => 'Get user success',
            'user' => $user,
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'name'=> 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('public/images', $image->hashName());
                $user->image = $image->hashName();
            }
            $user->save();
            return response([
                'message' => 'Update user success',
                'user' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage(),
            ]);
        }
    }
}
