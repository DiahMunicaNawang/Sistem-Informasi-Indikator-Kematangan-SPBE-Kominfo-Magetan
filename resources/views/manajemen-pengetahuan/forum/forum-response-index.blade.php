<!-- New Response Form -->
<div class="mb-4 border-0 card">
    <form action="{{ route('forum-response.store') }}" method="POST" class="position-relative">
        @csrf
        <input type="hidden" name="forum_discussion_id" value="{{ $forum_discussion->id }}">
        <div class="gap-3 d-flex align-items-start flex-grow-1">
            <div class="flex-grow-1">
                <textarea name="content" class="form-control" rows="2" required maxlength="1000"
                    placeholder="Tulis tanggapan Anda..."></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button class="px-4 btn btn-primary btn-sm position-absolute" type="submit" style="bottom: 10px; right: 10px;">
            <i class="p-0 bi bi-send-fill"></i>
        </button>
    </form>
</div>

<!-- Responses List -->
<div class="responses-container">
    @foreach ($forum_responses as $response)
        <div class="mb-4 border-0 card" id="response-{{ $response->id }}">
            <div class="card-body">
                <!-- Response Header -->
                <div class="gap-3 mb-3 d-flex justify-content-between align-items-center">
                    <div class="gap-3 d-flex">
                        <img src="{{ $response->user->avatar ?? asset('assets/media/avatars/blank.png') }}"
                            class="rounded-circle" width="48" height="48"
                            alt="{{ $response->user->username }}" />
                        <div>
                            <h6 class="mb-1 fw-bold">{{ $response->user->username }}</h6>
                            <div class="text-muted small">
                                <i class="p-0 bi bi-clock"></i>
                                {{ $response->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    @if ($response->user_id === session('user_informations.user_id'))
                        <div class="gap-2 d-flex justify-content-end flex-column flex-md-row">
                            <button type="button" class="btn btn-light btn-sm"
                                onclick="toggleEditForm('{{ $response->id }}')">
                                <i class="p-0 bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('forum-response.destroy', $response) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="forum_discussion_id" value="{{ $forum_discussion->id }}">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')">
                                    <i class="p-0 bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Response Content -->
                <div id="content-{{ $response->id }}" class="mb-3">
                    {!! nl2br(e($response->content)) !!}
                </div>

                <!-- Edit Form -->
                <div id="edit-form-{{ $response->id }}" style="display: none;" class="mb-3">
                    <form action="{{ route('forum-response.update', $response) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="forum_discussion_id" value="{{ $forum_discussion->id }}">
                        <div class="mb-3">
                            <textarea name="content" class="form-control bg-light" rows="3" placeholder="Tulis balasan Anda..." required
                                maxlength="1000">{{ $response->content }}</textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-light btn-sm"
                                onclick="toggleEditForm('{{ $response->id }}')">
                                <i class="p-0 me-1 bi bi-x"></i>Batal
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm ms-2">
                                <i class="p-0 me-1 bi bi-check2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Reply Button -->
                <div class="pt-3 border-top">
                    <button class="btn btn-light btn-sm" onclick="toggleReplyForm('{{ $response->id }}')">
                        <i class="p-0 me-1 bi bi-reply"></i>Balas
                    </button>
                </div>

                <!-- Reply Form -->
                <div id="reply-form-{{ $response->id }}" style="display: none;" class="mt-3">
                    <form action="{{ route('forum-response.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="forum_discussion_id" value="{{ $response->forum_discussion_id }}">
                        <input type="hidden" name="parent_id" value="{{ $response->id }}">
                        <div class="mb-3">
                            <textarea name="content" class="form-control bg-light" rows="2" placeholder="Tulis balasan Anda..." required
                                maxlength="1000"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-light btn-sm"
                                onclick="toggleReplyForm('{{ $response->id }}')">
                                <i class="p-0 me-1 bi bi-x"></i>Batal
                            </button>
                            <button class="btn btn-primary btn-sm ms-2" type="submit">
                                <i class="p-0 me-1 bi bi-send"></i>Kirim
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Nested Replies -->
                @if ($response->replies->count() > 0)
                    <div class="mt-4 ms-4 border-start border-1">
                        @foreach ($response->replies as $reply)
                            <div class="mb-3" id="response-{{ $reply->id }}">
                                <div class="card-body pe-0">
                                    <!-- Reply Header -->
                                    <div class="gap-3 mb-3 d-flex justify-content-between align-items-center">
                                        <div class="gap-3 d-flex">
                                            <img src="{{ $reply->user->avatar ?? asset('assets/media/avatars/blank.png') }}"
                                                class="rounded-circle" width="40" height="40"
                                                alt="{{ $reply->user->username }}" />
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $reply->user->username }}</h6>
                                                <div class="text-muted small">
                                                    <i class="p-0 bi bi-clock"></i>
                                                    {{ $reply->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>

                                        @if ($reply->user_id === session('user_informations.user_id'))
                                            <div class="gap-2 d-flex justify-content-end flex-column flex-md-row">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    onclick="toggleEditForm('{{ $reply->id }}')">
                                                    <i class="p-0 bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('forum-response.destroy', $reply) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="forum_discussion_id"
                                                        value="{{ $forum_discussion->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus balasan ini?')">
                                                        <i class="p-0 bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Reply Content -->
                                    <div id="content-{{ $reply->id }}">
                                        {!! nl2br(e($reply->content)) !!}
                                    </div>

                                    <!-- Reply Edit Form -->
                                    <div id="edit-form-{{ $reply->id }}" style="display: none;" class="mt-3">
                                        <form action="{{ route('forum-response.update', $reply) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="forum_discussion_id" value="{{ $forum_discussion->id }}">
                                            <div class="mb-3">
                                                <textarea name="content" class="form-control bg-light" rows="2" placeholder="Tulis balasan Anda..." required
                                                    maxlength="1000">{{ $reply->content }}</textarea>
                                            </div>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    onclick="toggleEditForm('{{ $reply->id }}')">
                                                    <i class="p-0 me-1 bi bi-x"></i>Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary btn-sm ms-2">
                                                    <i class="p-0 me-1 bi bi-check2"></i>Simpan
                                                </button>
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
</script>

<style>
    .form-control {
        border-color: #e9ecef;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>