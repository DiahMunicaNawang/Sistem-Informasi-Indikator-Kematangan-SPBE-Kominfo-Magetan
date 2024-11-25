@extends('layouts.main.index')

@section('back-button')
    <a href="{{ url()->previous() }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('page-name')
    <h1>Validasi Artikel: {{ $article->title }}</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <style>
        /* Variabel CSS untuk tema terang */
        :root {
            --background-color: #e0f1ff;
            --text-color-primary: #0d6efd;
            --text-color-muted: #6c757d;
            --card-background-color: #ffffff;
            --modal-background-color: #ffffff;
            --border-color: #ced4da;
        }

        /* Variabel CSS untuk tema gelap */
        [data-theme="dark"] {
            --background-color: #1c1f24;
            --text-color-primary: #5aa9e6;
            --text-color-muted: #b0b3b8;
            --card-background-color: #2a2d31;
            --modal-background-color: #2a2d31;
            --border-color: #444851;
        }

        /* Styling elemen dengan variabel CSS */
        .content-container {
            background-color: var(--background-color);
            color: var(--text-color-muted);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2.text-primary {
            color: var(--text-color-primary) !important;
        }

        .text-muted {
            color: var(--text-color-muted) !important;
        }

        .btn-outline-secondary {
            color: var(--text-color-primary);
            border-color: var(--border-color);
            transition: 0.3s;
        }

        .btn-outline-secondary:hover {
            background-color: var(--text-color-primary);
            color: white;
        }

        .btn-primary {
            background-color: var(--text-color-primary);
            border-color: var(--text-color-primary);
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #0048a1;
        }

        .article-content {
            word-wrap: break-word;
            /* Bungkus kata panjang */
            overflow-wrap: anywhere;
            /* Alternatif jika tidak terbungkus */
            white-space: normal;
            /* Pastikan teks tidak memaksa dalam satu baris */
        }

        /* Modal background */
        .modal-content {
            background-color: var(--modal-background-color);
            color: var(--text-color-muted);
        }

        .star-icon {
            font-size: 1.2rem;
        }
    </style>



    <div class="container mt-5">
        <div class="content-container">
            <!-- Title -->
            <h2 class="text-center text-primary">{{ $article->title }}</h2>
            <p class="text-center text-muted">{{ $article->article_summary }}</p>
            <p class="text-center text-muted">{{ $article->user->username }} | {{ $article->created_at->format('d M Y') }} |
                {{ $article->category->category_name }}
            </p>

            <!-- Image -->
            <div class="text-center mb-4">
                @php
                    if (str_starts_with($article->image, 'http')) {
                        $imageSrc = $article->image;
                    } else {
                        $imageSrc = asset('storage/' . $article->image);
                    }
                @endphp
                <img src="{{ $imageSrc }}" class="img-fluid rounded" alt="Article Thumbnail">
            </div>

            <!-- Konten article -->
            <div class="article-content">
                {!! $article->article_content !!}
            </div>
            <div class="mt-2">
                <form action="{{ route('article.storeValidation', $article->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="validation_status">Status Validasi:</label>
                        <select name="validation_status" id="validation_status" class="form-control" required>
                            <option value="proses">Proses</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comments">Komentar (Opsional):</label>
                        <textarea name="comments" id="comments" class="form-control" rows="4"></textarea>
                    </div>

                    <input type="hidden" id="article_id" name="article_id" value="{{ $article->id }}">

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        @endsection
