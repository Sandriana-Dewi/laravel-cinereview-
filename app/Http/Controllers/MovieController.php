<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    // 1. Tampilkan Halaman Utama
    public function index()
    {
        $movies = Movie::latest()->paginate(8);
        return view('movies.index', compact('movies'));
    }

    // 2. Form Tambah Film (Admin Only)
    public function create()
    {
        if (Auth::user()->role !== 'admin') { abort(403); }
        return view('movies.create');
    }

    // 3. Simpan Film Baru (Admin Only)
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $request->validate([
            'title' => 'required|min:3',
            'year' => 'required|numeric',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        Movie::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'year' => $request->year,
            'poster' => $posterPath,
        ]);

        return redirect()->route('movies.index')->with('success', 'Film berhasil ditambahkan!');
    }

    // 4. Halaman Detail Film
    public function show(Movie $movie)
    {
        $movie->load('reviews.user');
        return view('movies.show', compact('movie'));
    }

    // 5. Halaman Edit Film (Admin Only) - BARU
    public function edit(Movie $movie)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }
        return view('movies.edit', compact('movie'));
    }

    // 6. Proses Update Film (Admin Only) - BARU
    public function update(Request $request, Movie $movie)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $request->validate([
            'title' => 'required|min:3',
            'year' => 'required|numeric',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'year' => $request->year,
        ];

        // Jika upload poster baru, hapus yang lama
        if ($request->hasFile('poster')) {
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Film berhasil diperbarui!');
    }

    // 7. Proses Hapus Film (Admin Only) - BARU
    public function destroy(Movie $movie)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        if ($movie->poster) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Film berhasil dihapus!');
    }

    // 8. Simpan Review
    public function storeReview(Request $request, Movie $movie)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Ulasan terkirim!');
    }

    // 9. AJAX Search
    public function search(Request $request)
    {
        $query = $request->get('query');
        $movies = Movie::where('title', 'like', "%{$query}%")->get();
        return view('movies.partials.list', compact('movies'))->render();
    }
}