@extends('layouts.main.index')

@section('title', 'Cek Status Artikel')

@section('back-button')
    <a href="{{ route('article.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Status Artikel Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($artikel->isEmpty())
        <div class="alert alert-info">
            Anda belum membuat artikel.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Artikel</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artikel as $index => $article)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->category->category_name ?? 'Tidak Ada Kategori' }}</td>
                        <td>
                            @if($article->article_status === 'draft')
                                <span class="badge bg-secondary">Draft</span>
                            @elseif($article->article_status === 'in_review')
                                <span class="badge bg-warning">Dalam Proses Validasi</span>
                            @elseif($article->article_status === 'published')
                                <span class="badge bg-success">Dipublikasikan</span>
                            @elseif($article->article_status === 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>{{ $article->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('article.show', $article->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
