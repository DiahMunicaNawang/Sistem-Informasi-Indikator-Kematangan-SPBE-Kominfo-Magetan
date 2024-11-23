@extends('layouts.main.index')

@section('page-name', 'Daftar Pengajuan Forum')

@section('content')

    @if (session('error'))
        <div class="mb-4 alert alert-danger" role="alert">
            <div class="d-flex align-items-center">
                <div><i class="bi bi-exclamation-triangle me-2 text-danger"></i>{{ session('error') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

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
                                            <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" class="rounded-circle"
                                                alt="{{ $forum_discussion->user->username }}"
                                                style="width: 45px; height: 45px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $forum_discussion->user->username }}</h6>

                                        <div class="gap-2 d-flex align-items-center">
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $forum_discussion->discussion_created_at }}
                                            </small>

                                            {{-- Status Diskusi --}}
                                            <span
                                                class="badge {{ $forum_discussion->availability_status == 'open' ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }}"
                                                style="font-size: 0.8rem; padding: 0.35em 0.8em;">
                                                <i
                                                    class="bi {{ $forum_discussion->availability_status == 'open' ? 'bi-unlock text-success' : 'bi-lock text-danger' }} me-1"></i>
                                                {{ $forum_discussion->availability_status == 'open' ? 'Diskusi Aktif' : 'Diskusi Ditutup' }}
                                            </span>

                                            {{-- Status Approval --}}
                                            @php
                                                $approvalStatusClass = [
                                                    'process' => 'bg-warning bg-opacity-10 text-warning',
                                                    'accepted' => 'bg-success bg-opacity-10 text-success',
                                                    'rejected' => 'bg-danger bg-opacity-10 text-danger',
                                                ];

                                                $approvalStatusIcon = [
                                                    'process' => 'bi-hourglass-split text-warning',
                                                    'accepted' => 'bi-check-circle text-success',
                                                    'rejected' => 'bi-x-circle text-danger',
                                                ];

                                                $approvalStatusText = [
                                                    'process' => 'Menunggu Persetujuan',
                                                    'accepted' => 'Disetujui',
                                                    'rejected' => 'Ditolak',
                                                ];
                                            @endphp
                                            <span
                                                class="badge {{ $approvalStatusClass[$forum_discussion->approval_status] }}"
                                                style="font-size: 0.8rem; padding: 0.35em 0.8em;">
                                                <i
                                                    class="bi {{ $approvalStatusIcon[$forum_discussion->approval_status] }} me-1"></i>
                                                {{ $approvalStatusText[$forum_discussion->approval_status] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Discussion Content --}}
                            <div class="mb-3">
                                <h5 class="mb-2 card-title">{{ $forum_discussion->title }}</h5>
                                <p class="mt-2 card-text text-muted">
                                    {{ $forum_discussion->short_description }}
                                </p>
                                <span class="gap-1 badge bg-light text-dark align-items-center">
                                    <i class="bi bi-tag text-primary"></i>
                                    {{ $forum_discussion->forum_category->name }}
                                </span>
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

                                    <a href="{{ route('forum-discussion.edit', $forum_discussion->id) }}"
                                        class="btn btn-sm btn-secondary"><i class="p-0 bi bi-pencil"></i></a>

                                    <form action="{{ route('forum-discussion-approval-destroy', $forum_discussion->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus forum diskusi ini?')">
                                            <i class="p-0 bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </article>
@endsection
