<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    // Halaman Utama Website JUKI
    public function index()
    {
        return view('page.juki.home', ['navbar' => 'navbar1', 'footer' => 'footer']);
    }

    public function viewUmkm()
    {
        return view('page.juki.umkm', ['navbar' => 'navbar2', 'footer' => 'footer']);
    }

    public function addDashboard()
    {
        return view('page.juki.dashboard', ['navbar' => 'navbar5', 'footer' => 'footer']);
    }

    public function addProfil()
    {
        return view('page.juki.profil', ['navbar' => 'navbar5', 'footer' => 'footer']);
    }

    public function addLoker()
    {
        return view('page.juki.loker', ['navbar' => 'navbar5', 'footer' => 'footer']);
    }

    public function about()
    {
        return view('page.juki.about', ['navbar' => 'navbar3', 'footer' => 'footer']);
    }

    public function infoLoker()
    {
        return view('page.juki.info-loker', ['navbar' => 'navbar4', 'footer' => 'footer']);
    }

    public function service()
    {
        return view('page.juki.service', ['navbar' => 'navbar3', 'footer' => 'footer']);
    }

    // Admin
    public function admin()
    {
        return view('page.admin.dashboard');
    }

    // Users
    public function users()
    {
        $users = User::all();
        return view('page.admin.index', compact('users'));
    }

    // add user
    public function addUser()
    {
        return view('page.admin.add');
    }

    // store user
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'role' => 'required|in:superadmin,user',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_wa' => 'required|string|min:0|max:15',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.admin.add')
                ->withErrors($validator)
                ->withInput();
        }

        $image = $request->file('ktp');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('uploads'), $imageName);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_wa' => $request->no_wa,
            'ktp' => $imageName,
        ]);

        $user->assignRole($request->role);

        if ($user) {
            return redirect()->route('page.admin')->with('success', 'User added successfully');
        } else {
            return redirect()->route('page.admin.add')->with('error', 'Failed to add user');
        }
    }

    // edit user
    public function editUser($id)
    {
        $user = User::find($id);
        $user->role = $user->roles->first()->name;
        return view('page.admin.edit', compact('user'));
    }

    // update user
    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:superadmin,user',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_wa' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.admin.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);

        $user->nama = $request->nama;
        $user->email = $request->email;

        if ($request->password)
            $user->password = Hash::make($request->password);

        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_wa = $request->no_wa;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->alamat = $request->alamat;
        if ($request->hasFile('ktp')) {
            $image = $request->file('ktp');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads'), $imageName);
            $user->ktp = $imageName;
        }
        $user->save();

        $user->syncRoles([$request->role]);

        return redirect()->route('page.admin')->with('success', 'User updated successfully');
    }

    // delete user
    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user->id == Auth::user()->id)
            return redirect()->route('page.admin.index')->with('error', 'You cannot delete your own account');

        $user->delete();

        // detech role
        $user->syncRoles([]);

        return redirect()->route('page.admin.index')->with('success', 'User deleted successfully');
    }
}
