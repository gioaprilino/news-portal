<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div class="mb-6">
                            <label for="judul" class="block mb-2 text-sm font-medium text-gray-900">
                                Judul Berita <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   id="judul" 
                                   value="{{ old('judul', $berita->judul) }}"
                                   @class([
                                       'bg-gray-50', 'text-gray-900', 'text-sm', 'rounded-lg',
                                       'focus:ring-blue-500', 'focus:border-blue-500', 'block', 'w-full', 'p-2.5',
                                       'border',
                                       'border-red-500' => $errors->has('judul'),
                                       'border-gray-300' => !$errors->has('judul'),
                                   ])
                                   placeholder="Masukkan judul berita (minimal 25 karakter)"
                                   required>
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Saat Ini -->
                        @if($berita->foto)
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900">
                                    Foto Saat Ini
                                </label>
                                <img src="{{ Storage::url($berita->foto) }}" 
                                     alt="{{ $berita->judul }}" 
                                     class="max-w-xs h-auto rounded-lg shadow-md">
                            </div>
                        @endif

                        <!-- Foto Baru -->
                        <div class="mb-6">
                            <label for="foto" class="block mb-2 text-sm font-medium text-gray-900">
                                Ganti Foto (Opsional)
                            </label>
                            <input type="file" 
                                   name="foto" 
                                   id="foto" 
                                   accept="image/jpeg,image/png,image/jpg"
                                   @class([
                                       'bg-gray-50', 'text-gray-900', 'text-sm', 'rounded-lg',
                                       'focus:ring-blue-500', 'focus:border-blue-500', 'block', 'w-full', 'p-2.5',
                                       'border',
                                       'border-red-500' => $errors->has('foto'),
                                       'border-gray-300' => !$errors->has('foto'),
                                   ])>
                            <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengganti foto. Format: JPEG, PNG, JPG. Maksimal 2MB.</p>
                            @error('foto')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Isi Berita -->
                        <div class="mb-6">
                            <label for="isi" class="block mb-2 text-sm font-medium text-gray-900">
                                Isi Berita <span class="text-red-500">*</span>
                            </label>
                            <textarea name="isi" 
                                      id="isi" 
                                      rows="10"
                                      @class([
                                          'bg-gray-50', 'text-gray-900', 'text-sm', 'rounded-lg',
                                          'focus:ring-blue-500', 'focus:border-blue-500', 'block', 'w-full', 'p-2.5',
                                          'border',
                                          'border-red-500' => $errors->has('isi'),
                                          'border-gray-300' => !$errors->has('isi'),
                                      ])
                                      placeholder="Tulis isi berita di sini..."
                                      required>{{ old('isi', $berita->isi) }}</textarea>
                            @error('isi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info Penulis -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Penulis
                            </label>
                            <p class="text-sm text-gray-600">{{ $berita->penulis }}</p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-4">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Berita
                            </button>
                            <a href="{{ route('berita.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview gambar sebelum upload
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const existingPreview = document.getElementById('foto-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }

                    const preview = document.createElement('div');
                    preview.id = 'foto-preview';
                    preview.className = 'mt-2';
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="max-w-xs h-auto rounded-lg shadow-md">
                        <p class="text-sm text-gray-600 mt-1">Preview foto baru</p>
                    `;

                    document.getElementById('foto').parentNode.appendChild(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
