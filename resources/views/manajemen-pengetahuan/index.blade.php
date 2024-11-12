@extends('layouts.main.index')

@section('page-name', 'Indikator 26: Manajemen Pengetahuan')

@section('content')
<div class="row g-6">
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Artikel</h3>
                <a href="" class="btn btn-sm btn-primary">Lihat Artikel</a>
                <a href="" class="btn btn-sm btn-primary">Buat Artikel</a>
            </div> 
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Forum</h3>
                <a href="{{ route('forum.index') }}" class="btn btn-sm btn-primary">Lihat Forum</a>
                <a href="" class="btn btn-sm btn-primary">Ajukan Pertanyaan</a>
            </div> 
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="card h-100">
            <div class="text-center card-body">
                <h3>Desk</h3>
                <a href="" class="btn btn-sm btn-primary">Lihat Tiket</a>
                <a href="" class="btn btn-sm btn-primary">Buat Tiket</a>
            </div> 
        </div>
    </div>
</div>
    <!--begin::Card widget 7-->
    {{-- <div class="mb-5 card card-flush h-md-50 mb-xl-10">
        <!--begin::Header-->
        <div class="pt-5 card-header">
            <!--begin::Title-->
            <div class="card-title d-flex flex-column">
                <!--begin::Amount-->
                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">357</span>
                <!--end::Amount-->
                <!--begin::Subtitle-->
                <span class="pt-1 text-gray-400 fw-semibold fs-6">Professionals</span>
                <!--end::Subtitle-->
            </div>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Card body-->
        <div class="card-body d-flex flex-column justify-content-end pe-0">
            <!--begin::Title-->
            <span class="mb-2 text-gray-800 fs-6 fw-bolder d-block">Today’s Heroes</span>
            <!--end::Title-->
            <!--begin::Users group-->
            <div class="symbol-group symbol-hover flex-nowrap">
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                    <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                </div>
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                    <img alt="Pic" src="assets/media/avatars/300-11.jpg" />
                </div>
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                    <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                </div>
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                    <img alt="Pic" src="assets/media/avatars/300-2.jpg" />
                </div>
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                    <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                </div>
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                    <img alt="Pic" src="assets/media/avatars/300-12.jpg" />
                </div>
                <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_view_users">
                    <span class="text-gray-300 symbol-label bg-dark fs-8 fw-bold">+42</span>
                </a>
            </div>
            <!--end::Users group-->
        </div>
        <!--end::Card body-->
    </div> --}}
    <!--end::Card widget 7-->
@endsection