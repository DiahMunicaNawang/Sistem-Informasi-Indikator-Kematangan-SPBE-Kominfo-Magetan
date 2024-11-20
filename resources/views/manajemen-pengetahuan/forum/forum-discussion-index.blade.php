@extends('layouts.main.index')

@section('content')

    <h1 class="mb-6 text-center text-primary">Jelajahi Forum</h1>

    <div class="flex-wrap gap-3 mb-4 d-flex align-items-center">
        <a href="{{ route('forum-discussion.create') }}" class="btn btn-success">Ajukan Pertanyaan</a>
        <a href="{{ route('forum-discussion-approval-user') }}" class="btn btn-primary">Lihat Pertanyaan Saya</a>
        <form method="GET" action="{{ route('forum-discussion.index') }}" class="d-flex flex-grow-1">
            <input type="text" name="search" id="search" class="form-control me-2" placeholder="Cari Pertanyaan" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>
    

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif    
    
    <article class="gap-3 mt-6 d-flex flex-column">
        @if ($forum_discussions->isEmpty())
            <p class="text-center text-muted">Tidak ada diskusi yang ditemukan.</p>
        @else
            @foreach ($forum_discussions as $forum_discussion)
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h2 class="text-primary">{{ $forum_discussion->title }}</h2>
                            <span class="px-6 py-2 rounded fw-bold"
                            style="{{ $forum_discussion->availability_status == 'open' ? 'color: #3ccd7d; background-color: #caffe1;' : 'color: #cd3c3c; background-color: #ffcaca;' }}">
                                {{ $forum_discussion->availability_status == 'open' ? 'Diskusi Baru' : 'Diskusi Selesai' }} 
                            </span>
                        </div>
                        <span class="mb-3 badge bg-secondary text-muted">{{ $forum_discussion->forum_category->name }}</span>
                        <p class="fs-5">
                            {{ $forum_discussion->short_description }}
                        </p>
                        <a href="{{ route('forum-discussion.show', $forum_discussion->id) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            @endforeach
            <div class="mt-4">
                {{ $forum_discussions->links() }}
            </div>
        @endif
    </article>
@endsection