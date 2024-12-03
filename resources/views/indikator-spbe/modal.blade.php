<div class="modal fade" id="indikatorSpbeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah/Edit Indikator SPBE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="indikatorSpbeForm" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-5 col-md-6">
                            <label class="required form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-5 col-md-6">
                            <label class="required form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control" id="person_in_charge" name="person_in_charge" required>
                        </div>
                        <div class="mb-5 col-md-6">
                            <label class="required form-label">Level Saat Ini</label>
                            <input type="text" class="form-control" id="current_level" name="current_level" required>
                        </div>
                        <div class="mb-5 col-md-6">
                            <label class="required form-label">Level Target</label>
                            <input type="text" class="form-control" id="target_level" name="target_level" required>
                        </div>
                        <div class="mb-5 col-md-6">
                            <label class="form-label">Dokumentasi Terkait</label>
                            <input type="text" class="form-control" id="related_documentation" name="related_documentation">
                        </div>
                        <div class="mb-5 col-md-6">
                            <label class="required form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="mb-5 col-md-12">
                            <label class="required form-label">Penjelasan</label>
                            <textarea class="form-control" id="explanation" name="explanation" rows="3" required></textarea>
                        </div>
                        <div class="mb-5 col-md-12">
                            <label class="required form-label">Informasi Aturan</label>
                            <textarea class="form-control" id="rule_information" name="rule_information" rows="3" required></textarea>
                        </div>
                        <div class="mb-5 col-md-12">
                            <label class="required form-label">Kriteria</label>
                            <textarea class="form-control" id="criteria" name="criteria" rows="3" required></textarea>
                        </div>
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