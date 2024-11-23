@extends('layouts.main.index')

@section('page-name', 'User Management')

@section('content')
    <!--begin::Table widget 14-->
    <div class="card card-flush h-md-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
            <!--begin::Toolbar-->
            <div class="card-toolbar">   
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-success">Tambah Pengguna</a>             
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
                            <th class="min-w-175px">Email</th>
                            <th class="min-w-175px">Username</th>
                            <th class="min-w-175px">Role</th>
                            <th class="min-w-175px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td class="gap-2 d-flex">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
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