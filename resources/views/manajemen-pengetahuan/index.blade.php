@extends('layouts.main.index')

@section('page-name', 'Indikator 26: Manajemen Pengetahuan')

@section('content')
<div class="row g-6">
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Artikel</h3>
                <a href="" class="btn btn-sm btn-primary">Lihat Artikel</a>
                <a href="" class="btn btn-sm btn-primary">Buat Artikel</a>
            </div> 
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Forum</h3>
                <div class="flex-wrap gap-2 justify-content-center d-flex">

                    <a href="{{ route('forum-discussion.index') }}" class="btn btn-sm btn-primary">Lihat Forum</a>
                    @if (session('user_informations.role') == 'super-admin' || session('user_informations.role') == 'manajer-konten')
                        <a href="{{ route('forum-category.index') }}" class="btn btn-sm btn-primary">Kategori Forum</a>
                        <a href="{{ route('forum-discussion-approval-process') }}" class="btn btn-sm btn-primary">Verifikasi Forum</a>
                    @endif
                </div>
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