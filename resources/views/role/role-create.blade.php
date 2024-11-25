@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('role.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endSection

@section('page-name', 'Tambah Role')

@section('content')
    <form action="{{ route('role.store') }}" method="POST">
        @csrf

        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div>
                    <label for="name" class="required form-label">Nama Role</label> 
                    <input type="text" placeholder="Admin" name="name" class="form-control" id="name" value="{{ old('name') }}">
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