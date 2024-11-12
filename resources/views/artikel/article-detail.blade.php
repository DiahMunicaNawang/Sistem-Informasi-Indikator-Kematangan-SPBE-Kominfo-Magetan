@extends('layouts.main.index')

@section('page-name', 'Detail Artikel')

@section('content')
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
    .container .p-4 {
        background-color: var(--background-color);
        color: var(--text-color-muted);
    }

    h2.text-primary {
        color: var(--text-color-primary) !important;
    }

    p.text-muted {
        color: var(--text-color-muted) !important;
    }

    .btn-outline-secondary {
        color: var(--text-color-primary);
        border-color: var(--border-color);
    }

    .btn-outline-secondary:hover {
        background-color: var(--text-color-primary);
        color: white;
    }

    .btn-primary {
        background-color: var(--text-color-primary);
        border-color: var(--text-color-primary);
    }

    .btn-primary:hover {
        background-color: darken(var(--text-color-primary), 10%);
    }

    /* Modal background */
    .modal-content {
        background-color: var(--modal-background-color);
        color: var(--text-color-muted);
    }
</style>

<div class="container mt-5">
    <div class="p-4 rounded-3">
        <!-- Title -->
        <h2 class="text-center text-primary">Lorem ipsum</h2>
        <p class="text-center text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <p class="text-center text-muted">Dr. Gabriela Florencia | Halodoc | 2024-06-11 04:05:28</p>

        <!-- Image -->
        <div class="text-center mb-4">
            <img src="/path/to/image.jpg" class="img-fluid rounded" alt="Article Thumbnail">
        </div>

        <!-- Article Content -->
        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book...</p>

        <!-- Rating Section -->
        <div class="mt-5">
            <h5 class="text-primary">Penilaian Artikel</h5>
            <p>4 dari 5</p>
            <div class="d-flex align-items-center mb-3">
                <span class="text-warning fs-5">★ ★ ★ ★ ☆</span>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm">Semua</button>
                <button class="btn btn-outline-secondary btn-sm">1 bintang</button>
                <button class="btn btn-outline-secondary btn-sm">2 bintang</button>
                <button class="btn btn-outline-secondary btn-sm">3 bintang</button>
                <button class="btn btn-outline-secondary btn-sm">4 bintang (4)</button>
                <button class="btn btn-outline-secondary btn-sm">5 bintang (1)</button>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ratingModal">Tambah Penilaian</button>
            </div>
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
                <form action="{{ route('article.addRating') }}" method="POST">
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
                    <button type="submit" class="btn btn-primary w-100">Kirim Penilaian</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
