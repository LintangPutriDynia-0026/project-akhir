<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Umkm;
use App\Models\Loker;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    // Halaman Utama Website JUKI
    public function index()
    {
        return view('page.juki.home', ['navbar' => 'navbar1', 'footer' => 'footer']);
    }

    public function showUmkm()
    {
        // Mengambil semua data UMKM dari database
        $umkms = Umkm::all();

        // Mengirim data UMKM ke tampilan 'umkm.blade.php'
        return view('page.juki.umkm', ['navbar' => 'navbar2', 'footer' => 'footer', 'umkms' => $umkms]);
    }

    public function showDashboard()
    {
        // Mengambil data UMKM yang dimiliki oleh pengguna yang saat ini masuk
        $umkm = Umkm::where('user_id', auth()->id())->first();

        return view('page.juki.dashboard', ['navbar' => 'navbar4', 'footer' => 'footer', 'umkm' => $umkm]);
    }
    
    public function storeUmkm(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'kota_umkm' => 'required|string|max:255',
            'lokasi_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kontak' => 'required|string|min:0|max:15',
            'foto_umkm' => 'required|image|max:2048',
        ]);

        // Upload gambar
        $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
        $request->foto_umkm->storeAs('umkm_images', $fileName, 'public');

        // Simpan data UMKM
        UMKM::create([
            'nama_umkm' => $request->nama_umkm,
            'kota_umkm' => $request->kota_umkm,
            'lokasi_umkm' => $request->lokasi_umkm,
            'deskripsi' => $request->deskripsi,
            'kontak' => $request->kontak,
            'foto_umkm' => $fileName,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function editUmkm($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('page.juki.editUmkm', ['navbar' => 'navbar4', 'footer' => 'footer', 'umkm' => $umkm]);
    }

    public function updateUmkm(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'kota_umkm' => 'required|string|max:255',
            'lokasi_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kontak' => 'required|string|min:0|max:15',
            'foto_umkm' => 'nullable|image|max:2048', // nullable untuk tidak wajib mengupload ulang
        ]);

        // Cari data UMKM berdasarkan ID
        $umkm = Umkm::findOrFail($id);

        // Jika ada file foto yang diupload
        if ($request->hasFile('foto_umkm')) {
            // Hapus file foto lama jika ada
            if ($umkm->foto_umkm && Storage::exists('public/umkm_images/' . $umkm->foto_umkm)) {
                Storage::delete('public/umkm_images/' . $umkm->foto_umkm);
            }

            // Upload file foto baru
            $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
            $request->foto_umkm->storeAs('public/umkm_images', $fileName);

            // Update nama file foto di database
            $umkm->foto_umkm = $fileName;
        }

        // Update data UMKM di database
        $umkm->update([
            'nama_umkm' => $request->nama_umkm,
            'kota_umkm' => $request->kota_umkm,
            'lokasi_umkm' => $request->lokasi_umkm,
            'deskripsi' => $request->deskripsi,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('dashboard')->with('success', 'UMKM berhasil diupdate.');
    }

    public function destroyUmkm($id)
    {
        // Find UMKM dengan ID
        $umkm = Umkm::findOrFail($id);
    
        // Delete UMKM
        $umkm->delete();

        return redirect()->route('dashboard')->with('success', 'UMKM berhasil dihapus.');
    }

    public function Profil()
    {
        $user = Auth::user();
        $profile = $user->profile; return view('page.juki.profil', [ 'user' => $user, 'profile' => $profile, 'navbar' => 'navbar4', 'footer' => 'footer' ]);
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        $validator = Validator::make($request->all(), [
            'foto_profile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => $request->filled('password') ? 'required|min:8|confirmed' : '',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|min:0|max:15',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profil')
                ->withErrors($validator)
                ->withInput();
        }

        // Update user data
        $userData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Save user data menggunakan DB::table
        $userSaved = DB::table('users')->where('id', $user->id)->update($userData);

        if (!$userSaved) {
            return redirect()->route('profil')->with('error', 'Gagal memperbarui profil pengguna');
        }

        // Update profile data
        if ($request->hasFile('foto_profile')) {
            if ($profile->foto_profile) {
                Storage::delete('public/' . $profile->foto_profile);
            }
            $foto_profile = $request->file('foto_profile');
            $foto_profile_path = $foto_profile->store('public/profile_images');
            $profile->foto_profile = str_replace('public/', '', $foto_profile_path);
        }

        if ($request->hasFile('ktp')) {
            if ($profile->ktp) {
                Storage::delete('public/' . $profile->ktp);
            }
            $ktp = $request->file('ktp');
            $ktp_path = $ktp->store('public/ktps');
            $profile->ktp = str_replace('public/', '', $ktp_path);
        }

        // Save profile data
        $profileSaved = $profile->save();

        if ($profileSaved) {
            return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui');
        } else {
            return redirect()->route('profil')->with('error', 'Gagal memperbarui profil');
        }
    }

    public function showLoker()
    {
        $umkm = Umkm::where('user_id', auth()->id())->first();
        $loker = Loker::where('user_id', auth()->id())->first();

        return view('page.juki.loker', ['navbar' => 'navbar4', 'footer' => 'footer', 'umkm' => $umkm, 'loker' => $loker]);
    }

    public function storeLoker(Request $request)
    {
        // Validasi input
        $request->validate([
            'posisi_loker' => 'required|string|max:255',
            'jumlah_loker' => 'required|integer|min:1',
            'kualifikasi' => 'required|string|max:255',
        ]);

        // Menyimpan data Loker
        Loker::create([
            'posisi_loker' => $request->posisi_loker,
            'jumlah_loker' => $request->jumlah_loker,
            'kualifikasi' => $request->kualifikasi,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('loker')->with('success', 'Loker berhasil ditambahkan.');
    }

    public function editLoker($id)
    {
        $loker= Loker::findOrFail($id);
        return view('page.juki.editLoker', ['navbar' => 'navbar4', 'footer' => 'footer', 'loker' => $loker]);
    }

    public function updateLoker(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'posisi_loker' => 'required|string|max:255',
            'jumlah_loker' => 'required|integer|min:1',
            'kualifikasi' => 'required|string|max:255',
        ]);

        // Find Loker record dengan id
        $loker = Loker::findOrFail($id);

        // Update Loker record
        $loker->update([
            'posisi_loker' => $request->posisi_loker,
            'jumlah_loker' => $request->jumlah_loker,
            'kualifikasi' => $request->kualifikasi,
        ]);

        return redirect()->route('loker')->with('success', 'Loker berhasil diperbarui.');
    }

    public function destroyLoker($id)
    {
        // Find UMKM dengan ID
        $loker = Loker::findOrFail($id);
    
        // Delete UMKM
        $loker->delete();

        return redirect()->route('loker')->with('success', 'Loker berhasil dihapus.');
    }

    public function about()
    {
        return view('page.juki.about', ['navbar' => 'navbar3', 'footer' => 'footer']);
    }

    public function infoLoker()
    {
        $lokers = Loker::join('umkms', 'umkms.user_id', '=', 'lokers.user_id')
                   ->select('lokers.*', 'umkms.nama_umkm', 'umkms.kota_umkm', 'umkms.lokasi_umkm', 'umkms.foto_umkm')
                   ->get();

        return view('page.juki.info-loker', ['navbar' => 'navbar2', 'footer' => 'footer', 'lokers' => $lokers]);
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
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.admin.add')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_wa' => $request->no_wa,
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
        // if ($request->hasFile('ktp')) {
        //     $image = $request->file('ktp');
        //     $imageName = time().'.'.$image->extension();
        //     $image->move(public_path('uploads'), $imageName);
        //     $user->ktp = $imageName;
        // }
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

    public function getDatatable(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = User::query();

                if ($request->filled('jenis_kelamin')) {
                    $data = $data->where('jenis_kelamin', $request->jenis_kelamin);
                }

                $filteredData = $data->get();
                
                return DataTables::of($filteredData)
                    ->addIndexColumn()
                    ->editColumn('jenis_kelamin', function ($model) {
                        if ($model->jenis_kelamin === 'laki-laki') {
                            return '<div class="rounded px-3 py-1 bg-black w-60 mx-auto">laki-laki</div>';
                        } else {
                            return '<div class="rounded px-3 py-1 bg-pink text-white w-60 mx-auto">perempuan</div>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $editUrl = route('page.admin.edit', ['id' => $row->id]);
                        $deleteUrl = route('page.admin.delete', ['id' => $row->id]);

                        $actionBtn = '<div class="d-flex justify-content-center">
                                        <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold">Update</a>
                                            <form action="'.$deleteUrl.'" method="POST" class="d-inline-block ms-1">
                                                '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit">Delete</button>
                                            </form>
                                    </div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['jenis_kelamin', 'action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error($e);
                return response()->json(['error' => 'Something went wrong!'], 500);
            }
        }
        return abort(404);
    }
}
