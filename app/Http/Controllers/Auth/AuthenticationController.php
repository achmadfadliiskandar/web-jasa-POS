<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    // bagian awal login
    public function checkuser(){
        return Auth::check();
    }
    public function displaylogin(){
        if ($this->checkuser() == false) {
            return view('auth/login');
        }else {
            return redirect('/dashboard');
        }
    }
    public function authenticatelogin(Request $request){
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email'=>'email atau password tidak sesuai',
        ])->onlyInput('email');
    }
    // bagian akhir login

    // bagian awal register
    public function displayregister(){
        if ($this->checkuser() == false) {
            return view('auth/register');
        }else {
            return redirect('/dashboard');
        }
    }
    public function authenticateregister(Request $request){
        $credentials = $request->validate([
            'name' =>  ['required','string'],
            'email' => ['required', 'email','unique:users'],
            'password' => ['required','min:8']
        ]);
        $user = User::create([
            'name'=> $credentials['name'],
            'email'=> $credentials['email'],
            'password'=> Hash::make($credentials['password'])
        ]);
        Auth::login($user);
        return redirect('/dashboard');
    }
    // bagian akhir register

    // bagian awal logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    // bagian akhir logout
}
