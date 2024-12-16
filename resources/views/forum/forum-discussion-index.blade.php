@extends('layouts.main.index')

@section('content')
    <div class="container py-4">
        {{-- Header Section --}}
        <h1 class="mb-4 text-center fs-1 text-primary">Jelajahi Forum</h1>

        {{-- Action Buttons and Search --}}
        <div class="mb-4 row g-3 align-items-center">
            @if (session('user_informations.role') !== 'pengguna-umum')
                <div class="col-12 col-md-auto">
                    <a href="{{ route('forum-discussion.create') }}" class="btn-sm btn btn-light-success w-100">
                        <i class="bi bi-plus-circle me-2"></i>Ajukan Pertanyaan
                    </a>
                </div>
                <div class="col-12 col-md-auto">
                    <a href="{{ route('forum-discussion-approval-user') }}" class="btn-sm btn btn-light-primary w-100">
                        <i class="bi bi-list-ul me-2"></i>Lihat Pertanyaan Saya
                    </a>
                </div>
            @endif
            @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                <div class="col-12 col-md-auto">
                    <a href="{{ route('forum-category.index') }}" class="btn-sm btn btn-light-danger w-100">
                        <i class="bi bi-tags me-2"></i>Kategori Forum
                    </a>
                </div>
                <div class="col-12 col-md-auto">
                    <a href="{{ route('forum-discussion-approval-process') }}" class="btn-sm btn btn-light-success w-100">
                        <i class="bi bi-check-circle me-2"></i>Verifikasi Forum
                    </a>
                </div>
            @endif
            <div class="col-12 col-md">
                <form method="GET" action="{{ route('forum-discussion.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Pertanyaan"
                            value="{{ request('search') }}">
                        <button class="btn-sm btn btn-primary" type="submit">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Discussions List --}}
        <div class="row g-4">
            @if ($forum_discussions->isEmpty())
                <div class="col-12">
                    <div class="py-5 text-center rounded bg-light">
                        <i class="mb-3 bi bi-inbox display-1 text-muted"></i>
                        <p class="text-muted">Tidak ada diskusi yang ditemukan.</p>
                    </div>
                </div>
            @else
                <article class="gap-3 mt-6 d-flex flex-column">
                    @foreach ($forum_discussions as $forum_discussion)
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="shadow-sm card h-100 hover-shadow">
                                    <div class="card-body">
                                        {{-- Discussion Header --}}
                                        <div class="mb-3 d-flex justify-content-between align-items-start">
                                            <div class="gap-3 d-flex">
                                                <div class="position-relative">
                                                    <div class="symbol symbol-45px me-2">
                                                        <img src="{{ asset('assets/media/avatars/300-1.jpg') }}"
                                                            class="rounded-circle"
                                                            alt="{{ $forum_discussion->user->username }}"
                                                            style="width: 45px; height: 45px; object-fit: cover;">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $forum_discussion->user->username }}</h6>

                                                    <div class="gap-2 d-flex align-items-center">
                                                        <small class="text-muted">
                                                            <i class="bi bi-clock me-1"></i>
                                                            {{ \Carbon\Carbon::parse($forum_discussion->discussion_created_at)->format('H:i - d M Y') }}
                                                        </small>

                                                        {{-- Status Diskusi --}}
                                                        <span
                                                            class="badge {{ $forum_discussion->availability_status == 'open' ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }}"
                                                            style="font-size: 0.8rem; padding: 0.35em 0.8em;">
                                                            <i
                                                                class="bi {{ $forum_discussion->availability_status == 'open' ? 'bi-unlock text-success' : 'bi-lock text-danger' }} me-1"></i>
                                                            {{ $forum_discussion->availability_status == 'open' ? 'Diskusi Aktif' : 'Diskusi Ditutup' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Discussion Content --}}
                                        <div class="mb-3">
                                            <div class="gap-3 d-flex align-items-center">
                                                <h5 class="m-0 card-title">{{ $forum_discussion->title }}</h5>
                                                <span class="gap-1 badge bg-light text-primary d-flex align-items-center">
                                                    {{-- <i class="bi bi-tag text-primary"></i> --}}
                                                    {{ $forum_discussion->forum_category->name }}
                                                </span>
                                            </div>
                                            
                                            <p class="mt-2 card-text text-muted">
                                                {{ $forum_discussion->short_description }}
                                            </p>

                                            @foreach ($forum_discussion->indikators as $indikator)
                                                <span class="gap-1 badge bg-light text-muted align-items-center">
                                                    <i class="bi bi-link-45deg text-muted"></i>
                                                    {{ $indikator->name }}
                                                </span>
                                            @endforeach
                                        </div>

                                        {{-- Discussion Footer --}}
                                        <div class="pt-3 d-flex justify-content-between align-items-center border-top">
                                            <div class="text-muted small">
                                                <i class="bi bi-chat-dots me-1"></i>
                                                {{ $forum_discussion->responses_count ?? 0 }} Tanggapan
                                            </div>
                                            <div class="gap-1 d-flex">
                                                <a href="{{ route('forum-discussion.show', $forum_discussion->id) }}"
                                                    class="gap-1 px-3 btn btn-primary btn-sm d-flex align-items-center"
                                                    style="background: linear-gradient(135deg, #007bff, #0056b3); transition: 0.3s;"
                                                    onmouseover="this.style.filter='brightness(1.2)'"
                                                    onmouseout="this.style.filter='brightness(1)'">
                                                    <i class="bi bi-book"></i> Baca Selengkapnya
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </article>

                {{-- Pagination --}}
                <div class="col-12">
                    <nav class="mt-4" aria-label="Forum pagination">
                        {{ $forum_discussions->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
