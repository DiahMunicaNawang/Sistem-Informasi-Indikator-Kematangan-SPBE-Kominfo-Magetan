@extends('layouts.main.index')

@section('page-name', 'Daftar Pengajuan Forum')

@section('content')
    @foreach ($forum_discussions as $forum_discussion)
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2 class="text-primary">{{ $forum_discussion->title }}</h2>
                    <div class="gap-2 d-flex">
                        <a href="{{ route('forum-discussion-approval-accept', $forum_discussion->id) }}" class="btn btn-sm btn-light-success">Terima</a>

                        <form action="{{ route('forum-discussion.destroy', $forum_discussion->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus forum diskusi ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                <span
                    class="mb-3 badge bg-secondary text-muted">{{ $forum_discussion->forum_category->name }}</span>
                <p class="fs-5">
                    {{ $forum_discussion->description }}
                </p>
            </div>
        </div>
    @endforeach
@endsection
