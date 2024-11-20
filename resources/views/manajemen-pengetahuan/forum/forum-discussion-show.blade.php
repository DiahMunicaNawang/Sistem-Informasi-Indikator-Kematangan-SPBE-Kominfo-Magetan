@extends('layouts.main.index')

@section('content')
    <div class="card card-flush h-md-100">
        <div class="pt-8 border-0 px-9">
            <div class="m-0 card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="" />
                        </div>
                        <div class="flex-wrap d-flex justify-content-between flex-sm-nowrap">
                            <div class="flex-grow-1">
                                <a href="#"
                                    class="text-gray-800 text-hover-primary fs-6 fw-bolder">{{ $forum_discussion->user->username }}</a>
                                <div class="text-muted fs-7">{{ $forum_discussion->discussion_created_at }} |
                                    {{ $forum_discussion->forum_category->name }}</div>
                            </div>
                        </div>
                    </div>

                    <span class="px-6 py-2 rounded fw-bold"
                        style="{{ $forum_discussion->availability_status == 'open' ? 'color: #3ccd7d; background-color: #caffe1;' : 'color: #cd3c3c; background-color: #ffcaca;' }}">
                        {{ $forum_discussion->availability_status == 'open' ? 'Diskusi Baru' : 'Diskusi Selesai' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="pt-5 card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-dark fw-bolder">{{ $forum_discussion->title }}</h2>

                @if ($forum_discussion->user_id == session('user_informations.user_id'))
                    <div>
                        <a href="{{ route('forum-discussion.edit', $forum_discussion->id) }}"
                            class="btn btn-sm btn-light">Edit</a>
                        <form action="{{ route('forum-discussion.destroy', $forum_discussion->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus forum diskusi ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endif

            </div>

            <p class="text-gray-600 fs-5 fw-semibold">{{ $forum_discussion->description }}</p>
        </div>

        <div class="pt-4 card-footer">
            <h3 class="mb-4 text-gray-800 card-label fw-bold">Tanggapan</h3>
            
            @include('manajemen-pengetahuan.forum.forum-response-index')
        </div>
    </div>

    <script>
        function toggleReplyForm(responseId) {
            const form = document.getElementById(`reply-form-${responseId}`);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function toggleEditForm(responseId) {
            const contentDiv = document.getElementById(`content-${responseId}`);
            const editFormDiv = document.getElementById(`edit-form-${responseId}`);

            if (contentDiv.style.display !== 'none') {
                contentDiv.style.display = 'none';
                editFormDiv.style.display = 'block';
            } else {
                contentDiv.style.display = 'block';
                editFormDiv.style.display = 'none';
            }
        }

        function toggleReplyForm(responseId) {
            const replyForm = document.getElementById(`reply-form-${responseId}`);
            if (replyForm.style.display === 'none') {
                replyForm.style.display = 'block';
            } else {
                replyForm.style.display = 'none';
            }
        }
    </script>
@endsection
