<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

 

    // Handle the login process manually
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return view('user.dashboard');
            }
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }


    public function register(Request $request)
{
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required',
    ];

    $request->validate($rules);

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = 'admin';

    $user->save();

    Auth::login($user);

    return redirect()->route('admin.dashboard');
}

public function showLoginForm()
{
    if (request()->is('register')) {
        return view('auth.register');
    }

    return view('auth.login');
}

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
    
}
