@extends('layouts.main.index')

@section('page-name', 'Tambah Forum Kategori')

@section('content')
    <form action="{{ route('forum-category.store') }}" method="POST">
        @csrf

        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div class="mb-8">
                    <label for="name" class="required form-label">Nama Kategori</label> 
                    <input type="text" placeholder="Teknologi" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                    @error('name')
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