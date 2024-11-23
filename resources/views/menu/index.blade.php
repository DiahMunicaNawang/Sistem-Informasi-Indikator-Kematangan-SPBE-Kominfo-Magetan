@extends('layouts.main.index')

@section('page-name', 'Menu Management')

@section('content')
    <!--begin::Table widget 14-->
    <div class="card card-flush h-md-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <a href="{{ route('menu.create') }}" class="btn btn-sm btn-success">Tambah Menu</a>
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
                            <th class="min-w-175px">Menu</th>
                            <th class="min-w-175px">URL</th>
                            <th class="min-w-175px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->url }}</td>
                                <td class="gap-2 d-flex">
                                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="post">
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
