<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('authentication.sign_up');
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect("/showlogin")->with('message', 'You have been registered! Please log in to continue.');
        } catch (Exception $e) {
            return response($e->getMessage());
        }

    }

    public function showLogin()
    {
        return view('authentication.sign_in');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if "Remember Me" is checked
        $remember = $request->filled('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/dashboard/users');
            } else if ($user->role === 'superadmin') {
                return redirect('/dashboard/admins');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/showlogin');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
