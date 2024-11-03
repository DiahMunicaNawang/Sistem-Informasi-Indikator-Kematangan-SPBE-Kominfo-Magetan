@extends('layouts.main.index')

@section('page-name', 'Edit Role')

@section('content')
    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-flush h-md-100">

            <div class="card-body">
                <div class="mb-8">
                    <label for="name" class="required form-label">Nama Menu</label> 
                    <input type="text" placeholder="Dashboard" name="name" class="form-control" id="name" value="{{ old('name', $menu->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="url" class="required form-label">URL</label> 
                    <input type="text" placeholder="/dashboard" name="url" class="form-control" id="url" value="{{ old('url', $menu->url) }}">
                    @error('url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8 form-group">
                    <label for="roles" class="required form-label">Role</label> 
                    <select name="roles[]" id="roles" class="form-control" multiple="multiple">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                @if (in_array($role->id, $roleOld)) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="order" class="required form-label">Urutan Halaman</label>
                    <select name="order" class="form-control" id="order">
                        <option value="beginning" {{ $menu->order == 1 ? 'selected' : '' }}>At Beginning</option>
                        @foreach ($menus as $existingMenu)
                            @if ($existingMenu->id !== $menu->id)
                                <option value="{{ $existingMenu->order }}-after" {{ $menu->order == $existingMenu->order + 1 ? 'selected' : '' }}>
                                    After {{ $existingMenu->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('order')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-0 card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#roles').select2({
                placeholder: 'Pilih akses menu',
                allowClear: true
            });
        });
    </script>
@endsection