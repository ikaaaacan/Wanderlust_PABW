<?php

namespace App\Http\Controllers; 

use App\Models\Wisata;
use App\Models\User;
use Illuminate\Http\Request;

class WisataController extends Controller {
    
    // 1. Tampilan Utama Tabel Wisata
    public function index() {
        // Mengambil semua data dari tabel wisatawan
        $wisatas = Wisata::all(); 
        
        return view('admin', [
            'page' => 'wisata', 
            'wisatas' => $wisatas,
            'user' => User::first() // Menampilkan profile admin di sidebar
        ]);
    }

    // 2. Halaman Detail untuk Review
    public function review($id) {
        $wisata = Wisata::findOrFail($id);
        
        return view('admin', [
            'page' => 'review_detail', 
            'wisata' => $wisata,
            'user' => User::first()
        ]);
    }

    // 3. Tombol Approve (Status: approved)
    public function approve($id) {
        $wisata = Wisata::findOrFail($id);
        $wisata->status = 'approved'; 
        $wisata->save();
        
        return redirect()->route('wisata.index')->with('success', 'Wisata "' . $wisata->nama_wisata . '" telah disetujui!');
    }

// 4. Tombol Revisi
public function revisi($id) {
    $wisata = Wisata::findOrFail($id);
    // Ganti 'revisi' jadi 'pending' supaya tidak error 'Data truncated'
    $wisata->status = 'pending'; 
    $wisata->save();
    
    return redirect()->route('wisata.index')->with('success', 'Wisata dikembalikan (Status: Pending)!');
}

    // 5. Tombol Hapus (Terhapus selamanya dari database)
    public function destroy($id) {
        $wisata = Wisata::findOrFail($id);
        $nama = $wisata->nama_wisata;
        $wisata->delete(); 
        
        return redirect()->route('wisata.index')->with('success', 'Wisata "' . $nama . '" berhasil dihapus dari database!');
    }
    // Menampilkan halaman form tambah
public function create() {
    return view('admin', [
        'page' => 'tambah_wisata',
        'user' => User::first()
    ]);
}

// Menyimpan data dari form ke database wisatas
public function store(Request $request) {
    $request->validate([
        'nama_wisata' => 'required',
        'pemilik' => 'required',
        'deskripsi' => 'required',
    ]);

    Wisata::create([
        'nama_wisata' => $request->nama_wisata,
        'pemilik' => $request->pemilik,
        'deskripsi' => $request->deskripsi,
        'status' => 'pending', // Otomatis statusnya pending dulu beb
    ]);

    return redirect()->route('wisata.index')->with('success', 'Wisata baru berhasil ditambahkan!');
}
}