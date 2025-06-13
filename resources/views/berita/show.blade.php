<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Berita') }}
            </h2>
            <a href="{{ route('berita.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali ke Daftar Berita
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Judul Berita -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $berita->judul }}
                    </h1>

                    <!-- Info Penulis dan Tanggal -->
                    <div class="flex items-center text-gray-600 text-sm mb-6 pb-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Oleh: <strong>{{ $berita->penulis }}</strong></span>
                        </div>
                        <div class="flex items-center ml-6">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $berita->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                        @if($berita->created_at != $berita->updated_at)
                            <div class="flex items-center ml-6">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-orange-600">Diperbarui: {{ $berita->updated_at->format('d F Y, H:i') }} WIB</span>
                            </div>
                        @endif
                    </div>

                    <!-- Admin Actions -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="flex gap-3 mb-6 p-4 bg-gray-50 rounded-lg">
                            <a href="{{ route('berita.edit', $berita) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                                Edit Berita
                            </a>
                            <form action="{{ route('berita.destroy', $berita) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 012 0v4a1 1 0 11-2 0V7zM12 7a1 1 0 012 0v4a1 1 0 11-2 0V7z" clip-rule="evenodd"></path>
                                    </svg>
                                    Hapus Berita
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Foto Berita -->
                    @if($berita->foto)
                        <div class="mb-8">
                            <img src="{{ Storage::url($berita->foto) }}" 
                                 alt="{{ $berita->judul }}" 
                                 class="w-full max-w-4xl mx-auto rounded-lg shadow-lg">
                        </div>
                    @endif

                    <!-- Isi Berita -->
                    <div class="prose max-w-none">
                        <div class="text-gray-800 leading-relaxed text-lg">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('berita.index') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                </svg>
                                Kembali ke Daftar Berita
                            </a>
                            
                            <div class="text-sm text-gray-500">
                                <p>Dibaca pada {{ now()->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>