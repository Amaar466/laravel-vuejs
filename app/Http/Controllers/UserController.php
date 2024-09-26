<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
// dd($credentials);
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            // $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['user' => $user], 200);
        }

        // throw Illuminate\Validation\ValidationException::withMessages([
        //     'email' => ['The provided credentials are incorrect.'],
        // ]);
    }

// }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        Auth::logout();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
