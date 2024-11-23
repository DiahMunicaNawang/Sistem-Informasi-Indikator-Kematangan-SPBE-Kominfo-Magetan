@extends('layouts.main.index')

@section('page-name', 'Daftar Pengajuan Forum')

@section('content')
    <div class="mb-4 card">
        <div class="card-body">
            
            <form action="{{ route('forum-discussion-approval-accept-availability', $forum_discussion->id) }}" method="POST">
                @csrf
                <input type="hidden" name="title" value="{{ $forum_discussion->title }}">
                <input type="hidden" name="description" value="{{ $forum_discussion->description }}">
                <input type="hidden" name="forum_category_id" value="{{ $forum_discussion->forum_category_id }}">
                
                <h2 class="text-center card-title" name="title">{{ $forum_discussion->title }}</h2>
                
                <div class="d-flex justify-content-center">
                    <button type="submit" name="action" value="open" class="btn btn-sm btn-success me-2">Buka Diskusi</button>
                    <button type="submit" name="action" value="closed" class="btn btn-sm btn-danger">Tutup Diskusi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
