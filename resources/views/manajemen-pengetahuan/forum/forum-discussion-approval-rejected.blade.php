@extends('layouts.main.index')

@section('page-name', 'Daftar Pengajuan Forum')

@section('content')

    <article class="gap-3 mt-6 d-flex flex-column">
        @foreach ($forum_discussions as $forum_discussion)
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-primary">{{ $forum_discussion->title }}</h2>
                        <div class="gap-2 d-flex">
                            <a href="{{ route('forum-discussion-approval-accept', $forum_discussion->id) }}"
                                class="btn btn-sm btn-light-success">Terima</a>
                        </div>
                    </div>
                    <span class="mb-3 badge bg-secondary text-muted">{{ $forum_discussion->forum_category->name }}</span>
                    <p class="fs-5">
                        {{-- short_description dari accessor pada model ForumDiscussion --}}
                        {{ $forum_discussion->short_description }}
                    </p>
                    <div>
                        <a href="{{ route('forum-discussion.show', $forum_discussion->id) }}"
                            class="btn btn-sm btn-primary">Baca Selengkapnya</a>

                        <form action="{{ route('forum-discussion.destroy', $forum_discussion->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus forum diskusi ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </article>
@endsection
