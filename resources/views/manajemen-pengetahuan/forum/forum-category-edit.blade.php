@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('forum-category.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('page-name', 'Edit Kategori Forum')

@section('content')

    <form action="{{ route('forum-category.update', $forum_category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-flush h-md-100">

            <div class="card-body">
                <div class="mb-8">
                    <label for="name" class="required form-label">Nama Kategori</label> 
                    <input type="text" placeholder="Teknologi" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $forum_category->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-0 card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection