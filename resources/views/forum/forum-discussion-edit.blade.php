@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('forum-discussion-approval-user') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('page-name', 'Edit Pertanyaan')

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
                <div class="mb-8">
                    <label for="forum_category_id" class="required form-label">Indikator Terkait</label>
                    <select class="form-select" id="indikatorSelect" name="indikators[]" multiple="multiple" style="width: 100%;">
                        @foreach ($indikators as $indikator)
                            <option value="{{ $indikator->id }}"
                                {{ in_array($indikator->id, $forum_discussion->indikators->pluck('id')->toArray()) ? 'selected' : '' }}
                                >{{ $indikator->name }}</option>
                        @endforeach
                    </select>
                    @error('forum_category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-0 card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#indikatorSelect').select2({
                placeholder: "Pilih indikator",
                allowClear: true
            });
        });
    </script>
@endsection
