@extends('home')
@section('content')
<section class="min-h-screen p-6 flex items-center justify-center bg-gray-100">
    <div class="container max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form class="space-y-6" action="/buku" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-blue-900 uppercase">
                        Tambahkan Buku
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan isi detail buku yang akan ditambahkan
                    </p>
                </div>

                    <!-- Form Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul Buku -->
                        <div class="col-span-2">
                            <div class="relative border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                                    Judul Buku
                                </label>
                                <input type="text" name="nama" id="nama"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                    placeholder="Masukkan judul buku..." required />
                            </div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                        <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select name="kategori_id" id="kategori_id" required
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->kategori_id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Penulis -->
                    <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                        <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                        <input type="text" name="penulis" id="penulis"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Masukkan nama penulis" required />
                    </div>

                    <!-- Penerbit -->
                    <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                        <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-2">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Masukkan nama penerbit" required />
                    </div>

                    <!-- Harga -->
                    <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                        <input type="number" name="harga" id="harga"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Masukkan harga buku" required />
                    </div>

                    <!-- Stok -->
                    <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                        <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    </div>

                    <!-- Tanggal Terbit -->
                    <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                        <label for="tanggal_terbit" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Terbit</label>
                        <input datepicker datepicker-autohide type="text" name="tanggal_terbit" id="datepicker-input"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Pilih tanggal terbit" required />
                    </div>


                    <!-- Upload Gambar -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Sampul Buku
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <!-- Preview Image Container -->
                                <div id="imagePreview" class="hidden mb-3">
                                    <img id="preview" class="mx-auto h-32 w-auto" src="" alt="Preview">
                                    <button type="button" id="removeImage" class="mt-2 text-sm text-red-600 hover:text-red-500">
                                        Hapus Gambar
                                    </button>
                                </div>

                                <!-- Upload Icon -->
                                <div id="uploadIcon">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                        <span>Upload file</span>
                                        <input id="file-upload" name="gambar" type="file" accept="image/*" class="sr-only" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF sampai 10MB
                                </p>
                                <!-- Nama File -->
                                <p id="fileName" class="mt-2 text-sm text-gray-500"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" name="submit" value="save"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm font-medium text-white transition-colors duration-200">
                        Tambah Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script tidak diubah -->
</section>
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
@endsection
