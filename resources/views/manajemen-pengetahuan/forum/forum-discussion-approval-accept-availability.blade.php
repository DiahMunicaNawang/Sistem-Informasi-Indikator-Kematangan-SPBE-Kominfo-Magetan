@extends('layouts.main.index')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="border-0 shadow-sm card rounded-4">
                    
                    <!-- Body -->
                    <div class="p-5 card-body">
                        <form action="{{ route('forum-discussion-approval-accept-availability', $forum_discussion->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="title" value="{{ $forum_discussion->title }}">
                            <input type="hidden" name="description" value="{{ $forum_discussion->description }}">
                            <input type="hidden" name="forum_category_id" value="{{ $forum_discussion->forum_category_id }}">
                            
                            <div class="mb-4 text-center">
                                <h4 class="mb-2 text-dark fw-semibold">{{ $forum_discussion->title }}</h4>
                                <p class="text-muted">Pilih status untuk diskusi ini</p>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="flex-wrap gap-3 d-flex justify-content-center">
                                <button type="submit" name="action" value="open" 
                                        class="px-4 btn btn-success d-flex align-items-center">
                                    <i class="bi bi-unlock-fill me-2"></i>Buka Diskusi
                                </button>
                                <button type="submit" name="action" value="closed" 
                                        class="px-4 btn btn-danger d-flex align-items-center">
                                    <i class="bi bi-lock-fill me-2"></i>Tutup Diskusi
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Footer -->
                    <div class="py-3 text-center card-footer bg-light">
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>Diskusi dibuat pada: {{ \Carbon\Carbon::parse($forum_discussion->discussion_created_at)->format('d M Y, H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
