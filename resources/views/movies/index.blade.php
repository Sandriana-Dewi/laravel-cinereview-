<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Katalog Film</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-6">
                
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('movies.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        + Tambah Film
                    </a>
                @else
                    <div></div> @endif

                <input type="text" id="search-input" placeholder="Cari judul film..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div id="movie-container">
                @include('movies.partials.list', ['movies' => $movies])
            </div>
            
            <div class="mt-4">{{ $movies->links() }}</div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#search-input').on('keyup', function() {
            $.get("{{ route('movies.search') }}", {query: $(this).val()}, function(data) {
                $('#movie-container').html(data);
            });
        });
    </script>
</x-app-layout>