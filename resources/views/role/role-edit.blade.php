@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('role.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endSection

@section('page-name', 'Edit Role')

@section('content')

    <form action="{{ route('role.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-flush h-md-100">

            <div class="card-body">
                <div>
                    <label for="name" class="required form-label">Nama Role</label> 
                    <input type="text" placeholder="Dashboard" name="name" class="form-control" id="name" value="{{ old('name', $role->name) }}">
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