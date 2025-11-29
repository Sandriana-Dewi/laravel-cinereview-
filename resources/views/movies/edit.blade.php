<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Film</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Judul Film</label>
                    <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="w-full border-gray-300 rounded-md shadow-sm mt-1" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Tahun Rilis</label>
                    <input type="number" name="year" value="{{ old('year', $movie->year) }}" class="w-full border-gray-300 rounded-md shadow-sm mt-1" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Sinopsis</label>
                    <textarea name="synopsis" class="w-full border-gray-300 rounded-md shadow-sm mt-1" rows="4">{{ old('synopsis', $movie->synopsis) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Poster Saat Ini</label>
                    @if($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}" class="h-40 rounded shadow mb-2 mt-2">
                    @endif
                    <p class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti poster.</p>
                    <input type="file" name="poster" class="w-full border border-gray-300 rounded p-1 mt-1">
                </div>

                <div class="flex gap-3 justify-end mt-6">
                    <a href="{{ route('movies.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>