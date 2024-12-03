@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('article.index') }}">
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
            --background-color: #e0f1ff;
            --text-color-primary: #0d6efd;
            --text-color-muted: #6c757d;
            --card-background-color: #ffffff;
            --modal-background-color: #ffffff;
            --border-color: #ced4da;
        }

        .article-content {
            word-wrap: break-word;
            /* Bungkus kata panjang */
            overflow-wrap: anywhere;
            /* Alternatif jika tidak terbungkus */
            white-space: normal;
            /* Pastikan teks tidak memaksa dalam satu baris */
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
            <h2 class="text-center text-primary">{{ $artikel->title }}</h2>
            <p class="text-center text-muted">{{ $artikel->article_summary }}</p>
            <p class="text-center text-muted">{{ $artikel->user->username }} | {{ $artikel->created_at->format('d M Y') }} |
                {{ $artikel->category->category_name }}
            </p>

            <!-- Image -->
            <div class="text-center mb-4">
                @php
                    if (str_starts_with($artikel->image, 'http')) {
                        $imageSrc = $artikel->image;
                    } else {
                        $imageSrc = asset('storage/' . $artikel->image);
                    }
                @endphp
                <img src="{{ $imageSrc }}" class="img-fluid rounded" alt="Article Thumbnail">
            </div>

            <!-- Konten Artikel -->
            <div class="article-content">
                {!! $artikel->article_content !!}
            </div>



            <!-- Rating Section , pengguna umum tidak bisa menilai-->
            <div class="mt-5">
                <h5 class="text-primary">Penilaian Artikel</h5>
                <div class="d-flex align-items-center mb-2">
                    <h3 class="mb-0">{{ number_format($artikel->ratings->avg('rating_value'), 1) }} dari 5</h3>

                    @php
                        $averageRating = $artikel->average_rating;
                        $fullStars = floor($averageRating); // Bintang penuh
                        $halfStar = $averageRating - $fullStars >= 0.5; // Setengah bintang
                    @endphp

                    <!-- Display stars -->
                    <div class="ms-3">
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
                    @if (auth()->user() && auth()->user()->role_id != 4 && $artikel->article_status == "published")
                        @if (!$userRating)
                            <!-- Tombol untuk menambah penilaian jika user belum memberikan penilaian -->
                            <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#ratingModal">Tambah
                                Penilaian</button>
                        @endif
                    @endif

                </div>

                <!-- User reviews -->
                @foreach ($artikel->ratings as $rating)
                    <div class="card mb-3">
                        <div class="card-body">
                            <p>
                                <strong>{{ $rating->user->username }}</strong>
                                @if ($rating->rater_user_id == auth()->id())
                                    <strong>(anda)</strong>
                                @endif
                                <br>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating_value)
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <!-- Bintang berwarna emas -->
                                    @else
                                        <i class="fas fa-star" style="color: #ccc;"></i>
                                        <!-- Bintang berwarna abu-abu -->
                                    @endif
                                @endfor

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
