@extends('layouts.auth.index')

@section('content')
    <div>
        <h2>Verifikasi Email Anda</h2>
        <p>Silakan periksa email Anda dan klik tautan verifikasi untuk melanjutkan.</p>
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit">Kirim ulang verifikasi email</button>
        </form>
    </div>
@endsection
