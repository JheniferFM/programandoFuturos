<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Mostrar cadastro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Registrar usuário
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redireciona para login após criar conta
        return redirect()->route('login')->with('success', 'Conta criada com sucesso! Faça login.');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/'); // vai para a home
        }

        return back()->withErrors([
            'email' => 'As credenciais informadas não são válidas.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Atualizar avatar de personagem
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'character_avatar' => 'required|string|max:255'
        ]);

        // Lista de avatares permitidos (paths de SVG)
        $allowed = [
            'avatars/code-ninja.svg',
            'avatars/robot.svg',
            'avatars/wizard.svg',
            'avatars/duck.svg',
        ];

        if (!in_array($request->character_avatar, $allowed, true)) {
            return back()->withErrors(['character_avatar' => 'Avatar inválido.']);
        }

        $user = Auth::user();
        $user->character_avatar = $request->character_avatar;
        $user->save();

        return back()->with('success', 'Avatar atualizado com sucesso!');
    }
}
