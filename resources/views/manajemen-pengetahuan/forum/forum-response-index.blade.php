@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Input Response Section -->
<div class="mb-10">
    <form action="{{ route('forum-response.store') }}" method="POST">
        @csrf
        <input type="hidden" name="forum_discussion_id" value="{{ $forum_discussion->id }}">
        <div class="d-flex">
            <textarea name="content" class="p-3 bg-transparent border border-gray-400 rounded w-100 text-dark" rows="2"
                placeholder="Tambahkan Komentar..." required maxlength="1000" style="resize: vertical;"></textarea>
            <button class="ms-2 btn btn-primary" type="submit">Kirim</button>
        </div>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </form>
</div>


{{-- Menampilkan Respon --}}
{{-- $forum_responses dari method showForumDiscussion pada ForumResponseService --}}
<div>
    @foreach ($forum_responses as $response)
        <div class="mb-3 timeline-item" id="response-{{ $response->id }}">
            <div class="timeline-content">
                <div class="mb-5">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50px me-5">
                                <img src="{{ $response->user->avatar ?? asset('assets/media/avatars/blank.png') }}"
                                    alt="" />
                            </div>
                            <div class="flex-column d-flex justify-content-between">
                                <div class="flex-grow-1">
                                    <a href="#"
                                        class="text-gray-800 text-hover-primary fs-6 fw-bolder">{{ $response->user->username }}</a>
                                </div>
                                <span
                                    class="text-muted fs-7 fw-semibold">{{ $response->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        @if ($response->user_id === session('user_informations.user_id'))
                            <div class="ms-auto">
                                <button type="button" class="btn btn-sm btn-light"
                                    onclick="toggleEditForm('{{ $response->id }}')">
                                    Edit
                                </button>
                                <form action="{{ route('forum-response.destroy', $response) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Normal Content View -->
                    <div id="content-{{ $response->id }}">
                        <p class="mt-3 mb-2 text-gray-600 fs-5">{!! nl2br(e($response->content)) !!}</p>
                    </div>

                    <!-- Edit Form -->
                    <div id="edit-form-{{ $response->id }}" style="display: none;" class="mt-3 mb-2">
                        <form action="{{ route('forum-response.update', $response) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="gap-2 d-flex flex-column">
                                <textarea name="content" class="p-3 bg-transparent border border-gray-400 rounded w-100 text-dark" rows="3"
                                    style="resize: vertical;">{{ $response->content }}</textarea>
                                <div class="gap-2 d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-light"
                                        onclick="toggleEditForm('{{ $response->id }}')">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Reply Button -->
                    <button class="p-0 text-gray-600 bg-transparent border-0 text-hover-primary fw-semibold fs-5"
                        onclick="toggleReplyForm('{{ $response->id }}')">
                        Reply
                    </button>

                    <!-- Reply Form -->
                    <div id="reply-form-{{ $response->id }}" style="display: none;" class="mt-3">
                        <form action="{{ route('forum-response.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="forum_discussion_id"
                                value="{{ $response->forum_discussion_id }}">
                            <input type="hidden" name="parent_id" value="{{ $response->id }}">
                            <div class="d-flex">
                                <textarea name="content" class="p-3 bg-transparent border border-gray-400 rounded w-100 text-dark" rows="2"
                                    placeholder="Tambahkan Komentar..." required maxlength="1000" style="resize: vertical;"></textarea>
                                <button class="ms-2 btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Nested Replies -->
                @if ($response->replies->count() > 0)
                    <div class="mb-10 ms-5 ps-3 border-start">
                        @foreach ($response->replies as $reply)
                            <div class="timeline-item" id="response-{{ $reply->id }}">
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="{{ $reply->user->avatar ?? asset('assets/media/avatars/blank.png') }}"
                                                    alt="" />
                                            </div>
                                            <div class="flex-column d-flex justify-content-between">
                                                <div class="flex-grow-1">
                                                    <a href="#"
                                                        class="text-gray-800 text-hover-primary fs-6 fw-bolder">{{ $reply->user->username }}</a>
                                                </div>
                                                <span
                                                    class="text-muted fs-7 fw-semibold">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        @if ($reply->user_id === session('user_informations.user_id'))
                                            <div class="ms-auto">
                                                <button type="button" class="btn btn-sm btn-light"
                                                    onclick="toggleEditForm('{{ $reply->id }}')">
                                                    Edit
                                                </button>
                                                <form action="{{ route('forum-response.destroy', $reply) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Normal Content View -->
                                    <div id="content-{{ $reply->id }}">
                                        <p class="mt-3 mb-3 text-gray-600 fs-5">{!! nl2br(e($reply->content)) !!}</p>
                                    </div>

                                    <!-- Edit Form -->
                                    <div id="edit-form-{{ $reply->id }}" style="display: none;" class="mt-3 mb-2">
                                        <form action="{{ route('forum-response.update', $reply) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="gap-2 d-flex flex-column">
                                                <textarea name="content" class="p-3 bg-transparent border border-gray-400 rounded w-100 text-dark" rows="3"
                                                    style="resize: vertical;">{{ $reply->content }}</textarea>
                                                <div class="gap-2 d-flex justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        onclick="toggleEditForm('{{ $reply->id }}')">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
