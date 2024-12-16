<div class="modal fade" id="detailIndikatorModal" tabindex="-1" aria-labelledby="detailIndikatorModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailIndikatorModalLabel">Detail Indikator SPBE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column">
                        <div class="mb-5 card card-bordered flex-grow-1">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Umum</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Nama:</strong>
                                    <p id="detailName"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Penanggung Jawab:</strong>
                                    <p id="detailPersonInCharge"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Level Saat Ini:</strong>
                                    <p id="detailCurrentLevel"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Level Target:</strong>
                                    <p id="detailTargetLevel"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column">
                        <div class="mb-5 card card-bordered flex-grow-1">
                            <div class="card-header">
                                <h3 class="card-title">Detail Informasi</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Penjelasan:</strong>
                                    <p id="detailExplanation"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Informasi Aturan:</strong>
                                    <p id="detailRuleInformation"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Kriteria:</strong>
                                    <p id="detailCriteria"></p>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <strong>Dokumentasi Terkait:</strong>
                                    <div>
                                        <a href="#" id="detailDocumentation" target="_blank"
                                            class="btn btn-sm btn-light-danger">
                                            Lihat Dokumentasi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5 border card card-bordered border-1">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Artikel Terkait</h3>
                                @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                                    <div class="gap-2 d-flex align-items-center">
                                        <select id="articlesSelectAdd" class="form-select form-select-sm"
                                            multiple="multiple">
                                            @foreach ($articles as $article)
                                                <option value="{{ $article->id }}">{{ $article->title }}</option>
                                            @endforeach
                                        </select>
                                        <button onclick="addArticlesToIndikator()"
                                            class="btn btn-sm btn-light-success">Tambah</button>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div id="articleContainer" class="content-list">
                                    <!-- Artikel akan dimuat secara dinamis -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5 card card-bordered">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Forum Diskusi</h3>
                                @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                                    <div class="gap-2 d-flex align-items-center">
                                        <select id="forumsSelectAdd" class="form-select form-select-sm"
                                            multiple="multiple">
                                            @foreach ($forums as $forum)
                                                <option value="{{ $forum->id }}">{{ $forum->title }}</option>
                                            @endforeach
                                        </select>
                                        <button onclick="addForumsToIndikator()"
                                            class="btn btn-sm btn-light-primary">Tambah</button>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div id="forumContainer" class="content-list forum-style">
                                    <!-- Forum akan dimuat secara dinamis -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                    <button type="button" onclick="editIndikator()" class="btn btn-primary">Edit</button>
                @endif
                <button type="button" onclick="deleteIndikator(indikatorData)" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<style>
    .article-item {
        border-radius: 8px;
        padding-inline: 12px;
        padding-block: 8px;
        transition: all 0.2s ease-in-out;
    }

    .article-item:hover {
        box-shadow: 0 0px 8px rgba(0, 0, 0, 0.1);
    }

    .forum-item {
        border-radius: 8px;
        padding-inline: 12px;
        padding-block: 8px;
        transition: all 0.2s ease-in-out;
    }

    .forum-item:hover {
        box-shadow: 0 0px 8px rgba(0, 0, 0, 0.1);
    }
</style>
