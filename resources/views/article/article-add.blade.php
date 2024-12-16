`@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('article.index') }}" class="btn btn-light">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('page-name', 'Buat Artikel')



@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
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
                <input type="text" name="judul" id="judul" class="form-control"
                    placeholder="Masukkan Judul Artikel">
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
                    .create(document.querySelector('#konten'), {
                        toolbar: [
                            'heading', '|', 'bold', 'italic', 'link',
                            'bulletedList', 'numberedList', 'blockQuote'
                        ]
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            <!-- Kategori -->
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori
                    @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                        | <a href="{{ route('article.createCategory') }}"">Add Category</a>
                    @endif
                </label>
                <select name="kategori" id="kategori" class="form-select">
                    @foreach ($artikel_category as $data)
                        <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Indikator Terkait -->
            <div class="mb-3">
                <label for="indikator" class="required form-label">Indikator Terkait</label>
                <select name="indikator[]" id="indikator" class="form-control" multiple="multiple">
                    @foreach ($indikatorSpbe as $indikator)
                        <option value="{{ $indikator->id }}"
                            {{ in_array($indikator->id, old('indikator', $indikatorOld)) ? 'selected' : '' }}>
                            {{ $indikator->name }}
                        </option>
                    @endforeach
                </select>
                @error('indikator')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Thumbnail -->
            <div class="mb-3">
                <label for="image" class="form-label">Image thumbnail</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#indikator').select2({
                placeholder: 'Pilih indikator terkait',
                allowClear: true
            });
        });
    </script>
@endsection
