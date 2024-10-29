@extends('layouts.index')

@section('title', 'Reset Email')

@section('content')

<div class="container">
    <h2>Reset Password</h2>
    <br>
    <br>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Kirim Reset Link</button>
    </form>
</div>

@endsection