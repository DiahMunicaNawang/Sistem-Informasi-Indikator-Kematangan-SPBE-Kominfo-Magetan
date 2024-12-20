@extends('layouts.main.index')

@section('page-name', 'Indikator SPBE')

@section('content')
    <div class="card card-flush h-md-100">
        @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
            <div class="card-header pt-7">
                <div class="card-toolbar d-flex justify-content-between align-items-center w-100">
                    <button onclick="createIndikator()" class="btn btn-sm btn-success">
                        Tambah Indikator SPBE
                    </button>
                </div>
            </div>
        @endif

        <div class="pt-6 card-body">
            <div class="table-responsive">
                <table class="table align-middle table-row-bordered table-row-gray-100 gs-0 gy-3">
                    <thead>
                        <tr class="text-gray-400 fw-bold fs-7 text-uppercase">
                            <th class="w-25px">#</th>
                            <th class="w-25px">No</th>
                            <th class="min-w-200px">Nama</th>
                            <th class="min-w-200px">Penjelasan</th>
                            <th class="min-w-200px">Kriteria</th>
                            <th class="min-w-200px">Level Saat Ini</th>
                            <th class="min-w-200px">Level Target</th>
                            <th class="min-w-200px">Penanggung Jawab</th>
                            <th class="min-w-250px">Tanggal Pembaruan Terakhir</th>
                            @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                                <th class="min-w-100px">Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indikators as $indikator)
                            <tr>
                                <td class="text-center">
                                    @if ($indikator->status === 'active')
                                        <i class="cursor-pointer bi bi-eye fs-3 text-info"
                                            onclick="showIndikatorDetail({{ $indikator->id }})">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $indikator->name }}</td>
                                <td>{!! $indikator->explanation !!}</td>
                                <td>{{ $indikator->criteria }}</td>
                                <td>{{ $indikator->current_level }}</td>
                                <td>{{ $indikator->target_level }}</td>
                                <td>{{ $indikator->person_in_charge }}</td>
                                <td>{{ \Carbon\Carbon::parse($indikator->last_updated_date)->format('d-m-Y') }}</td>
                                @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                                    <td>
                                        <form action="{{ route('indikator-spbe.toggle-status', $indikator->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" type="checkbox"
                                                    id="status_{{ $indikator->id }}" autocomplete="off"
                                                    {{ $indikator->status === 'active' ? 'checked' : '' }}
                                                    onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($indikators->hasPages())
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $indikators->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- New Create Indikator Modal -->
    @include('indikator-spbe.create-modal')

    <!-- Detail Indikator Modal -->
    @include('indikator-spbe.detail-modal')

    <!-- Edit Indikator Modal -->
    @include('indikator-spbe.edit-modal')


    <script>
        $(document).ready(function() {
            $('#articlesSelectCreate').select2({
                placeholder: "Pilih atau Cari Artikel",
            }).on('select2:unselect', function(e) {
                setTimeout(() => {
                    $(this).select2('close'); // Tutup dropdown secara manual
                }, 0);
            });

            $('#forumsSelectCreate').select2({
                placeholder: "Pilih atau Cari Forum",
            }).on('select2:unselect', function(e) {
                setTimeout(() => {
                    $(this).select2('close'); // Tutup dropdown secara manual
                }, 0);
            });

            $('#articlesSelectEdit').select2({
                placeholder: "Pilih atau Cari Artikel",
                dropdownCssClass: 'select2-dropdown-custom', // Mengatasi bug dropdown di modal
            }).on('select2:unselect', function(e) {
                e.stopImmediatePropagation();
                setTimeout(() => {
                    $(this).select2('close'); // Tutup dropdown secara manual
                }, 0);
            });

            $('#forumsSelectEdit').select2({
                placeholder: "Pilih atau Cari Forum",
                dropdownCssClass: 'select2-dropdown-custom', // Mengatasi bug dropdown di modal
            }).on('select2:unselect', function(e) {
                e.stopImmediatePropagation();
                setTimeout(() => {
                    $(this).select2('close'); // Tutup dropdown secara manual
                }, 0);
            });

            // detail-modal
            $('#articlesSelectAdd').select2({
                placeholder: "Pilih atau Cari Artikel",
                multiple: true,
                width: '100%'
            });

            $('#forumsSelectAdd').select2({
                placeholder: "Pilih atau Cari Forum",
                multiple: true,
                width: '100%'
            });

            @if ($errors->store->any())
                $('#createIndikatorModal').modal('show');
            @endif

            @if ($errors->update->any())
                $('#editIndikatorModal').modal('show');
                editIndikator();
            @endif
        });

        let indikatorData = null;

        function createIndikator() {
            $('#createIndikatorModal').modal('show');
        }

        function showIndikatorDetail(id) {
            console.log('idb', id)
            $.ajax({
                url: '{{ route('indikator-spbe.show', ':id') }}'.replace(':id', id),
                method: 'GET',
                success: function(data) {
                    indikatorData = data;
                    console.log('Indikator Data:', data.indikator.explanation); // Tambahkan logging ini

                    $('#detailName').text(data.indikator.name);
                    $('#detailPersonInCharge').text(data.indikator.person_in_charge);
                    $('#detailCurrentLevel').text(data.indikator.current_level);
                    $('#detailTargetLevel').text(data.indikator.target_level);
                    $('#detailExplanation').html(data.indikator.explanation);
                    $('#detailRuleInformation').text(data.indikator.rule_information);
                    $('#detailCriteria').text(data.indikator.criteria);

                    // Atur dokumentasi jika ada
                    if (data.indikator.related_documentation) {
                        let docUrl = '{{ asset('storage/related_documentations/') }}/' + data.indikator
                            .related_documentation;
                        $('#detailDocumentation').attr('href', docUrl).show();
                    } else {
                        $('#detailDocumentation').hide();
                    }

                    let articlesHtml = '';
                    data.indikator.articles.forEach(function(article) {
                        let url = '{{ route('article.show', ':id') }}'.replace(':id', article.id);

                        articlesHtml += `
                        <a href="${url}" class="text-decoration-none text-dark">
                            <li class="mb-2 list-group-item article-item">
                                    <h5 class="mb-1">${article.title}</h5>
                                    <small class="text-muted">${article.article_summary.length > 50 ? article.article_summary.substring(0, 50) + '...' : article.article_summary}</small>
                            </li>
                        </a>
                    `;
                    });
                    $('#articleContainer').html(articlesHtml);

                    // Menampilkan forum diskusi
                    let forumsHtml = '';
                    data.indikator.forums.forEach(function(forum) {
                        let url = '{{ route('forum-discussion.show', ':id') }}'.replace(':id', forum
                            .id);

                        forumsHtml += `
                        <a href="${url}" class="text-decoration-none text-dark">
                            <li class="mb-2 list-group-item forum-item">
                                    <h5 class="mb-1">${forum.title}</h5>
                                    <small class="text-muted">${forum.description.length > 50 ? forum.description.substring(0, 50) + '...' : forum.description}</small>
                            </li>
                        </a>
                    `;
                    });
                    $('#forumContainer').html(forumsHtml);

                    // Tampilkan modal
                    $('#detailIndikatorModal').modal('show');

                    // Simpan indikatorId ke sessionStorage agar saat edit memiliki id
                    sessionStorage.setItem('indikatorId', data.indikator.id);
                },
                error: function() {
                    alert('Terjadi kesalahan, coba lagi!');
                }
            });

            $('#detailIndikatorModal').modal('show');
        }

        function editIndikator() {

            const indikatorId = sessionStorage.getItem('indikatorId');

            $.ajax({
                url: '{{ route('indikator-spbe.show', ':id') }}'.replace(':id', indikatorId),
                method: 'GET',
                success: function(data) {
                    const actionUrl = '{{ route('indikator-spbe.update', ':id') }}'.replace(':id',
                    indikatorId);
                    $('#editIndikatorForm').attr('action', actionUrl); // Mengganti action form

                    // Isi inputan nama
                    $('#editName').val(data.indikator.name);

                    // Isi inputan penanggung jawab
                    $('#editPersonInCharge').val(data.indikator.person_in_charge);

                    // Current Level
                    if (data.indikator.current_level) {
                        const currentRadio = data.indikator.current_level.split(' - ')[0]
                            .trim(); // Ambil "Level x"
                        $(`input[name="current_level_radio"][value="${currentRadio}"]`).prop('checked',
                            true); // Pilih radio
                        $('#editCurrentLevelDescription').val(data.indikator.current_level.split(' - ')[1]
                            ?.trim() ||
                            ''); // Ambil deskripsi
                    }

                    // Target Level
                    if (data.indikator.target_level) {
                        const targetRadio = data.indikator.target_level.split(' - ')[0]
                            .trim(); // Ambil "Level x"
                        $(`input[name="target_level_radio"][value="${targetRadio}"]`).prop('checked',
                            true); // Pilih radio
                        $('#editTargetLevelDescription').val(data.indikator.target_level.split(' - ')[1]
                            ?.trim() ||
                            ''); // Ambil deskripsi
                    }

                    // Isi inputan penjelasan
                    if (explanationEditEditor) {
                        explanationEditEditor.setData(data.indikator.explanation || '');
                    }

                    // Isi inputan informasi aturan
                    $('#editRuleInformation').val(data.indikator.rule_information);

                    // Isi inputan kriteria
                    $('#editCriteria').val(data.indikator.criteria);

                    // Isi inputan dokumentasi terkait
                    if (data.indikator.related_documentation) {
                        let docUrl = '{{ asset('storage/related_documentations/') }}/' + data.indikator
                            .related_documentation;
                        $('#detailDocumentationEdit').attr('href', docUrl).show();
                    } else {
                        $('#detailDocumentationEdit').hide();
                    }

                    // Gunakan data tambahan jika ada
                    const allArticles = data.indikator.articles || [];
                    const allForums = data.indikator.forums || [];

                    // Set artikel yang sudah terpilih
                    if (allArticles && allArticles.length > 0) {
                        const articleIds = allArticles.map(article => article.id);
                        $('#articlesSelectEdit').val(articleIds).trigger('change');
                        console.log('Selected Articles:', $('#articlesSelectEdit').val());
                    }

                    // Set forum yang sudah terpilih
                    if (allForums && allForums.length > 0) {
                        const forumIds = allForums.map(forum => forum.id);
                        $('#forumsSelectEdit').val(forumIds).trigger('change');
                        console.log('Selected Forums:', $('#forumsSelectEdit').val());
                    }


                    $('#detailIndikatorModal').modal('hide');
                    $('#editIndikatorModal').modal('show');
                },
                error: function() {
                    alert('Terjadi kesalahan, coba lagi!');
                }
            });
        }

        function deleteIndikator(indikatorData) {
            console.log(indikatorData)
            if (indikatorData) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus indikator ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#009ef7',
                    cancelButtonColor: '#f1416c',
                    confirmButtonText: 'Ya, hapus indikator ini!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim form hapus
                        $.ajax({
                            url: '{{ route('indikator-spbe.destroy', ':id') }}'.replace(':id',
                                indikatorData.indikator.id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Tutup modal
                                    $('#detailIndikatorModal').modal('hide');

                                    // Refresh halaman atau hapus baris dari tabel
                                    location.reload();

                                    // Atau tampilkan pesan sukses
                                    Swal.fire('Berhasil', response.message, 'success');
                                } else {
                                    // Tangani kasus tidak berhasil
                                    Swal.fire('Gagal', response.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                // Tangani error ajax
                                ;
                                console.error(xhr);
                                Swal.fire('Gagal menghapus indikator', xhr.responseJSON?.message ||
                                    'Terjadi kesalahan', 'error');
                            }
                        });
                    }
                });
            }
        }

        function addArticlesToIndikator() {
            const articleIds = $('#articlesSelectAdd').val();

            if (!articleIds || articleIds.length === 0) {
                Swal.fire('Peringatan', 'Pilih artikel terlebih dahulu', 'warning');
                return;
            }

            $.ajax({
                url: '{{ route('indikator-spbe.add-article-from-detail') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    indikator_id: indikatorData.indikator.id,
                    article_ids: articleIds
                },
                success: function(response) {
                    if (response.success) {
                        // Refresh the articles list
                        showIndikatorDetail(indikatorData.indikator.id);

                        // Reset the select2
                        $('#articlesSelectAdd').val(null).trigger('change');

                        Swal.fire('Berhasil', 'Artikel berhasil ditambahkan', 'success');
                    } else {
                        Swal.fire('Gagal', response.message || 'Gagal menambahkan artikel', 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            });
        }

        function addForumsToIndikator() {
            const forumIds = $('#forumsSelectAdd').val();

            if (!forumIds || forumIds.length === 0) {
                Swal.fire('Peringatan', 'Pilih forum terlebih dahulu', 'warning');
                return;
            }

            $.ajax({
                url: '{{ route('indikator-spbe.add-forum-from-detail') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    indikator_id: indikatorData.indikator.id,
                    forum_ids: forumIds
                },
                success: function(response) {
                    if (response.success) {
                        // Refresh the forums list
                        showIndikatorDetail(indikatorData.indikator.id);

                        // Reset the select2
                        $('#forumsSelectAdd').val(null).trigger('change');

                        Swal.fire('Berhasil', 'Forum berhasil ditambahkan', 'success');
                    } else {
                        Swal.fire('Gagal', response.message || 'Gagal menambahkan forum', 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Gagal', xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            });
        }
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#explanationCreate'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link',
                    'bulletedList', 'numberedList', 'blockQuote'
                ]
            })
            .then(editor => {
                explanationEditEditor = editor; // Simpan referensi editor
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#explanationEdit'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link',
                    'bulletedList', 'numberedList', 'blockQuote'
                ]
            })
            .then(editor => {
                explanationEditEditor = editor; // Simpan referensi editor
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
