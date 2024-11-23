@extends('layouts.main.index')

@section('page-name', 'Indikator 26: Manajemen Pengetahuan')

@section('content')

    <div class="row g-4">
        <div class="col-md-4 col-sm-6">
            <div class="border-0 shadow-sm card h-100">
                <div class="text-center card-body d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="mb-4 card-title text-dark">Artikel</h3>

                        <img src="{{ asset('assets/media/my-assets/article.svg') }}" alt="Forum" class="mb-3"
                            style="height: 100px">
                            
                        <div class="flex-wrap gap-2 d-flex justify-content-center w-100">
                            <a href="{{ route('article.index') }}" class="btn btn-light-primary btn-sm">
                                <i class="bi bi-eye me-2"></i>Lihat Artikel
                            </a>
                            <a href="" class="btn btn-light-success btn-sm">
                                <i class="bi bi-check-circle me-2"></i>Validasi Artikel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="border-0 shadow-sm card h-100">
                <div class="gap-3 text-center card-body d-flex flex-column">
                    <h3 class="card-title text-dark">Forum</h3>

                    <img src="{{ asset('assets/media/my-assets/forum.svg') }}" alt="Forum" class="mb-3"
                        style="height: 100px">
                        
                    <div class="mb-3 flex-grow-1 d-flex flex-column justify-content-center align-items-center">
                        <div class="flex-wrap gap-2 d-flex justify-content-center w-100">
                            <a href="{{ route('forum-discussion.index') }}" class="btn btn-light-primary btn-sm">
                                <i class="bi bi-chat-text me-2"></i>Lihat Forum
                            </a>
                            @if (session('user_informations.role') == 'super-admin' || session('user_informations.role') == 'manajer-konten')
                                <a href="{{ route('forum-category.index') }}" class="btn btn-light-danger btn-sm">
                                    <i class="bi bi-tags me-2"></i>Kategori Forum
                                </a>
                                <a href="{{ route('forum-discussion-approval-process') }}"
                                    class="btn btn-light-success btn-sm">
                                    <i class="bi bi-check-circle me-2"></i>Verifikasi Forum
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="border-0 shadow-sm card h-100">
                <div class="text-center card-body d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="mb-4 card-title text-dark">Desk</h3>

                        <img src="{{ asset('assets/media/my-assets/article.svg') }}" alt="Forum" class="mb-3"
                            style="height: 100px">

                        <div class="flex-wrap gap-2 d-flex justify-content-center w-100">
                            <a href="" class="btn btn-light-primary btn-sm">
                                <i class="bi bi-ticket me-2"></i>Lihat Tiket
                            </a>
                            <a href="" class="btn btn-light-success btn-sm">
                                <i class="bi bi-check-circle me-2"></i>Verifikasi Tiket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
