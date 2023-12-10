<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        return view('home.login');
    }
    public function register(){
        return view('home.register');
    }
    public function registered(Request $request){
       $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'email|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        DB::beginTransaction();
        try {
            User::create($request->all());
            DB::commit();
            return redirect()->intended('/')->with('success','Register Success');
        } catch (\Throwable $th) {
           DB::rollBack();
           dd($th->getMessage());
        }
    }
    public function authecicate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/')->with('success','Logout Success');
    }
}
