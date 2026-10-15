<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class JuriController extends Controller
{
    public function index()
    {
        // Mengambil semua data pendaftaran peserta beserta relasi user dan lomba
        $pendaftarans = Pendaftaran::with(['user', 'lomba'])->get();
        return view('juri.dashboard', compact('pendaftarans'));
    }

    public function updateNilai(Request $request, $id)
    {
        $request->validate([
            'status_seleksi' => 'required|in:Pending,Lolos,Tidak Lolos',
            'catatan_juri' => 'nullable|string|max:500',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status_seleksi = $request->status_seleksi;
        $pendaftaran->catatan_juri = $request->catatan_juri;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Penilaian dan catatan juri berhasil diperbarui!');
    }
}