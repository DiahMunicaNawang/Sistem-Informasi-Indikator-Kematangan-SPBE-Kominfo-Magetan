@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('menu.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endSection

@section('page-name', 'Tambah Menu')

@section('content')
    
<form action="{{ route('menu.store') }}" method="POST">
    @csrf
    <div class="card card-flush h-md-100">
        <div class="card-body">
            {{-- Name field --}}
            <div class="mb-8">
                <label for="name" class="required form-label">Nama Menu</label>
                <input type="text" 
                       placeholder="Dashboard" 
                       name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Type field --}}
            <div class="mb-8">
                <label class="required form-label">Tipe Menu</label>
                <div class="@error('type') is-invalid @enderror">
                    <label class="me-3">
                        <input type="radio" 
                               name="type" 
                               value="category" 
                               {{ old('type') == 'category' ? 'checked' : '' }}> 
                        Kategori
                    </label>
                    <label class="me-3">
                        <input type="radio" 
                               name="type" 
                               value="dropdown" 
                               {{ old('type') == 'dropdown' ? 'checked' : '' }}> 
                        Dropdown
                    </label>
                    <label>
                        <input type="radio" 
                               name="type" 
                               value="menu" 
                               {{ old('type', 'menu') == 'menu' ? 'checked' : '' }}> 
                        Menu
                    </label>
                </div>
                @error('type')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- URL field --}}
            <div class="mb-8" id="url_field">
                <label for="url" class="form-label">URL</label>
                <input type="text" 
                       placeholder="/dashboard" 
                       name="url" 
                       class="form-control @error('url') is-invalid @enderror" 
                       id="url" 
                       value="{{ old('url') }}">
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Category field --}}
            <div class="mb-8" id="category_id_field">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" 
                        id="category_id" 
                        class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">None</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Dropdown field --}}
            <div class="mb-8" id="dropdown_id_field">
                <label for="dropdown_id" class="form-label">Dropdown</label>
                <select name="dropdown_id" 
                        id="dropdown_id" 
                        class="form-control @error('dropdown_id') is-invalid @enderror">
                    <option value="">None</option>
                    @foreach ($dropdownOptions as $categoryId => $options)
                        @foreach ($options as $option)
                            <option 
                                data-category="{{ $categoryId }}" 
                                value="{{ $option->id }}" 
                                {{ old('dropdown_id') == $option->id ? 'selected' : '' }}
                                class="dropdown-option {{ $categoryId === 0 ? 'independent' : 'category-'.$categoryId }}"
                            >
                                {{ $option->name }}
                                {{ $categoryId === 0 ? '(Independent)' : '' }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('dropdown_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Roles field --}}
            <div class="mb-8">
                <label for="roles" class="required form-label">Role</label>
                <select name="roles[]" 
                        id="roles" 
                        class="form-control @error('roles') is-invalid @enderror" 
                        multiple="multiple">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" 
                                {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('roles')
                    <div class="invalid-feedback">{{ $message }}</div>
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
        
        // Store current selection
        const currentValue = dropdownSelect.val();
        
        // Reset dropdown
        dropdownSelect.val('');
        
        // Hide all options first
        $('.dropdown-option').hide();
        
        if (selectedCategoryId) {
            // Show options for selected category
            $(`.dropdown-option.category-${selectedCategoryId}`).show();
            
            // If current selection belongs to new category, keep it
            if ($(`.dropdown-option.category-${selectedCategoryId}[value="${currentValue}"]`).length) {
                dropdownSelect.val(currentValue);
            }
        } else {
            // If no category selected, show independent dropdowns
            $('.dropdown-option.independent').show();
            
            // If current selection is independent, keep it
            if ($(`.dropdown-option.independent[value="${currentValue}"]`).length) {
                dropdownSelect.val(currentValue);
            }
        }
    });

    // Handle menu type changes
    $('input[name="type"]').on('change', function() {
        const type = $(this).val();
        
        // Hide all fields first
        $('#url_field, #category_id_field, #dropdown_id_field').hide();
        
        // Show relevant fields based on type
        switch(type) {
            case 'menu':
                $('#url_field, #category_id_field, #dropdown_id_field').show();
                break;
            case 'dropdown':
                $('#category_id_field').show();
                break;
            case 'category':
                // No additional fields needed
                break;
        }
        
        // Reset fields when changing type
        if (type !== 'menu') {
            $('#url, #dropdown_id').val('');
        }
        if (type === 'category') {
            $('#category_id').val('');
        }
        
        // Trigger category change to update dropdown options
        $('#category_id').trigger('change');
    });

    // Initial setup - trigger type change to set correct field visibility
    $('input[name="type"]:checked').trigger('change');
});
</script>
@endsection