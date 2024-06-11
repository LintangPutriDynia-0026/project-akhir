<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', ['navbar' => 'navbar5', 'footer' => 'footer']);
    }

    public function register()
    {
        return view('auth.register', ['navbar' => '0', 'footer' => '0']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_wa' => 'required|string|min:0|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->email == 'adminjuki5@gmail.com' && $request->nama == 'superadmin') {
            $role = 'superadmin';
        } else {
            $role = 'user';
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_wa' => $request->no_wa,
        ]);

        $user->assignRole($role);

        if ($user) {
            Auth::login($user);
            return redirect()->route('login')->with('success', 'Register success');
        } else {
            return redirect()->route('register')->with('error', 'Register failed');
        }
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('juki.index')->with('success', 'Login success');
        } else {
            return redirect()->route('login')->with('error', 'Login failed email or password is incorrect');
        }
    }

    public function page()
    {
        $user = Auth::user();

        return view('page.index', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // public function addProfil(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email|max:255|unique:users',
    //         'password' => 'required|min:8|confirmed',
    //         'alamat' => 'required|string|max:255',
    //         'role' => 'required|in:superadmin,user',
    //         'tanggal_lahir' => 'required|date',
    //         'jenis_kelamin' => 'required|in:laki-laki,perempuan',
    //         'no_wa' => 'required|string|min:0|max:15',
    //         'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('register')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $image = $request->file('ktp');
    //     $imageName = time().'.'.$image->extension();
    //     $image->move(public_path('uploads'), $imageName);

    //     $user = User::create([
    //         'nama' => $request->nama,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'alamat' => $request->alamat,
    //         'tanggal_lahir' => $request->tanggal_lahir,
    //         'jenis_kelamin' => $request->jenis_kelamin,
    //         'no_wa' => $request->no_wa,
    //         'ktp' => $imageName,
    //     ]);
    // }
}