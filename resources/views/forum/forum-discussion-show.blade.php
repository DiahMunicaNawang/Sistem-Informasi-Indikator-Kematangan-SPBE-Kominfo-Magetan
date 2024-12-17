@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('forum-discussion.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('content')
    <div class="card card-flush h-md-100">
        <div class="pt-8 border-0 px-9">
            <div class="m-0 card-title">
                <div class="flex-wrap gap-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <img src="{{ $forum_discussion->user->avatar ? asset('storage/avatars/' . $forum_discussion->user->avatar) : asset('assets/media/avatars/blank.png') }}" alt="{{ $forum_discussion->user->username }}" />
                        </div>
                        <div class="flex-wrap d-flex justify-content-between flex-sm-nowrap">
                            <div class="flex-grow-1">
                                <a href="#"
                                    class="text-gray-800 text-hover-primary fs-6 fw-bolder">{{ $forum_discussion->user->username }}</a>
                                <div class="text-muted fs-7">{{ \Carbon\Carbon::parse($forum_discussion->discussion_created_at)->format('H:i - d M Y') }} |
                                    {{ $forum_discussion->forum_category->name }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="gap-2 d-flex flex-column align-items-center">
                        <span class="px-6 py-2 text-center rounded fw-semibold w-100"
                            style="{{ $forum_discussion->availability_status == 'open' ? 'color: #3ccd7d; background-color: #caffe1;' : 'color: #cd3c3c; background-color: #ffcaca;' }}">
                            {{ $forum_discussion->availability_status == 'open' ? 'Diskusi Aktif' : 'Diskusi Ditutup' }}
                        </span>

                        @if ($forum_discussion->user_id == session('user_informations.user_id'))
                            <div class="gap-2 w-100 d-flex">
                                <a href="{{ route('forum-discussion.edit', $forum_discussion->id) }}"
                                    class="btn btn-sm btn-light"><i class="p-0 me-1 bi bi-pencil"></i> Edit</a>
                                <form action="{{ route('forum-discussion.destroy', $forum_discussion->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus forum diskusi ini?')">
                                        <i class="p-0 me-1 bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-5 card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-dark fw-bolder">{{ $forum_discussion->title }}</h2>
            </div>

            <p class="text-gray-600 fs-5 fw-semibold">{{ $forum_discussion->description }}</p>
            
            @foreach ($forum_discussion->indikators as $indikator)
                <span class="gap-1 badge bg-light text-muted align-items-center">
                    <i class="bi bi-link-45deg text-muted"></i>
                    {{ $indikator->name }}
                </span>
            @endforeach
        </div>

        <div class="pt-4 card-footer">
            <h3 class="mb-4 text-gray-800 card-label fw-bold">Tanggapan</h3>

            @include('forum.forum-response-index')
        </div>
    </div>
@endsection
