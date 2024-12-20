@extends('layouts.main.index')

@section('back-button')
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left-square-fill" style="font-size: 34px"></i>
    </a>
@endsection

@section('page-name', 'Add Category Article')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <form action="{{ route('article.storeCategory') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Add Categoy -->
            <div class="mb-3">
                <label for="category_name" class="form-label">Category</label>
                <input type="text" name="category_name" id="category_name" class="form-control"
                    placeholder="Masukkan Category Baru">
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Tambahkan Category</button>
        </form>

    </div>
@endsection
