@extends('layouts.main.index')

@section('page-name', 'Indikator 26: Manajemen Pengetahuan')

@section('content')
<div class="card card-flush h-md-100">
    <div class="card-header pt-7">
        <div class="card-toolbar d-flex justify-content-between align-items-center w-100">  
            <h3 class="card-title">Indikator SPBE</h3>
            <button onclick="createIndikator()" class="btn btn-sm btn-success">
                Tambah Indikator SPBE
            </button>
        </div>
    </div>
    
    <div class="pt-6 card-body">
        <div class="table-responsive">
            <table class="table align-middle table-row-bordered table-row-gray-100 gs-0 gy-3">
                <thead>
                    <tr class="text-center text-gray-400 fw-bold fs-7 text-uppercase">
                        <th class="w-25px">#</th>
                        <th class="min-w-150px">Nama</th>
                        <th class="min-w-150px">Penanggung Jawab</th>
                        <th class="min-w-100px">Level Saat Ini</th>
                        <th class="min-w-100px">Level Target</th>
                        <th class="min-w-100px">Status</th>
                        <th class="min-w-200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($indikatorSpbes as $indikator)
                        <tr>
                            <td class="text-center">
                                <i class="cursor-pointer bi bi-eye fs-3 text-info" 
                                   onclick="showDetailModal({{ json_encode($indikator) }})">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </td>
                            <td>{{ $indikator->name }}</td>
                            <td>{{ $indikator->person_in_charge }}</td>
                            <td>{{ $indikator->current_level }}</td>
                            <td>{{ $indikator->target_level }}</td>
                            <td class="text-center">
                                <form action="{{ route('indikator-spbe.toggle-status', $indikator->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" 
                                           class="btn-check status-toggle" 
                                           id="status_{{ $indikator->id }}"
                                           autocomplete="off"
                                           {{ $indikator->status === 'active' ? 'checked' : '' }}
                                           onchange="this.form.submit()"
                                    >
                                    <label class="btn btn-sm {{ $indikator->status === 'active' ? 'btn-success' : 'btn-danger' }}" 
                                           for="status_{{ $indikator->id }}">
                                        {{ $indikator->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </label>
                                </form>
                            </td>
                            <td>
                                <div class="gap-2 d-flex justify-content-center">
                                    @if($indikator->status === 'active')
                                    <button onclick="editIndikator({{ json_encode($indikator) }})" class="btn btn-primary btn-sm">
                                        Edit
                                    </button>
                                        <form action="{{ route('indikator-spbe.destroy', $indikator->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus indikator ini?')">Hapus</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Tidak dapat diedit</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($indikatorSpbes->hasPages())
                <div class="mt-4 d-flex justify-content-end">
                    {{ $indikatorSpbes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="indikatorModal" tabindex="-1" aria-labelledby="indikatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="indikatorModalLabel">Form Indikator SPBE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="indikatorForm" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" id="modalName" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control" name="person_in_charge" id="modalPersonInCharge" required>
                        </div>
                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Indikator SPBE -->
<div class="modal fade" id="detailIndikatorModal" tabindex="-1" aria-labelledby="detailIndikatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailIndikatorModalLabel">Detail Indikator SPBE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Informasi Utama -->
                    <div class="mb-5 col-md-6">
                        <h4 class="text-primary">Informasi Dasar</h4>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <strong>Nama Indikator:</strong>
                                <p id="detailName"></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Penanggung Jawab:</strong>
                                <p id="detailPersonInCharge"></p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <strong>Level Saat Ini:</strong>
                                <p id="detailCurrentLevel"></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Level Target:</strong>
                                <p id="detailTargetLevel"></p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <strong>Status:</strong>
                                <p id="detailStatus"></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Dokumentasi Terkait:</strong>
                                <p id="detailRelatedDocumentation"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="mb-5 col-md-6">
                        <h4 class="text-primary">Informasi Tambahan</h4>
                        <div class="mb-3">
                            <strong>Penjelasan:</strong>
                            <p id="detailExplanation" class="text-wrap"></p>
                        </div>
                        <div class="mb-3">
                            <strong>Informasi Aturan:</strong>
                            <p id="detailRuleInformation" class="text-wrap"></p>
                        </div>
                        <div class="mb-3">
                            <strong>Kriteria:</strong>
                            <p id="detailCriteria" class="text-wrap"></p>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-5 col-12">
                        <h4 class="text-primary">Informasi Waktu</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Tanggal Ditambahkan:</strong>
                                <p id="detailDateAdded"></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Terakhir Diperbarui:</strong>
                                <p id="detailLastUpdatedDate"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button id="editButton" class="btn btn-primary" onclick="editIndikator()">
                    <i class="ki-duotone ki-pencil me-2"></i>Edit
                </button>
                <button id="deleteButton" class="btn btn-danger" onclick="deleteIndikator()">
                    <i class="ki-duotone ki-trash me-2"></i>Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentIndikator = null;

    function showDetailModal(indikator) {
        // Simpan indikator untuk digunakan di tombol edit/hapus
        currentIndikator = indikator;

        // Isi detail modal
        $('#detailName').text(indikator.name);
        $('#detailPersonInCharge').text(indikator.person_in_charge);
        $('#detailCurrentLevel').text(indikator.current_level);
        $('#detailTargetLevel').text(indikator.target_level);
        $('#detailStatus').text(indikator.status === 'active' ? 'Aktif' : 'Tidak Aktif');
        $('#detailRelatedDocumentation').text(indikator.related_documentation || 'Tidak ada');
        $('#detailExplanation').text(indikator.explanation);
        $('#detailRuleInformation').text(indikator.rule_information);
        $('#detailCriteria').text(indikator.criteria);
        $('#detailDateAdded').text(new Date(indikator.date_added).toLocaleString());
        $('#detailLastUpdatedDate').text(new Date(indikator.last_updated_date).toLocaleString());

        // Atur visibilitas tombol berdasarkan status
        if (indikator.status !== 'active') {
            $('#editButton, #deleteButton').prop('disabled', true);
        } else {
            $('#editButton, #deleteButton').prop('disabled', false);
        }

        // Tampilkan modal
        $('#detailIndikatorModal').modal('show');
    }

    function editIndikator() {
        if (currentIndikator) {
            // Tutup modal detail
            $('#detailIndikatorModal').modal('hide');
            
            // Buka modal edit dengan data indikator
            openModal('edit', currentIndikator);
        }
    }

    function deleteIndikator() {
        if (currentIndikator) {
            if (confirm('Apakah Anda yakin ingin menghapus indikator ini?')) {
                // Kirim form hapus
                $.ajax({
                    url: `/indikator-spbe/${currentIndikator.id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Tutup modal
                        $('#detailIndikatorModal').modal('hide');
                        
                        // Refresh halaman atau hapus baris dari tabel
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Gagal menghapus indikator');
                    }
                });
            }
        }
    }
</script>
@endsection

