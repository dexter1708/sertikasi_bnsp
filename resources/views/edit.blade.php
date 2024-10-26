@extends('home')
@section('content')
<section class="min-h-screen p-6 flex items-center justify-center bg-gray-100">
    <div class="container max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form class="space-y-6" action="/{{$buku->buku_id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-blue-900 uppercase">
                        Edit Detail Buku
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan isi detail buku yang akan diperbarui
                    </p>
                </div>

                <!-- Form Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul Buku -->
                    <div class="col-span-2">
                        <div class="relative">
                            <input type="text" name="nama" id="nama" value="{{$buku->nama}}"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder=" " required />
                            <label for="nama"
                                class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all">
                                Judul Buku
                            </label>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select name="kategori_id" id="kategori_id" required
                            class="w-full rounded-lg border-gray-300 px-4 py-3 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500">
                            @foreach ($kategori as $k)
                                <option value="{{ $k->kategori_id }}" {{ $buku->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <div class="relative">
                            <input type="text" name="penulis" id="penulis"  value="{{$buku->penulis}}"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500"
                                placeholder=" " required />
                            <label for="penulis"
                                class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Penulis
                            </label>
                        </div>
                    </div>

                    <!-- Penerbit -->
                    <div>
                        <div class="relative">
                            <input type="text" name="penerbit" id="penerbit"  value="{{$buku->penerbit}}"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500"
                                placeholder=" " required />
                            <label for="penerbit"
                                class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Penerbit
                            </label>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div>
                        <div class="relative">
                            <input type="number" name="harga" id="harga" value="{{$buku->harga}}"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500"
                                placeholder=" " required />
                            <label for="harga"
                                class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Harga
                            </label>
                        </div>
                    </div>

                    <!-- Stok -->
                    <div>
                        <div class="relative">
                            <input type="number" name="stok" id="stok" value="{{$buku->stok}}"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500"
                                placeholder=" " required />
                            <label for="stok"
                                class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Stok
                            </label>
                        </div>
                    </div>

                    <!-- Tanggal Terbit -->
                    <div>
                        <div class="relative space-x-4">
                            <input datepicker datepicker-autohide type="text" name="tanggal_terbit" id="datepicker-input" value="{{$buku->tanggal_terbit}}"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500"
                                placeholder="Tanggal Masuk" />
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-700" for="file_input">
                            Foto Sampul Buku
                        </label>

                        <!-- Image Preview -->
                        <div id="imagePreview">
                            @if ($buku->gambar)
                                <img id="preview" class="h-32 w-auto mb-2" src="{{ asset('storage/buku/'.$buku->gambar) }}" alt="Preview">
                            @else
                                <img id="preview" class="h-32 w-auto mb-2 hidden" src="" alt="Preview">
                            @endif
                            <button type="button" id="removeImage" class="text-sm text-red-600 hover:text-red-500">
                                Hapus Gambar
                            </button>
                        </div>

                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="file_input"
                            name="gambar"
                            type="file"
                            accept="image/*"
                        >
                        <p class="mt-1 text-xs text-gray-500">
                            PNG, JPG, GIF sampai 10MB
                        </p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" name="submit" value="save"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm font-medium text-white transition-colors duration-200">
                        Perbarui Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Kalender
        $(document).ready(function() {
            $('#datepicker-input').datepicker({
                dateFormat: 'yy-mm-dd',
                autoHide: true
            });
        });


        // Uploader
        document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('file-upload');
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        const uploadIcon = document.getElementById('uploadIcon');
        const removeButton = document.getElementById('removeImage');
        const fileNameDisplay = document.getElementById('fileName');

        // Fungsi untuk menampilkan preview
        function showPreview(file) {
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadIcon.classList.add('hidden');
                    fileNameDisplay.textContent = `File: ${file.name}`;
                }
                reader.readAsDataURL(file);
            }
        }

        // Event listener untuk file input
        input.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                showPreview(file);
            }
        });

        // Event listener untuk drag and drop
        const dropZone = input.closest('div');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];

            input.files = dt.files;
            showPreview(file);
        }

        // Event listener untuk tombol hapus
        removeButton.addEventListener('click', function() {
            input.value = '';
            preview.src = '';
            previewContainer.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
            fileNameDisplay.textContent = '';
        });
    });
    </script>
</section>
@endsection
