<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;           
use App\Models\Pendaftaran;     
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 1. Menampilkan Halaman Dashboard Admin & Data Siswa
    public function index()
    {
        $lombas = Lomba::all();
        $pendaftarans = Pendaftaran::with(['user', 'lomba'])->get();
        
        // Ambil semua data user yang berstatus 'siswa'
        $siswas = User::where('role', 'siswa')->get();
        
        return view('admin.dashboard', compact('lombas', 'pendaftarans', 'siswas'));
    }

    // 2. Menyimpan Data Mata Lomba Baru
    public function storeLomba(Request $request)
    {
        Lomba::create($request->all());
        return back()->with('success', 'Mata Lomba berhasil ditambahkan!');
    }

    // 3. Mengubah Status Pendaftaran Siswa
    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => $request->status]);
        return back()->with('success', 'Status pendaftaran berhasil diubah!');
    }

    // --- TAMBAHAN: CRUD AKUN SISWA ---
    
    // Tambah Siswa Baru oleh Admin
    public function storeSiswa(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'siswa'
        ]);
        return back()->with('success', 'Akun siswa berhasil dibuat!');
    }

    // Hapus Siswa
    public function destroySiswa($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Akun siswa berhasil dihapus!');
    }
}