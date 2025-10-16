<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){ return view('auth.login'); }
    public function showRegister(){ return view('auth.register'); }

    public function register(Request $req){
        $data = $req->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=> Hash::make($data['password']),
            'role'=>'user',
        ]);
        Auth::login($user);
        return redirect('/');
    }

    public function login(Request $req){
        $cred = $req->validate(['email'=>'required|email','password'=>'required']);
        if(Auth::attempt($cred, $req->boolean('remember'))){
            $req->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['email'=>'Kredensial salah'])->onlyInput('email');
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }
}