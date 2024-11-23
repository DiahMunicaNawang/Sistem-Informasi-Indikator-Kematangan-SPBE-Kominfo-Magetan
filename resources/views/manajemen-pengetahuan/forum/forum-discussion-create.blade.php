@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('forum-discussion.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('page-name', 'Tambah Pertanyaan')

@section('content')
    <form action="{{ route('forum-discussion.store') }}" method="POST">
        @csrf

        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div class="mb-8">
                    <label for="title" class="required form-label">Topik Pertanyaan</label> 
                    <input type="text" placeholder="Apa yang ingin Anda tanyakan?" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="description" class="required form-label">Deskripsi</label> 
                    <textarea name="description" placeholder="Deskripsikan pertanyaan Anda dengan lebih detail!" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="10" value="{{ old('description') }}"></textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="title" class="required form-label">Kategori Forum</label> 
                    <select name="forum_category_id" id="forum_category_id" class="form-control @error('forum_category_id') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($forum_categories as $category)
                            <option value="{{ $category->id }}" {{ old('forum_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
@endsection