@extends('layouts.main.index')

@section('page-name', 'Indikator 26: Manajemen Pengetahuan')

@section('content')
<div class="row g-6">
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Artikel</h3>
                <a href="{{ route('article.index') }}" class="btn btn-sm btn-primary">Lihat Artikel</a>
                <a href="" class="btn btn-sm btn-primary">Buat Artikel</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Forum</h3>
                <a href="{{ route('forum.index') }}" class="btn btn-sm btn-primary">Lihat Forum</a>
                <a href="" class="btn btn-sm btn-primary">Ajukan Pertanyaan</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Desk</h3>
                <a href="" class="btn btn-sm btn-primary">Lihat Tiket</a>
                <a href="" class="btn btn-sm btn-primary">Buat Tiket</a>
            </div>
        </div>
    </div>
</div>
@endsection
