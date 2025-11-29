<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Film</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow flex flex-col md:flex-row gap-8">
                
                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $movie->poster) }}" class="w-full rounded-lg shadow-lg">
                        <div class="absolute bottom-4 right-4 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full flex items-center gap-1">
                            <span class="text-yellow-400 text-xl">★</span>
                            <span class="font-bold text-lg">{{ round($movie->reviews->avg('rating'), 1) ?? '0.0' }}</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-2/3">
                    <div class="mb-6">
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $movie->title }}</h1>
                        <div class="flex items-center gap-4 text-gray-500 mb-4">
                            <span class="bg-gray-200 px-3 py-1 rounded text-sm font-bold">{{ $movie->year }}</span>
                            <span>{{ $movie->reviews->count() }} Ulasan</span>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $movie->synopsis }}</p>
                    </div>

                    <hr class="border-gray-200 my-8">

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 mb-8">
                        <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                            <span>✍️</span> Tulis Ulasan Kamu
                        </h3>
                        <form action="{{ route('movies.review.store', $movie->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                <select name="rating" class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500">
                                    <option value="5">⭐⭐⭐⭐⭐ (Sempurna)</option>
                                    <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                    <option value="3">⭐⭐⭐ (Biasa)</option>
                                    <option value="2">⭐⭐ (Kurang)</option>
                                    <option value="1">⭐ (Buruk)</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                                <textarea name="review" rows="3" class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500" placeholder="Ceritakan pendapatmu..." required></textarea>
                            </div>
                            <button class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 font-bold transition w-full md:w-auto">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>

                    <h3 class="text-xl font-bold mb-4">Apa Kata Mereka?</h3>
                    <div class="space-y-4">
                        @forelse($movie->reviews as $review)
                            <div class="border-b border-gray-100 pb-4 last:border-0">
                                <div class="flex justify-between items-start mb-1">
                                    <div>
                                        <span class="font-bold text-gray-900">{{ $review->user->name }}</span>
                                        <span class="text-xs text-gray-400 block">{{ $review->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="text-yellow-400 text-sm tracking-widest">
                                        @for($i=1; $i<=5; $i++)
                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-2">{{ $review->review }}</p>
                            </div>
                        @empty
                            <p class="text-gray-400 italic">Belum ada ulasan. Jadilah yang pertama!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>