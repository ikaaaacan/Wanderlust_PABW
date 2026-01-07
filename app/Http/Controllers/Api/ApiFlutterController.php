<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


// Import semua model yang diperlukan
use App\Models\User;
use App\Models\TempatWisata;
use App\Models\TiketTempatWisata;
use App\Models\Pembayaran;
use App\Models\PemilikTempatWisata;
use Illuminate\Support\Facades\DB;

class ApiFlutterController extends Controller
{
    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Validasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kredensial salah'
            ], 401);
        }

        // Ambil ID PTW jika perannya adalah pemilik
        $id_ptw = null;
        $id_wisatawan = null;

        if ($user->peran == 'pemilik') {
            $id_ptw = $user->pemilikTempatWisata?->id_ptw;
        } else if ($user->peran == 'wisatawan') {
            // Ambil ID dari tabel wisatawan
            $id_wisatawan = $user->wisatawan?->id_wisatawan;
        }

        return response()->json([
            'success' => true,
            'user' => [
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'peran' => $user->peran,
                'id_ptw' => $id_ptw,
                'id_wisatawan' => $id_wisatawan, // Tambahkan ini
            ],
            'token' => $user->createToken('auth_token')->plainTextToken 
        ]);
    }

    /**
     * 1. GET Request: Ambil Statistik Dashboard untuk PTW
     * URL: /api/stats/{id_ptw}
     */
    public function getStats($id_ptw)
    {
        // Menghitung Total Income dari tabel Pembayaran yang terhubung ke Transaksi -> Tiket -> Wisata milik PTW ini
        $totalIncome = DB::table('pembayaran')
            ->join('transaksi', 'pembayaran.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('tiket_tempat_wisata', 'transaksi.id_tiket', '=', 'tiket_tempat_wisata.id_tiket')
            ->join('tempat_wisata', 'tiket_tempat_wisata.id_wisata', '=', 'tempat_wisata.id_wisata')
            ->where('tempat_wisata.id_ptw', $id_ptw)
            ->where('pembayaran.status_pembayaran', 'berhasil')
            ->sum('pembayaran.jumlah_pembayaran');

        // Menghitung jumlah properti milik PTW
        $totalProperties = TempatWisata::where('id_ptw', $id_ptw)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_income' => "Rp. " . number_format($totalIncome, 0, ',', '.'),
                'total_visitors' => "205", // Simulasi data jika tabel transaksi belum di-filter pengunjung
                'ticket_sold' => "298",
                'total_properties' => (string)$totalProperties,
                'total_clicks' => "1468",
                'avg_order_value' => "83.892"
            ]
        ], 200);
    }

    /**
     * 2. GET Request: Ambil Daftar Properti milik PTW
     * URL: /api/properties/{id_ptw}
     */
    public function getProperties($id_ptw)
    {
        // Mengambil data dari tabel tempat_wisata
        $properties = TempatWisata::where('id_ptw', $id_ptw)
            ->with(['tiketTempatWisata', 'fotoTempatWisata'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $properties->map(function ($item) {
                return [
                    'id' => $item->id_wisata,
                    'name' => $item->nama_wisata,
                    'status' => $item->status_wisata, // Contoh: Active
                    'location' => $item->kota,
                    'image_url' => 'https://picsum.photos/200' // Placeholder gambar
                ];
            })
        ], 200);
    }

    // Tambahkan method ini di dalam class ApiFlutterController

/**
 * Mengambil semua destinasi aktif untuk halaman Beranda Wisatawan
 */
public function getDestinasiWisatawan()
{
    try {
        // Mengambil data dari tabel tempat_wisata
        $destinasi = TempatWisata::where('status_wisata', 'aktif')->get();

        return response()->json([
            'success' => true,
            'data' => $destinasi->map(function ($item) {
                return [
                    'id_wisata' => $item->id_wisata,
                    'nama_wisata' => $item->nama_wisata,
                    'kota' => $item->kota,
                    'average_rating' => 4.8, // Bisa dihitung dari Penilaian jika ada
                    'total_reviews' => 120,
                    'harga_tiket' => 50000, // Contoh data statis jika tiket belum ada
                    'foto_utama' => 'https://picsum.photos/400/300', 
                    'deskripsi' => $item->deskripsi,
                ];
            })
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

/**
 * Mengambil data profil lengkap (gabungan User & Wisatawan)
 */
    public function getProfile($id_user)
    {
        // Mengambil data user beserta relasi wisatwan
        $user = User::with('wisatawan')->find($id_user);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id_user' => $user->id_user,
                'id_wisatawan' => $user->wisatawan?->id_wisatawan,
                'nama' => $user->nama,
                'email' => $user->email,
                'nomor_telepon' => $user->nomor_telepon,
                'tanggal_lahir' => $user->wisatawan?->tanggal_lahir ?? '-',
                'jenis_kelamin' => $user->wisatawan?->jenis_kelamin ?? '-',
                'alamat' => $user->wisatawan?->alamat ?? '-',
                'kota_asal' => $user->wisatawan?->kota_asal ?? '-',
                'foto_profil' => $user->foto_profil ?? 'https://i.pravatar.cc/300'
            ]
        ], 200);
    }

    public function pesanTiket(Request $request)
    {
        $request->validate([
            'id_wisatawan' => 'required',
            'id_tiket' => 'required',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        // Simulasikan pembuatan transaksi sederhana
        $tiket = TiketTempatWisata::find($request->id_tiket);
        
        // Logika simpan transaksi (Contoh Sederhana)
        $totalHarga = $tiket->harga * $request->jumlah_tiket;
        
        // Disini Anda bisa melakukan DB::table('transaksi')->insert(...) 
        // Dan menyambungkannya ke tabel pembayaran

        return response()->json([
            'success' => true,
            'message' => 'Pesanan tiket berhasil disimpan'
        ], 201);
    }

    public function getBookmarks($id_wisatawan) {
        $bookmarks = Bookmark::where('id_wisatawan', $id_wisatawan)
            ->with('tempatWisata')
            ->get()
            ->pluck('tempatWisata'); // Ambil data tempat wisatanya saja

        return response()->json(['success' => true, 'data' => $bookmarks]);
    }

    // Fitur Pencarian
    public function search(Request $request) {
        $query = $request->query('query');
        $category = $request->query('category');

        $results = TempatWisata::where('nama_wisata', 'LIKE', "%$query%")
            ->when($category != 'Semua', function($q) use ($category) {
                return $q->where('jenis_wisata', $category);
            })
            ->get();

        return response()->json(['success' => true, 'data' => $results]);
    }

    public function getAdminStats()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_members' => DB::table('wisatawan')->count(),
                'total_properties' => DB::table('tempat_wisata')->count(),
                'total_owners' => DB::table('pemilik_tempat_wisata')->count(),
                'total_revenue' => "Rp. 3.000.000", // Contoh akumulasi
            ]
        ]);
    }

    public function getAdminMembers() {
        $members = User::where('peran', 'wisatawan')->get();
        return response()->json(['success' => true, 'data' => $members]);
    }

    public function getAdminOwners() {
        $owners = User::with('pemilikTempatWisata')
                    ->where('peran', 'pemilik')
                    ->get()
                    ->map(function($user) {
                        return [
                            'id_user' => $user->id_user,
                            'nama' => $user->nama,
                            'email' => $user->email,
                            'nomor_telepon' => $user->nomor_telepon,
                            'status_akun' => $user->status_akun,
                            'nama_organisasi' => $user->pemilikTempatWisata->nama_organisasi ?? '-',
                            'foto_profil' => $user->foto_profil ?? 'https://i.pravatar.cc/300',
                            'created_at' => $user->created_at->format('d/m/Y'),
                        ];
                    });
        return response()->json(['success' => true, 'data' => $owners]);
    }

    public function getAdminProperties() {
        $properties = TempatWisata::with('pemilik.user')->get()->map(function($item) {
            return [
                'id_wisata' => $item->id_wisata,
                'nama_wisata' => $item->nama_wisata,
                'status_wisata' => $item->status_wisata,
                'jenis_wisata' => $item->jenis_wisata,
                'alamat_wisata' => $item->alamat_wisata,
                'harga_tiket' => $item->harga_tiket,
                'owner_name' => $item->pemilik->user->nama ?? 'Unknown',
                'foto_utama' => $item->foto_utama ?? 'https://picsum.photos/400/300',
            ];
        });
        return response()->json(['success' => true, 'data' => $properties]);
    }
}