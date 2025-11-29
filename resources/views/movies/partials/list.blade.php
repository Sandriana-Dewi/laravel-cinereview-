<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @forelse ($movies as $movie)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-64 object-cover">
            
            <div class="p-4">
                <h3 class="font-bold text-lg mb-1">{{ $movie->title }}</h3>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                    {{ $movie->year }}
                </span>
                <p class="text-gray-600 text-sm mt-2 line-clamp-3">
                    {{ Str::limit($movie->synopsis, 60) }}
                </p>
            </div>
        </div>
    @empty
        <div class="col-span-4 text-center py-10 text-gray-500">
            Tidak ada film yang ditemukan.
        </div>
    @endforelse
</div>