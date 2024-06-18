<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Produk;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // Halaman Utama Website JUKI
    public function index()
    {
        // return view('page.juki.home', ['navbar' => 'navbarHome', 'footer' => 'footer']);
        $umkms = UMKM::limit(4)->get();
        return view('page.juki.home', ['navbar' => 'navbarHome', 'footer' => 'footer', 'umkms' => $umkms]);
    }


    public function like(Request $request)
    {
        $likeableId = $request->input('likeable_id');
        $likeableType = $request->input('likeable_type');

        $user = Auth::user();

        if ($likeableType === 'umkm') {
            $likeable = Umkm::findOrFail($likeableId);
        } elseif ($likeableType === 'produk') {
            $likeable = Produk::findOrFail($likeableId);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid likeable type'], 400);
        }

        if ($likeable->likes()->where('user_id', $user->id)->exists()) {
            $likeable->likes()->where('user_id', $user->id)->delete();
            $status = 'unliked';
            $message = ($likeableType === 'umkm') ? 'UMKM diunlike' : 'Produk diunlike';
        } else {
            $likeable->likes()->create(['user_id' => $user->id]);
            $status = 'liked';
            $message = ($likeableType === 'umkm') ? 'UMKM dilike' : 'Produk dilike';
        }

        $likesCount = $likeable->likes()->count();

        return response()->json([
            'status' => $status,
            'likes_count' => $likesCount,
            'message' => $message,
        ]);
    }

    public function about()
    {
        return view('page.juki.about', ['navbar' => 'navbarAboutUs_Service', 'footer' => 'footer']);
    }

    public function service()
    {
        return view('page.juki.service', ['navbar' => 'navbarAboutUs_Service', 'footer' => 'footer']);
    }
}
