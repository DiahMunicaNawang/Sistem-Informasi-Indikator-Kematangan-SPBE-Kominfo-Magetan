@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('article.index') }}" class="btn btn-light">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('page-name', 'Detail Artikel')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <style>
        /* Variabel CSS untuk tema terang */
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

        .star-icon {
            font-size: 1.2rem;
        }

        .list-group-item {
            background-color: var(--card-background-color);
            color: var(--text-color-muted);
            border-color: var(--border-color);
        }
    </style>

    <div class="container mt-5">
        <div class="content-container">
            <!-- Title -->
            <h2 class="text-center text-primary">{{ $artikel->title }}</h2>
            <p class="text-center">{{ $artikel->article_summary }}</p>
            <p class="text-center text-muted">
                {{ $artikel->user->username }} | {{ $artikel->category->category_name }} |
                {{ $artikel->created_at->format('Y-m-d H:i:s') }}
            </p>

            <!-- Gambar Artikel -->
            <div class="text-center mb-4">
                @php
                    $imageSrc = str_starts_with($artikel->image, 'http')
                        ? $artikel->image
                        : asset('storage/' . $artikel->image);
                @endphp
                <img src="{{ $imageSrc }}" class="img-fluid rounded" alt="Thumbnail Artikel" style="max-height: 400px;">
            </div>

            <!-- Konten Artikel -->
            <div class="article-content">
                {!! $artikel->article_content !!}
            </div>

            <!-- Indikator Terkait -->
            <div class="mt-5">
                <h5 class="text-primary">Indikator Terkait</h5>
                @if ($artikel->indikatorSpbes->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($artikel->indikatorSpbes as $indikator)
                            <li class="list-group-item">
                                {{ $indikator->name }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Tidak ada indikator terkait untuk artikel ini.</p>
                @endif
            </div>

            <!-- Rating Section -->
            <div class="mt-5">
                <h5 class="text-primary">Penilaian Artikel</h5>
                <div class="d-flex align-items-center flex-wrap">
                    <h3 class="mb-0 me-3">{{ number_format($artikel->ratings->avg('rating_value'), 1) }} dari 5</h3>

                    @php
                        $averageRating = $artikel->average_rating;
                        $fullStars = floor($averageRating);
                        $halfStar = $averageRating - $fullStars >= 0.5;
                    @endphp

                    <div>
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fas fa-star text-warning star-icon"></i>
                        @endfor
                        @if ($halfStar)
                            <i class="fas fa-star-half-alt text-warning star-icon"></i>
                        @endif
                        @for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                            <i class="far fa-star text-warning star-icon"></i>
                        @endfor
                    </div>


                    @if (auth()->id() != $artikel->user_id && session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'pengguna-terdaftar' || session('user_informations.role') === 'manajer-konten' && $artikel->article_status == 'published' && !$userRating)
                        <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#ratingModal">Tambah Penilaian</button>
                    @endif

                </div>

                <!-- User reviews -->
                @foreach ($artikel->ratings as $rating)
                    <div class="card m-4">
                        <div class="card-body">
                            <p>
                                <strong>{{ $rating->user->username }} @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star"
                                        style="color: {{ $i <= $rating->rating_value ? '#FFD700' : '#ccc' }};"></i>
                                @endfor</strong>
                                <br>
                                @if ($rating->rater_user_id == auth()->id())
                                    <strong>(Anda)</strong>
                                @endif
                                {{ $rating->rating_date}}
                                <br>

                            </p>
                            <p>{{ $rating->review ?? 'Tidak ada ulasan.' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal for Adding Rating -->
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Tambah Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('article.storeRating') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="rating" class="form-label">Pilih Rating</label>
                            <select name="rating" id="rating" class="form-select">
                                <option value="1">1 Bintang</option>
                                <option value="2">2 Bintang</option>
                                <option value="3">3 Bintang</option>
                                <option value="4">4 Bintang</option>
                                <option value="5">5 Bintang</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Ulasan</label>
                            <textarea name="review" id="review" class="form-control" rows="3" placeholder="Tulis ulasan Anda..."></textarea>
                        </div>
                        <input type="hidden" id="article_id" name="article_id" value="{{ $artikel->id }}">
                        <button type="submit" class="btn btn-primary w-100">Kirim Penilaian</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
