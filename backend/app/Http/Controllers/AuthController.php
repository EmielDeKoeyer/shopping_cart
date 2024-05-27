<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }


    public function login(Request $request) {
        $this->validateRequest($request);
        $credentials = $request->only('email', 'password');
        $is_valid = Auth::attempt($credentials);
        if(!$is_valid){
            return response()->json([
                'success' => false,
                'message' => 'Login failed'
            ]);
        }

        $token = $request->user()->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => Auth::user(),
            'token' => $token
        ]);    
    }

    public function register(Request $request) {
        $this->validateRequest($request);
        $user = $this->userService->create($request->all());
        if(!$user){
            return response()->json(['success' => false, 'message' => 'Register failed']);
        }

        return response()->json(['success' => true, 'message' => 'Register successful']);
    }

    private function validateRequest(Request $request) {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
    }
}
