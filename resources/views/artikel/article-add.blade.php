@extends('layouts.main.index')

@section('page-name', 'Buat Artikel')

@section('content')
    <style>
        /* Default light theme variables */
        :root {
            --ck-bg-color: #fff;
            --ck-text-color: #000;
            --ck-border-color: #ccc;
            --ck-toolbar-bg-color: #f5f5f5;
            --ck-toolbar-border-color: #ddd;
            --ck-toolbar-button-color: #333;
        }

        /* Dark theme variables */
        [data-theme="dark"] {
            --ck-bg-color: #333;
            --ck-text-color: #fff;
            --ck-border-color: #444;
            --ck-toolbar-bg-color: #222;
            --ck-toolbar-border-color: #555;
            --ck-toolbar-button-color: #555;
        }

        /* Styling for CKEditor editable area */
        .ck-editor__editable {
            background-color: var(--ck-bg-color) !important;
            color: var(--ck-text-color) !important;
            border: 1px solid var(--ck-border-color) !important;
        }

        /* Styling for CKEditor toolbar */
        .ck.ck-toolbar {
            background-color: var(--ck-toolbar-bg-color) !important;
            border: 1px solid var(--ck-toolbar-border-color) !important;
        }

        /* Styling for CKEditor toolbar buttons */
        .ck.ck-toolbar button {
            color: var(--ck-toolbar-button-color) !important;
        }

        .ck.ck-toolbar button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>

    <div class="container mt-5">
        <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Judul -->
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan Judul Artikel">
            </div>

            <!-- Ringkasan Artikel -->
            <div class="mb-3">
                <label for="ringkasan" class="form-label">Ringkasan Artikel</label>
                <input type="text" name="ringkasan" id="ringkasan" class="form-control"
                    placeholder="Masukkan Ringkasan Artikel">
            </div>

            <!-- Konten -->
            <div class="mb-3">
                <label for="konten" class="form-label">Konten</label>
                <textarea name="konten" id="konten" class="form-control" rows="10"
                    placeholder="Masukkan konten artikel di sini"></textarea>
            </div>
            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create(document.querySelector('#konten'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            <!-- Kategori -->
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select">
                    <option value="">Cari Kategori</option>
                    <option value="1">Perencanaan dan Implementasi Manajemen Perubahan</option>
                    <option value="2">Penyelarasan Strategi dan Kebijakan SPBE</option>
                    <option value="3">Pendidikan dan Pelatihan Pengguna SPBE</option>
                    <option value="4">Keterlibatan Stakeholder dalam SPBE</option>
                    <option value="5">Evaluasi dan Monitoring Implementasi SPBE</option>
                    <option value="6">Perubahan Organisasi untuk Mendorong SPBE</option>
                    <option value="7">Peran Teknologi dalam Meningkatkan Kinerja Pemerintahan</option>
                    <option value="8">Strategi Inovasi dalam Transformasi Digital Pemerintahan</option>
                    <option value="9">Pengelolaan Risiko dalam SPBE</option>
                    <option value="10">Komunikasi dan Sosialisasi Implementasi SPBE</option>
                    <option value="11">Sustainabilitas SPBE dalam Pemerintahan</option>
                    <option value="12">Best Practices dalam Manajemen Perubahan SPBE</option>
                </select>
            </div>

            <!-- Image Thumbnail -->
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Image thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Ajukan Artikel</button>
        </form>
    </div>
@endsection
