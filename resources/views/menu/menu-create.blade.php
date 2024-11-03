@extends('layouts.main.index')

@section('page-name', 'Tambah Menu')

@section('content')
    
    <form action="{{ route('menu.store') }}" method="POST">
        @csrf

        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div class="mb-8">
                    <label for="name" class="required form-label">Nama Menu</label> 
                    <input type="text" placeholder="Dashboard" name="name" class="form-control" id="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="url" class="required form-label">URL</label> 
                    <input type="text" placeholder="/dashboard" name="url" class="form-control" id="url" value="{{ old('url') }}">
                    @error('url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8 form-group">
                    <label for="roles" class="required form-label">Role</label> 
                    <select name="roles[]" id="roles" class="form-control" multiple="multiple">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="order" class="required form-label">Urutan Halaman</label>
                    <select name="order" class="form-control" id="order" required>
                        <option value="beginning">At Beginning</option>
                        @foreach ($menus as $existingMenu)
                            <option value="{{ $existingMenu->order }}-after">After {{ $existingMenu->name }}</option>
                        @endforeach
                    </select>
                    @error('order')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-0 card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#roles').select2({
                placeholder: 'Pilih akses role',
                allowClear: true
            });
        });
    </script>
@endsection