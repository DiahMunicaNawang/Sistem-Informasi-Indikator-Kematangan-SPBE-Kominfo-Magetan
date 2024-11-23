@extends('layouts.main.index')

@section('page-name', 'Menu Management')

@section('content')
<div class="card card-flush h-md-100">
    <div class="card-header pt-7">
        <div class="card-toolbar">
            <a href="{{ route('menu.create') }}" class="btn btn-sm btn-success">Tambah Menu</a>
        </div>
    </div>

    <div class="pt-6 card-body">
        <!-- Info Alert -->
        <div class="mb-5 alert alert-info">
            <div class="d-flex">
                <i class="fas fa-info-circle fs-3 me-3"></i>
                <div>
                    <h4 class="alert-heading">Panduan Menampilkan Menu</h4>
                    <p class="mb-0">
                        Untuk menampilkan menu di sidebar, perhatikan aturan berikut:
                        <ul class="mt-2">
                            <li>Menu dengan ikon <i class="fas fa-folder text-warning"></i> adalah Kategori</li>
                            <li>Menu dengan ikon <i class="fas fa-caret-square-down text-info"></i> adalah Dropdown</li>
                            <li>Menu dengan ikon <i class="fas fa-link text-success"></i> adalah Menu biasa</li>
                            <li>Menu akan muncul di sidebar jika parent-nya (Kategori/Dropdown) juga ditampilkan</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>

        <!-- Menu Tree Table -->
        <div class="table-responsive">
            <table class="table table-row-bordered table-hover">
                <thead>
                    <tr class="text-gray-800 fw-bold fs-6">
                        <th>Struktur Menu</th>
                        <th>Tipe</th>
                        <th>URL</th>
                        <th>Role Akses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus->where('is_category', true) as $category)
                        <!-- Category Row -->
                        <tr class="bg-opacity-50 bg-light-warning">
                            <td>
                                <i class="fas fa-folder text-warning"></i>
                                <span class="fw-bold">{{ $category->name }}</span>
                            </td>
                            <td>Kategori</td>
                            <td>-</td>
                            <td>
                                @foreach($category->roles as $role)
                                    <span class="badge badge-light-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="gap-2 d-flex">
                                    <a href="{{ route('menu.edit', $category->id) }}" class="btn btn-sm btn-primary">
                                        <i class="p-0 fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('menu.destroy', $category->id) }}" method="POST" 
                                          onsubmit="return confirm('Menghapus kategori akan menghapus semua menu di dalamnya. Lanjutkan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="p-0 fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Dropdowns under this category -->
                        @foreach ($menus->where('category_id', $category->id)->where('url', null)->where('dropdown_id', null)->where('is_category', false) as $dropdown)
                            <tr class="bg-opacity-50 bg-light-info">
                                <td class="ps-8">
                                    <i class="fas fa-caret-square-down text-info"></i>
                                    <span class="fw-bold">{{ $dropdown->name }}</span>
                                </td>
                                <td>Dropdown</td>
                                <td>-</td>
                                <td>
                                    @foreach($dropdown->roles as $role)
                                        <span class="badge badge-light-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="gap-2 d-flex">
                                        <a href="{{ route('menu.edit', $dropdown->id) }}" class="btn btn-sm btn-primary">
                                            <i class="p-0 fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('menu.destroy', $dropdown->id) }}" method="POST"
                                              onsubmit="return confirm('Menghapus dropdown akan menghapus semua menu di dalamnya. Lanjutkan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="p-0 fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Menus under this dropdown -->
                            @foreach ($menus->where('dropdown_id', $dropdown->id) as $submenu)
                                <tr>
                                    <td class="ps-12">
                                        <i class="fas fa-link text-success"></i>
                                        {{ $submenu->name }}
                                    </td>
                                    <td>Menu</td>
                                    <td>{{ $submenu->url }}</td>
                                    <td>
                                        @foreach($submenu->roles as $role)
                                            <span class="badge badge-light-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="gap-2 d-flex">
                                            <a href="{{ route('menu.edit', $submenu->id) }}" class="btn btn-sm btn-primary">
                                                <i class="p-0 fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('menu.destroy', $submenu->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="p-0 fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Direct menus under category (no dropdown) -->
                            @foreach ($menus->where('category_id', $category->id)->whereNull('dropdown_id')->whereNotNull('url') as $directMenu)
                                <tr>
                                    <td class="ps-8">
                                        <i class="fas fa-link text-success"></i>
                                        {{ $directMenu->name }}
                                    </td>
                                    <td>Menu</td>
                                    <td>{{ $directMenu->url }}</td>
                                    <td>
                                        @foreach($directMenu->roles as $role)
                                            <span class="badge badge-light-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="gap-2 d-flex">
                                            <a href="{{ route('menu.edit', $directMenu->id) }}" class="btn btn-sm btn-primary">
                                                <i class="p-0 fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('menu.destroy', $directMenu->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="p-0 fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection