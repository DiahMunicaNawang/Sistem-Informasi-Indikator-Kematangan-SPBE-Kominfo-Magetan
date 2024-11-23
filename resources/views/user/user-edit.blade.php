@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('user.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endSection

@section('page-name', 'Edit User')

@section('content')
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div class="mb-8">
                    <label for="username" class="required form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username"
                        value="{{ old('username', $user->username) }}">
                    @error('username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="email" class="required form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8 form-group">
                    <label for="role_id" class="required form-label">Role</label> 
                    <select name="role_id" id="role_id" class="form-control">
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                @if (old('role_id', $user->role_id) == $role->id) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
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