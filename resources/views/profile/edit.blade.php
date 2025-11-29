<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Film: {{ $movie->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="mb-4">
                    <label>Judul Film</label>
                    <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label>Tahun Rilis</label>
                    <input type="number" name="year" value="{{ old('year', $movie->year) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label>Sinopsis</label>
                    <textarea name="synopsis" class="w-full border p-2 rounded" rows="4">{{ old('synopsis', $movie->synopsis) }}</textarea>
                </div>

                <div class="mb-4">
                    <label>Poster Saat Ini</label><br>
                    <img src="{{ asset('storage/' . $movie->poster) }}" class="h-40 rounded shadow mb-2">
                    <p class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti poster.</p>
                    <input type="file" name="poster" class="w-full border p-2 rounded mt-1">
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
                    <a href="{{ route('movies.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>