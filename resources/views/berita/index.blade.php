<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Berita') }}
            </h2>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('berita.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Berita
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($berita->count() > 0)
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($berita as $item)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                    @if ($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                                            class="w-full h-48 object-cover">
                                    @endif

                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-2">{{ $item->judul }}</h3>
                                        <p class="text-gray-600 text-sm mb-2">
                                            Oleh: {{ $item->penulis }} |
                                            {{ $item->created_at->format('d M Y') }}
                                        </p>
                                        <p class="text-gray-700 mb-4">
                                            {{ Str::limit(strip_tags($item->isi), 100) }}
                                        </p>

                                        <div class="flex justify-between items-center">
                                            <a href="{{ route('berita.show', $item) }}"
                                                class="text-blue-500 hover:text-blue-700">
                                                Baca Selengkapnya
                                            </a>

                                            @if (auth()->user()->role === 'admin')
                                                <div class="flex items-center gap-3">
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('berita.edit', $item) }}"
                                                        class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 ease-in-out">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('berita.destroy', $item) }}" method="POST"
                                                        onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus berita ini?\n\nTindakan ini tidak dapat dibatalkan!')"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">Belum ada berita yang tersedia.</p>
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('berita.create') }}"
                                    class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Tambah Berita Pertama
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
