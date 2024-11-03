@extends('layouts.main.index')

@section('page-name', 'Edit Role')

@section('content')

    <form action="{{ route('role.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-flush h-md-100">

            <div class="card-body">
                <div class="mb-8">
                    <label for="name" class="required form-label">Nama Role</label> 
                    <input type="text" placeholder="Dashboard" name="name" class="form-control" id="name" value="{{ old('name', $role->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="menus" class="required form-label">Menu</label> 
                    <select name="menus[]" id="menus" class="form-control" multiple="multiple">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" 
                                @if(in_array($menu->id, $menuOld)) selected @endif>
                                {{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('menus')
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
            $('#menus').select2({
                placeholder: 'Pilih akses menu',
                allowClear: true
            });
        });
    </script>
@endsection