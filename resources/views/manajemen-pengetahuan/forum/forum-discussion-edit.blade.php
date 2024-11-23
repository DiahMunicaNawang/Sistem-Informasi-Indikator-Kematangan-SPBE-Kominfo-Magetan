@extends('layouts.main.index')

@section('page-name', 'Edit Role')

@section('content')

    <form action="{{ route('forum-discussion.update', $forum_discussion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div class="mb-8">
                    <label for="title" class="required form-label">Topik Pertanyaan</label>
                    <input type="text" placeholder="Apa yang ingin Anda tanyakan?" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $forum_discussion->title) }}">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="description" class="required form-label">Deskripsi</label>
                    <textarea name="description" placeholder="Deskripsikan pertanyaan Anda dengan lebih detail!" class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="10">{{ old('description', $forum_discussion->description) }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="forum_category_id" class="required form-label">Kategori Forum</label>
                    <select name="forum_category_id" id="forum_category_id" class="form-control @error('forum_category_id') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($forum_categories as $category)
                            <option value="{{ $category->id }}" {{ old('forum_category_id', $forum_discussion->forum_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('forum_category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                {{-- @if (session('user_informations.role') == 'admin' || session('user_informations.role') == 'super-admin')

                <div class="mb-8">
                    <label for="approval_status" class="required form-label">Status Persetujuan</label>
                    <select name="approval_status" id="approval_status" class="form-control @error('approval_status') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="accepted" {{ old('approval_status', $forum_discussion->approval_status) == 'accepted' ? 'selected' : '' }}>Terima</option>
                        <option value="rejected" {{ old('approval_status', $forum_discussion->approval_status) == 'rejected' ? 'selected' : '' }}>Tolak</option>
                        <option value="process" {{ old('approval_status', $forum_discussion->approval_status) == 'process' ? 'selected' : '' }}>Proses</option>
                    </select>
                    @error('approval_status')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="availability_status" class="required form-label">Status Persetujuan</label>
                    <select name="availability_status" id="availability_status" class="form-control @error('availability_status') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="open" {{ old('availability_status', $forum_discussion->availability_status) == 'open' ? 'selected' : '' }}>Buka</option>
                        <option value="closed" {{ old('availability_status', $forum_discussion->availability_status) == 'closed' ? 'selected' : '' }}>Tutup</option>
                    </select>
                    @error('availability_status')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                @endif --}}
            </div>
            <div class="pt-0 card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
