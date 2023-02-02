<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required'
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();
        return response()->json(["message"=>"User registered successfully"], Response::HTTP_CREATED);
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)){
            return response()->json(['message'=>"Access Granted", "user"=>Auth::user()], Response::HTTP_ACCEPTED);
        }
        else{
            return response()->json(["message"=>"Invalid credentials"], Response::HTTP_UNAUTHORIZED);
        }
    }
    public function logout(){
        Auth::logout();
        return response()->json(["message"=>"Session closed"], Response::HTTP_OK);
    }

    public function index(){
        $users = User::all();
        return response()->json($users, Response::HTTP_OK);
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return response()->json(["message"=>"User deleted successfully"],Response::HTTP_OK);
    }
}
