<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <a href="{{ route('movies.create') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition">
                    + Tambah Film
                </a>

                <div class="w-full md:w-1/3">
                    <input type="text" id="search-input" placeholder="Cari judul film..." 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div id="movie-container">
                @include('movies.partials.list', ['movies' => $movies])
            </div>

            <div class="mt-6">
                {{ $movies->links() }}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Saat user mengetik di kolom search...
            $('#search-input').on('keyup', function() {
                var query = $(this).val(); // Ambil teks yang diketik

                // Kirim request ke server (tanpa reload halaman)
                $.ajax({
                    url: "{{ route('movies.search') }}",
                    type: "GET",
                    data: {'query': query},
                    success: function(data) {
                        // Ganti isi container dengan hasil pencarian baru
                        $('#movie-container').html(data);
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr);
                    }
                });
            });
        });
    </script>
</x-app-layout>