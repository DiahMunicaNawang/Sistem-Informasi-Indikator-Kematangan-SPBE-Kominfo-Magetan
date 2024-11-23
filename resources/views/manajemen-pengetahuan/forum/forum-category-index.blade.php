@extends('layouts.main.index')

@section('page-name', 'Kategori Forum')

@section('content')

    @if (session('success'))
        <div class="mb-4 alert alert-success" role="alert">
            <div class="d-flex align-items-center">
                <div><i class="bi bi-check-circle me-2 text-success"></i>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    
    <!--begin::Table widget 14-->
    <div class="card card-flush h-md-100">
        <!--begin::Header-->
        <div class="card-header pt-7">

            <!--begin::Toolbar-->
            <div class="card-toolbar">   
                <a href="{{ route('forum-category.create') }}" class="btn btn-sm btn-success">Tambah Kategori Forum</a>             
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="pt-6 card-body">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed">
                    <thead>
                        <tr class="text-gray-400 fs-7 fw-bold">
                            <th class="min-w-175px">Name</th>
                            <th class="min-w-175px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forum_categories as $forum_category)
                            <tr>
                                <td>{{ $forum_category->name }}</td>
                                <td class="gap-2 d-flex">
                                    <a href="{{ route('forum-category.edit', $forum_category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('forum-category.destroy', $forum_category->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end: Card Body-->
    </div>
    <!--end::Table widget 14-->
@endsection