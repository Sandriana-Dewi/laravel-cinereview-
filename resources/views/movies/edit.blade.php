<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Film: {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Judul Film</label>
                    <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="w-full border-gray-300 rounded-md shadow-sm mt-1 focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Tahun Rilis</label>
                    <input type="number" name="year" value="{{ old('year', $movie->year) }}" class="w-full border-gray-300 rounded-md shadow-sm mt-1 focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Sinopsis</label>
                    <textarea name="synopsis" class="w-full border-gray-300 rounded-md shadow-sm mt-1 focus:ring-indigo-500 focus:border-indigo-500" rows="4">{{ old('synopsis', $movie->synopsis) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Poster Saat Ini</label>
                    
                    @if($movie->poster)
                        <div class="mt-2 mb-2">
                            <img src="{{ asset('storage/' . $movie->poster) }}" class="h-40 w-auto rounded shadow object-cover">
                        </div>
                    @endif
                    
                    <p class="text-xs text-gray-500 mb-1">Biarkan kosong jika tidak ingin mengubah poster.</p>
                    <input type="file" name="poster" class="w-full border border-gray-300 rounded p-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('poster') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-3 justify-end mt-6">
                    <a href="{{ route('movies.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>