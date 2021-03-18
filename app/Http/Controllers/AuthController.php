<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('welcome');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

    public function github()
    {
        // kirim request ke github
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect()
    {
        //  get request oauth dari github untuk authentication
        $user = Socialite::driver('github')->stateless()->user();

        // create user jika belum ada di table users
        $user = User::firstOrCreate([
            'name' => "Muhammad Ikhbal Github",
            'username' => $user->nickname,
            'password' => bcrypt('ikhbalgithub')
        ]);

        Auth::login($user, true);

        return redirect()->route('home');
    }

    public function home()
    {
        return view('home');
    }
}
