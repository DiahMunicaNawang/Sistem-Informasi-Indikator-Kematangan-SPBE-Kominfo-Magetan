<div class="modal fade" id="createIndikatorModal" tabindex="-1" aria-labelledby="createIndikatorModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createIndikatorModalLabel">Tambah Indikator SPBE Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createIndikatorForm" action="{{ route('indikator-spbe.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Nama</label>
                            <input type="text" class="form-control @error('name', 'store') is-invalid @enderror"
                                name="name" value="{{ old('name') }}">
                            @error('name', 'store')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Penanggung Jawab</label>
                            <input type="text" class="form-control @error('person_in_charge', 'store') is-invalid @enderror"
                                name="person_in_charge" value="{{ old('person_in_charge') }}">
                            @error('person_in_charge', 'store')
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
                                                value="Level {{ $i }}" {{ $i == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="editCurrentLevel{{ $i }}">Level
                                                {{ $i }}</label>
                                        </div>
                                    @endfor
                                </div>
                                <div>
                                    <input type="text"
                                        class="form-control @error('current_level', 'store') is-invalid @enderror"
                                        name="current_level" id="currentLevelDescription"
                                        value="{{ old('current_level') }}" placeholder="Jelaskan level saat ini">
                                    @error('current_level', 'store')
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
                                                value="Level {{ $i }}" {{ $i == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="editTargetLevel{{ $i }}">Level
                                                {{ $i }}</label>
                                        </div>
                                    @endfor
                                </div>
                                <div>
                                    <input type="text"
                                        class="form-control @error('target_level', 'store') is-invalid @enderror"
                                        name="target_level" id="targetLevelDescription"
                                        value="{{ old('target_level') }}" placeholder="Jelaskan level target">
                                    @error('target_level', 'store')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Penjelasan</label>
                            <textarea class="form-control @error('explanation', 'store') is-invalid @enderror" name="explanation" rows="3">{{ old('explanation') }}</textarea>
                            @error('explanation', 'store')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Informasi Aturan</label>
                            <textarea class="form-control @error('rule_information', 'store') is-invalid @enderror" name="rule_information" rows="3">{{ old('rule_information') }}</textarea>
                            @error('rule_information', 'store')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Kriteria</label>
                            <textarea class="form-control @error('criteria', 'store') is-invalid @enderror" name="criteria" rows="3">{{ old('criteria') }}</textarea>
                            @error('criteria', 'store')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="related_documentation">Dokumentasi Terkait (PDF)</label>
                            <input type="file" class="form-control" id="related_documentation"
                                name="related_documentation">
                            <small class="form-text text-muted">Upload a PDF file (optional).</small>
                            @error('related_documentation', 'store')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Articles -->
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Artikel Terkait (opsional)</label>
                            <select name="articles[]" id="articlesSelectCreate" class="form-control"
                                multiple="multiple">
                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}">{{ $article->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Forums -->
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Forum Terkait (opsional)</label>
                            <select name="forums[]" id="forumsSelectCreate" class="form-control"
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>