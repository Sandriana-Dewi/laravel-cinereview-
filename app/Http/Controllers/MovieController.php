<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib untuk File Storage

class MovieController extends Controller
{
    // 1. MENAMPILKAN DATA (CRUD: Read)
    public function index()
    {
        // Mengambil data film terbaru, dibatasi 8 per halaman
        $movies = Movie::latest()->paginate(8); 
        return view('movies.index', compact('movies'));
    }

    // 2. FORM TAMBAH DATA (CRUD: Create View)
    public function create()
    {
        return view('movies.create');
    }

    // 3. MENYIMPAN DATA (CRUD: Store + Validation + File Storage)
    public function store(Request $request)
    {
        // A. Validasi (Mencegah input kosong/salah)
        $request->validate([
            'title' => 'required|min:3',
            'year' => 'required|numeric',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Wajib Gambar max 2MB
        ]);

        // B. Upload File Poster
        $posterPath = null;
        if ($request->hasFile('poster')) {
            // Simpan gambar ke folder 'public/posters'
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        // C. Simpan ke Database
        Movie::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'year' => $request->year,
            'poster' => $posterPath,
        ]);

        return redirect()->route('movies.index')->with('success', 'Film berhasil ditambahkan!');
    }

    // 4. FITUR PENCARIAN AJAX (Materi Ajax API)
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        // Cari film berdasarkan judul yang mirip
        $movies = Movie::where('title', 'like', "%{$query}%")->get();
        
        // Kembalikan hanya potongan tampilan list film (bukan seluruh halaman)
        return view('movies.partials.list', compact('movies'))->render();
    }
}