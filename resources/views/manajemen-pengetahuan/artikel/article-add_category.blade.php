@extends('layouts.main.index')

@section('back-button')
<a href="{{ url()->previous() }}">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection

@section('page-name', 'Add Category Article')



@section('content')

<div class="container mt-5">
    <form action="{{ route('article.storeCategory') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Add Categoy -->
        <div class="mb-3">
            <label for="category_name" class="form-label">Category</label>
            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Masukkan Category Baru">
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Tambahkan Category</button>
    </form>

</div>
@endsection
