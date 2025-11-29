<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Film</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label>Judul</label>
                    <input type="text" name="title" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label>Tahun</label>
                    <input type="number" name="year" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label>Sinopsis</label>
                    <textarea name="synopsis" class="w-full border p-2 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label>Poster</label>
                    <input type="file" name="poster" class="w-full" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>