<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Translation\t;

class AuthController extends Controller
{

    public function registerView()
    {
        return view('auth.register');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function homeView()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'patronymic' => 'required',
            'bdate' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::createUser($data);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect(route('page'));
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($data, true)) {
            $request->session()->regenerate();
            return redirect((route('page')));
        }

        return back()->with(['email' => 'не найден']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
