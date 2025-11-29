<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @forelse ($movies as $movie)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow border border-gray-200 flex flex-col h-full relative group">
            
            <a href="{{ route('movies.show', $movie->id) }}" class="relative block">
                @if($movie->year == date('Y'))
                    <span class="absolute top-2 left-2 text-white text-xs font-bold px-2 py-1 rounded shadow z-10" style="background-color: #dc2626;">
                        NEW
                    </span>
                @endif

                <img src="{{ asset('storage/' . $movie->poster) }}" class="w-full h-64 object-cover group-hover:opacity-90 transition">
            </a>
            
            <div class="p-4 flex-grow">
                <a href="{{ route('movies.show', $movie->id) }}" class="font-bold text-lg hover:text-blue-600 block mb-1 leading-tight">
                    {{ $movie->title }}
                </a>
                
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-500 text-sm">{{ $movie->year }}</span>
                    
                    @php $avgRating = round($movie->reviews->avg('rating')); @endphp
                    <div class="text-sm" style="color: #fbbf24;"> @for($i = 1; $i <= 5; $i++)
                            <span>{{ $i <= $avgRating ? '★' : '☆' }}</span>
                        @endfor
                        <span class="text-gray-400 text-xs">({{ $movie->reviews->count() }})</span>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role === 'admin')
                <div class="p-3 mt-auto border-t border-gray-100 bg-gray-50">
                    <div class="flex gap-2">
                        
                        <a href="{{ route('movies.edit', $movie->id) }}" 
                           class="flex-1 text-white text-center py-2 rounded transition font-bold text-xs hover:opacity-80"
                           style="background-color: #2563eb;"> EDIT
                        </a>

                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin hapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full text-white py-2 rounded transition font-bold text-xs hover:opacity-80"
                                    style="background-color: #dc2626;"> HAPUS
                            </button>
                        </form>

                    </div>
                </div>
            @endif

        </div>
    @empty
        <div class="col-span-4 text-center py-12">
            <div class="text-gray-300 text-6xl mb-4">🎬</div>
            <p class="text-xl text-gray-500 font-medium">Belum ada film yang tersedia.</p>
        </div>
    @endforelse
</div>