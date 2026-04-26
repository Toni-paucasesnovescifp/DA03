<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['token' => $user->createToken('auth_token')->plainTextToken]);
    }

    public function login(Request $request) {
        $user = \App\Models\User::where('email', $request->email)->first();
    
        // Canviem Hash::allMatch per Hash::check
        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credencials invàlides'], 401);
        }
    
        return response()->json(['token' => $user->createToken('auth_token')->plainTextToken]);
    }

}
