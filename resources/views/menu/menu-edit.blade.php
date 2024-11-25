@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('menu.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
@endSection

@section('page-name', 'Edit Menu')

@section('content')
    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-flush h-md-100">
            <div class="card-body">
                <div class="mb-8">
                    <label for="name" class="required form-label">Nama Menu</label>
                    <input type="text" placeholder="Dashboard" name="name" class="form-control" id="name"
                        value="{{ old('name', $menu->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="form-label">Tipe Menu</label>
                    <div>
                        <label>
                            <input type="radio" name="type" value="category"
                                {{ old('type', $menuType) == 'category' ? 'checked' : '' }}> Kategori
                        </label>
                        <label>
                            <input type="radio" name="type" value="dropdown"
                                {{ old('type', $menuType) == 'dropdown' ? 'checked' : '' }}> Dropdown
                        </label>
                        <label>
                            <input type="radio" name="type" value="menu"
                                {{ old('type', $menuType) == 'menu' ? 'checked' : '' }}> Menu
                        </label>
                    </div>
                </div>

                <div class="mb-8" id="url_field">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" placeholder="/dashboard" name="url" class="form-control" id="url"
                        value="{{ old('url', $menu->url) }}">
                    @error('url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8" id="category_id_field">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control" value="{{ old('category_id') }}">
                        <option value="">None</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
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
                                <option data-category="{{ $categoryId }}" value="{{ $option->id }}"
                                    {{ old('dropdown_id', $menu->dropdown_id) == $option->id ? 'selected' : '' }}
                                    class="dropdown-option category-{{ $categoryId }}">
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
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ in_array($role->id, old('roles', $roleOld)) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-0 card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
            </div>
        </div>
    </form>

    {{-- @push('script') --}}
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#roles').select2({
                placeholder: 'Pilih akses role',
                allowClear: true
            });

            // Store initial values
            const initialCategoryId = $('#category_id').val();
            const initialDropdownId = $('#dropdown_id').val();

            // Filter dropdown options based on selected category
            function updateDropdownOptions(selectedCategoryId, keepSelection = false) {
                const dropdownSelect = $('#dropdown_id');
                const currentValue = dropdownSelect.val();

                $('.dropdown-option').hide();

                if (selectedCategoryId) {
                    $(`.dropdown-option.category-${selectedCategoryId}`).show();

                    // Check if current selection is valid for new category
                    const visibleOptions = $(`.dropdown-option.category-${selectedCategoryId}:visible`);
                    const currentOptionVisible = visibleOptions.filter(`[value="${currentValue}"]`).length > 0;

                    if (!currentOptionVisible && !keepSelection) {
                        dropdownSelect.val('');
                    }
                } else {
                    $('.dropdown-option').show();
                }
            }

            // Handle menu type changes
            function updateFieldsVisibility(type, isInitial = false) {
                // Hide all fields first
                $('#url_field, #category_id_field, #dropdown_id_field').hide();

                // Show relevant fields based on type
                if (type === 'menu') {
                    $('#url_field, #category_id_field, #dropdown_id_field').show();

                    if (isInitial) {
                        // On initial load, update dropdown options while keeping the initial selection
                        updateDropdownOptions(initialCategoryId, true);
                    } else {
                        updateDropdownOptions($('#category_id').val());
                    }
                } else if (type === 'dropdown') {
                    $('#category_id_field').show();
                }
            }

            // Category change handler
            $('#category_id').on('change', function() {
                updateDropdownOptions($(this).val());
            });

            // Type change handler
            $('input[name="type"]').on('change', function() {
                const newType = $(this).val();
                const oldType = '{{ $menuType }}';

                // Jika sebelumnya adalah kategori dan diubah ke tipe lain
                if (oldType === 'category' && newType !== 'category') {
                    if (!confirm(
                            'Mengubah tipe dari kategori akan membuat semua menu di dalamnya tidak tampil. Lanjutkan?'
                            )) {
                        // Jika user membatalkan, kembalikan ke tipe kategori
                        $('input[name="type"][value="category"]').prop('checked', true);
                        return;
                    }
                }

                updateFieldsVisibility(newType);
            });

            // Initial setup
            const initialType = $('input[name="type"]:checked').val();
            updateFieldsVisibility(initialType, true);
        });
    </script>
    {{-- @endpush --}}
@endsection
