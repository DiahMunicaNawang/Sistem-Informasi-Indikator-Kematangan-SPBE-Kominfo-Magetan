@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('forum-discussion-approval-process') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('page-name', 'Daftar Forum Diterima')

@section('content')
    @if ($forum_discussions->isEmpty())
        <div class="col-12">
            <div class="py-5 text-center rounded bg-light">
                <i class="mb-3 bi bi-inbox display-1 text-muted"></i>
                <p class="text-muted">Tidak ada diskusi yang ditemukan.</p>
            </div>
        </div>
    @else
        <article class="gap-3 d-flex flex-column">
            @foreach ($forum_discussions as $forum_discussion)
                <div class="row g-4">
                    <div class="col-12">
                        <div class="shadow-sm card h-100 hover-shadow">
                            <div class="card-body">
                                {{-- Discussion Header --}}
                                <div class="flex-wrap mb-3 d-flex justify-content-between align-items-start">
                                    <div class="flex-wrap gap-5 d-flex">
                                        <div class="position-relative">
                                            <div class="symbol symbol-50px">
                                                <img src="{{ $forum_discussion->user->avatar ? asset('storage/avatars/' . $forum_discussion->user->avatar) : asset('assets/media/avatars/blank.png') }}"
                                                    alt="{{ $forum_discussion->user->username }}">
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <h6 class="mb-0">{{ $forum_discussion->user->username }}</h6>
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($forum_discussion->discussion_created_at)->format('H:i - d M Y') }}
                                            </small>
                                        </div>

                                        <div class="gap-2 mb-1 d-flex align-items-center">
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

                                    {{-- Management Actions --}}
                                    <div class="gap-2 mt-1 fl d-flex">
                                        @if ($forum_discussion->availability_status == 'open')
                                            <a href="{{ route('forum-discussion-approval-accept', $forum_discussion->id) }}"
                                                class="btn btn-sm btn-light-danger">
                                                <i class="bi bi-lock"></i> Tutup Diskusi</a>
                                        @else
                                            <a href="{{ route('forum-discussion-approval-accept', $forum_discussion->id) }}"
                                                class="btn btn-sm btn-light-success"><i class="bi bi-unlock"></i> Buka
                                                Diskusi</a>
                                        @endif
                                        <a href="{{ route('forum-discussion-approval-reject', $forum_discussion->id) }}"
                                            class="btn btn-sm btn-light-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menolak forum diskusi ini?')"><i
                                                class="bi bi-x-lg"></i> Tolak</a>
                                    </div>
                                </div>

                                {{-- Discussion Content --}}
                                <div class="mb-3">
                                    <div class="flex-row gap-2 d-flex">
                                        <h5 class="m-0 mb-2 card-title" style="word-wrap: break-word; word-break: break-word;">
                                            {{ $forum_discussion->title }}
                                        </h5>
                                        <span class="gap-1 badge bg-light text-primary d-inline-flex align-items-center align-self-start">
                                            {{ $forum_discussion->forum_category->name }}
                                        </span>
                                    </div>

                                    <p class="mt-2 card-text text-muted">
                                        {{ $forum_discussion->short_description }}
                                    </p>

                                    <div class="flex-wrap gap-1 d-flex">
                                        @foreach ($forum_discussion->indikators as $indikator)
                                            <span class="gap-1 lh-sm align-items-center badge bg-light text-wrap text-start text-muted">
                                                <i class="bi bi-link-45deg text-muted"></i>
                                                {{ $indikator->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Discussion Footer --}}
                                <div class="flex-wrap gap-3 pt-3 d-flex justify-content-between align-items-center border-top">
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
                                        <form
                                            action="{{ route('forum-discussion-approval-destroy', $forum_discussion->id) }}"
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
    @endif
@endsection
