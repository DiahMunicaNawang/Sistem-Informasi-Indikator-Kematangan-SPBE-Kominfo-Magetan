@extends('layouts.main.index')

@section('page-name', 'Tambah Role')

@section('content')
    <form action="{{ route('role.store') }}" method="POST">
        @csrf

        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div class="mb-8">
                    <label for="name" class="required form-label">Nama Role</label> 
                    <input type="text" placeholder="Admin" name="name" class="form-control" id="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="menus" class="required form-label">Menu</label> 
                    <select name="menus[]" id="menus" class="form-control" multiple="multiple">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                    @error('menus')
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
            $('#menus').select2({
                placeholder: 'Pilih akses menu',
                allowClear: true
            });
        });
    </script>
@endsection