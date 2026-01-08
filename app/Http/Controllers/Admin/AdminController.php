<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wisata;
use App\Models\Wisatawan; 

class AdminController extends Controller
{
  public function index(Request $request)
{
    $page = $request->query('page', 'dashboard');
    
    // INI KUNCINYA BEB: Ambil data user yang lagi login biar profilnya muncul
    $user = auth()->user(); 
    
    $users = Wisatawan::all(); 
    $wisatas = Wisata::all();

    $wisata_single = null;
    if($page == 'review_detail' && $request->has('id')) {
        $wisata_single = Wisata::find($request->query('id'));
    }

    $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
    $chartData = [45, 70, 55, 90, 130, 110];

    // Pastikan 'user' (pake huruf kecil) ada di dalam compact
    return view('admin', compact('page', 'user', 'users', 'wisatas', 'wisata_single', 'chartLabels', 'chartData'));
}
    public function storeUser(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:wisatawan,email', 
        ]);

        Wisatawan::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'status' => 'AKTIF', 
        ]);

        return redirect()->route('admin.index', ['page' => 'users'])
                         ->with('success', "Wisatawan " . $request->nama . " berhasil ditambahkan!");
    }

    public function toggleStatus($id)
    {
        $user = Wisatawan::find($id);
        if ($user) {
            $user->status = ($user->status == 'AKTIF') ? 'NON-AKTIF' : 'AKTIF';
            $user->save();
            
            return back()->with('success', "Status " . $user->nama . " berhasil diubah!");
        }
        return back()->with('error', "Wisatawan tidak ditemukan!");
    }

    public function destroy($id)
    {
        $user = Wisatawan::find($id);
        if ($user) {
            $user->delete();
            return back()->with('success', "Wisatawan berhasil dihapus!");
        }
        return back();
    }
}