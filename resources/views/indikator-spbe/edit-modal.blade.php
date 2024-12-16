<div class="modal fade" id="editIndikatorModal" tabindex="-1" aria-labelledby="editIndikatorModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editIndikatorModalLabel">Edit Indikator SPBE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editIndikatorForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Nama</label>
                            <input type="text" class="form-control @error('name', 'update') is-invalid @enderror"
                                name="name" id="editName" value="{{ old('name') }}">
                            @error('name', 'update')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Penanggung Jawab</label>
                            <input type="text"
                                class="form-control @error('person_in_charge', 'update') is-invalid @enderror"
                                name="person_in_charge" id="editPersonInCharge" value="{{ old('person_in_charge') }}">
                            @error('person_in_charge', 'update')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Level Section -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Level Saat Ini</label>
                            <div class="gap-2 d-flex flex-column">
                                <div class="flex-wrap gap-3 d-flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="form-check">
                                            <input class="form-check-input level-radio" type="radio"
                                                name="current_level_radio" id="editCurrentLevel{{ $i }}"
                                                value="Level {{ $i }}">
                                            <label class="form-check-label"
                                                for="editCurrentLevel{{ $i }}">Level
                                                {{ $i }}</label>
                                        </div>
                                    @endfor
                                </div>
                                <div>
                                    <input type="text"
                                        class="form-control @error('current_level') is-invalid @enderror"
                                        name="current_level" id="editCurrentLevelDescription"
                                        placeholder="Berikan deskripsi level saat ini">
                                    @error('current_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Target Level Section -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Level Target</label>
                            <div class="gap-2 d-flex flex-column">
                                <div class="flex-wrap gap-3 d-flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="form-check">
                                            <input class="form-check-input level-radio" type="radio"
                                                name="target_level_radio" id="editTargetLevel{{ $i }}"
                                                value="Level {{ $i }}">
                                            <label class="form-check-label"
                                                for="editTargetLevel{{ $i }}">Level
                                                {{ $i }}</label>
                                        </div>
                                    @endfor
                                </div>
                                <div>
                                    <input type="text"
                                        class="form-control @error('target_level') is-invalid @enderror"
                                        name="target_level" id="editTargetLevelDescription"
                                        placeholder="Berikan deskripsi level target">
                                    @error('target_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Penjelasan</label>
                            <textarea class="form-control @error('explanation', 'update') is-invalid @enderror" name="explanation"
                                id="editExplanation" rows="3">{{ old('explanation') }}</textarea>
                            @error('explanation', 'update')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Informasi Aturan</label>
                            <textarea class="form-control @error('rule_information', 'update') is-invalid @enderror" name="rule_information"
                                id="editRuleInformation" rows="3">{{ old('rule_information') }}</textarea>
                            @error('rule_information', 'update')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Kriteria</label>
                            <textarea class="form-control @error('criteria', 'update') is-invalid @enderror" name="criteria" id="editCriteria"
                                rows="3">{{ old('criteria') }}</textarea>
                            @error('criteria', 'update')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="related_documentation">Dokumentasi Terkait (opsional)</label>
                            <div class="flex-wrap gap-2 d-flex">
                                <div class="flex-grow-1">
                                    <input type="file" class="form-control" id="related_documentation"
                                    name="related_documentation">
                                </div>
                                <div>
                                    <a href="#" id="detailDocumentationEdit" target="_blank" class="btn btn-light-danger">
                                        Lihat Dokumentasi
                                    </a>
                                </div>
                            </div>
                            <small class="form-text text-muted">Upload a PDF file.</small>
                            @error('related_documentation', 'update')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Articles -->
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Artikel Terkait (opsional)</label>
                            <select name="articles[]" id="articlesSelectEdit" class="form-control"
                                multiple="multiple">
                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}">{{ $article->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Forums -->
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Forum Terkait (opsional)</label>
                            <select name="forums[]" id="forumsSelectEdit" class="form-control"
                                multiple="multiple">
                                @foreach ($forums as $forum)
                                    <option value="{{ $forum->id }}">{{ $forum->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .select2-dropdown-custom {
    z-index: 9999 !important;
    position: absolute !important;
}

#editIndikatorModal .select2-container {
    z-index: 9998 !important;
}
</style>