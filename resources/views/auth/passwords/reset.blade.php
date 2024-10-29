@extends('layouts.index')

@section('title', 'Reset Email')

@section('content')

<div class="container">
    <h2>Reset Password</h2>
    <form method="POST" action="{{ route('password.update', ['token' => $token]) }}">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>

<script>
    // JavaScript untuk fitur Tampilkan Password
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    const toggleIcon = document.querySelector('#toggleIcon');
    
    togglePassword.addEventListener('click', function () {
        // Cek tipe input dan ubah sesuai kebutuhan
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        
        // Ubah icon sesuai tipe input
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    });
    </script>

@endsection
