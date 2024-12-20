@extends('layouts.main.index')

@section('back-button')
    <a href="{{ url()->previous() }}">
        <i class="bi bi-arrow-left-square-fill text-muted" style="font-size: 34px"></i>
    </a>
@endsection

@section('page-name')
    <h1 class="text-center ">Validasi Artikel: {{ $article->title }}</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <style>
        :root {
            --background-color: #f8f9fa;
            --text-color-primary: #0d6efd;
            --text-color-custom: #6c757d;
            --card-background-color: #ffffff;
            --border-color: #ced4da;
        }

        [data-theme="dark"] {
            --background-color: #1c1f24;
            --text-color-primary: #5aa9e6;
            --text-color-custom: #b0b3b8;
            --card-background-color: #2a2d31;
            --border-color: #444851;
        }

        .list-group-item {
            background-color: var(--card-background-color);
            color: var(--text-color-muted);
            border-color: var(--border-color);
        }

        .content-container {
            background-color: var(--background-color);
            color: var(--text-color-muted);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .status-indicator {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
        }

        .status-proses {
            background-color: #ffecb3;
            color: #856404;
        }

        .status-published {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn-primary:hover {
            background-color: #0048a1;
        }
    </style>

    <div class="container mt-5">
        <div class="content-container">
            <!-- Title -->
            <h2 class="text-center text-primary">{{ $article->title }}</h2>
            <p class="text-center">{{ $article->article_summary }}</p>
            <p class="text-center text-muted">{{ $article->user->username }} | {{ $article->category->category_name }} |
                {{ $article->created_at->format('Y-m-d H:i:s') }}
            </p>

            <!-- Indikator Status -->
            <div class="text-center mb-4">
                @php
                    $statusClass = match ($article->article_status) {
                        'proses' => 'status-proses',
                        'published' => 'status-published',
                        'rejected' => 'status-rejected',
                        default => 'status-proses',
                    };
                @endphp
                <span class="status-indicator {{ $statusClass }}">
                    {{ ucfirst($article->article_status) }}
                </span>
            </div>

            <!-- Gambar Artikel -->
            <div class="text-center mb-4">
                @php
                    $imageSrc = str_starts_with($article->image, 'http')
                        ? $article->image
                        : asset('storage/' . $article->image);
                @endphp
                <img src="{{ $imageSrc }}" class="img-fluid rounded shadow" alt="Thumbnail Artikel"
                    style="max-height: 400px;">
            </div>

            <!-- Konten article -->
            <div class="article-content">
                {!! $article->article_content !!}
            </div>

            <div class="mt-5">
                <h5 class="text-primary">Indikator Terkait</h5>
                @if ($article->indikatorSpbes->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($article->indikatorSpbes as $indikator)
                            <li class="list-group-item">
                                {{ $indikator->name }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Tidak ada indikator terkait untuk artikel ini.</p>
                @endif
            </div>

            <!-- Form Validasi -->
            <div class="mt-4">
                <form action="{{ route('article.storeValidation', $article->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="validation_status" class="fw-bold">Status Validasi:</label>
                        <select name="validation_status" id="validation_status" class="form-control" required>
                            <option value="proses" {{ $article->article_status == 'proses' ? 'selected' : '' }}>Proses
                            </option>
                            <option value="published" {{ $article->article_status == 'published' ? 'selected' : '' }}>
                                Disetujui</option>
                            <option value="rejected" {{ $article->article_status == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="comments" class="fw-bold">Komentar (Opsional):</label>
                        <textarea name="comments" id="comments" class="form-control" rows="4"
                            placeholder="Tambahkan komentar jika perlu">

                        </textarea>
                    </div>

                    <input type="hidden" id="article_id" name="article_id" value="{{ $article->id }}">

                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
