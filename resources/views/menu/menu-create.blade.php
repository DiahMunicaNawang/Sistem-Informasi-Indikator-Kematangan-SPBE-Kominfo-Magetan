@extends('layouts.main.index')

@section('page-name', 'Tambah Menu')

@section('content')
    
<form action="{{ route('menu.store') }}" method="POST">
    @csrf
    <div class="card card-flush h-md-100">
        <!-- Previous form fields remain the same -->
        
        <div class="card-body">
            <div class="mb-8">
                <label for="name" class="required form-label">Nama Menu</label>
                <input type="text" placeholder="Dashboard" name="name" class="form-control" id="name" value="{{ old('name') }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label class="form-label">Tipe Menu</label>
                <div>
                    <label>
                        <input type="radio" name="type" value="category" {{ old('type') == 'category' ? 'checked' : '' }}> Kategori
                    </label>
                    <label>
                        <input type="radio" name="type" value="dropdown" {{ old('type') == 'dropdown' ? 'checked' : '' }}> Dropdown
                    </label>
                    <label>
                        <input type="radio" name="type" value="menu" {{ old('type') == 'menu' ? 'checked' : (empty(old('type')) ? 'checked' : '') }}> Menu
                    </label>
                </div>
            </div>

            <div class="mb-8" id="url_field">
                <label for="url" class="form-label">URL</label>
                <input type="text" placeholder="/dashboard" name="url" class="form-control" id="url" value="{{ old('url') }}">
                @error('url')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8" id="category_id_field">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">None</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8" id="dropdown_id_field">
                <label for="dropdown_id" class="form-label">Dropdown</label>
                <select name="dropdown_id" id="dropdown_id" class="form-control">
                    <option value="">None</option>
                    @foreach ($dropdownOptions as $categoryId => $options)
                        @foreach ($options as $option)
                            <option 
                                data-category="{{ $categoryId }}" 
                                value="{{ $option->id }}" 
                                {{ old('dropdown_id') == $option->id ? 'selected' : '' }}
                                class="dropdown-option category-{{ $categoryId }}"
                            >
                                {{ $option->name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('dropdown_id')
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
        </div>
        <div class="pt-0 card-footer">
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('#roles').select2({
        placeholder: 'Pilih akses role',
        allowClear: true
    });

    // Filter dropdown options based on selected category
    $('#category_id').on('change', function() {
        const selectedCategoryId = $(this).val();
        const dropdownSelect = $('#dropdown_id');
        
        dropdownSelect.val('');
        $('.dropdown-option').hide();
        
        if (selectedCategoryId) {
            $(`.dropdown-option.category-${selectedCategoryId}`).show();
        } else {
            $('.dropdown-option').show();
        }
    });

    // Handle menu type changes
    $('input[name="type"]').on('change', function() {
        const type = $(this).val();
        
        // Reset and hide/show fields
        $('#url, #category_id, #dropdown_id').val('');
        $('#url_field, #category_id_field, #dropdown_id_field').hide();
        
        // Show relevant fields based on type
        if (type === 'menu') {
            $('#url_field, #category_id_field, #dropdown_id_field').show();
        } else if (type === 'dropdown') {
            $('#category_id_field').show();
        }
        
        // Trigger change events
        $('#category_id').trigger('change');
    });

    // Initial setup
    $('input[name="type"]:checked').trigger('change');
});
</script>
@endsection