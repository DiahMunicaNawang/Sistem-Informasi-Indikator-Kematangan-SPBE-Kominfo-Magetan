@extends('layouts.main.index')

@section('back-button')
    <a href="{{ url()->previous() }}">
        <i class="bi bi-arrow-left-square-fill text-muted" style="font-size: 34px"></i>
    </a>
@endsection

@section('page-name', 'Edit Artikel')

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
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-5">
        <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control"
                    value="{{ old('judul', $article->title) }}">
            </div>

            <!-- Ringkasan Artikel -->
            <div class="mb-3">
                <label for="ringkasan" class="form-label">Ringkasan Artikel</label>
                <input type="text" name="ringkasan" id="ringkasan" class="form-control"
                    value="{{ old('ringkasan', $article->article_summary) }}">
            </div>

            <!-- Konten -->
            <div class="mb-3">
                <label for="konten" class="form-label">Konten</label>
                <textarea name="konten" id="konten" class="form-control" rows="10">{{ old('konten', $article->article_content) }}</textarea>
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
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select">
                    @foreach ($article_category as $data)
                        <option value="{{ $data->id }}" {{ $article->category_id == $data->id ? 'selected' : '' }}>
                            {{ $data->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Indikator Terkait -->
            <div class="mb-3">
                <label for="indikator" class="required form-label">Indikator Terkait</label>
                <select name="indikator[]" id="indikator" class="form-control" multiple="multiple">
                    @foreach ($indikatorSpbe as $indikator)
                        <option value="{{ $indikator->id }}"
                            {{ in_array($indikator->id, $article->indikatorSpbes->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $indikator->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Image Thumbnail -->
            <div class="mb-3">
                <label for="image" class="form-label">Image thumbnail</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($article->image)
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" width="150">
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#indikator').select2({
                placeholder: 'Pilih indikator terkait',
                allowClear: true
            });
        });
    </script>
@endsection
