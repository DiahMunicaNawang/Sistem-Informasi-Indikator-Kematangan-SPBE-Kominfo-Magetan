@extends('layouts.main.index')

@section('page-name', 'Dashboard')

@section('content')
    <!--begin::Card widget 20-->
    <div class="mb-5 card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-xl-10"
        style="background-color: #F1416C;background-image:url('assets/media/patterns/vector-1.png')">
        <!--begin::Header-->
        <div class="pt-5 card-header">
            <!--begin::Title-->
            <div class="card-title d-flex flex-column">
                <!--begin::Amount-->
                <span class="text-white fs-2hx fw-bold me-2 lh-1 ls-n2">69</span>
                <!--end::Amount-->
                <!--begin::Subtitle-->
                <span class="pt-1 text-white opacity-75 fw-semibold fs-6">Active Projects</span>
                <!--end::Subtitle-->
            </div>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Card body-->
        <div class="pt-0 card-body d-flex align-items-end">
            <!--begin::Progress-->
            <div class="mt-3 d-flex align-items-center flex-column w-100">
                <div class="mt-auto mb-2 text-white opacity-75 d-flex justify-content-between fw-bold fs-6 w-100">
                    <span>43 Pending</span>
                    <span>72%</span>
                </div>
                <div class="mx-3 bg-white bg-opacity-50 rounded h-8px w-100">
                    <div class="bg-white rounded h-8px" role="progressbar" style="width: 72%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Progress-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card widget 20-->
    <!--begin::Card widget 7-->
    <div class="mb-5 card card-flush h-md-50 mb-xl-10">
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
    </div>

    <!-- Grafik Statistik Artikel dan Rating, hanya bisa di lihat super-admin -->
    @if (auth()->user() && auth()->user()->role_id == 1)
        <div class="mb-5 card card-flush h-md-50 mb-xl-10"">
            <div class="pt-5 card-header">
                <!--begin::Title-->
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">Statistik Artikel & Rating</span>
                    <span class="pt-1 text-gray-400 fw-semibold fs-6">Artikel dan Jumlah Rating</span>
                </div>
                <!--end::Title-->
            </div>
            <div class="card-body">
                <!-- Canvas untuk Grafik -->
                <canvas id="statisticsChart"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('statisticsChart').getContext('2d');
            var statisticsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                        'Oktober', 'November', 'Desember'
                    ], // Bulan
                    datasets: [{
                            label: 'Jumlah Artikel',
                            data: [
                                @foreach ($statistics['articles_per_month'] as $count)
                                    {{ $count }},
                                @endforeach
                            ],
                            backgroundColor: 'rgba(75, 192, 192, 0.5)', // Warna batang artikel
                            borderColor: 'rgba(75, 192, 192, 1)', // Warna border artikel
                            borderWidth: 1
                        },
                        {
                            label: 'Jumlah Rating',
                            data: [
                                @foreach ($statistics['ratings_per_month'] as $count)
                                    {{ $count }},
                                @endforeach
                            ],
                            backgroundColor: 'rgba(255, 159, 64, 0.5)', // Warna batang rating
                            borderColor: 'rgba(255, 159, 64, 1)', // Warna border rating
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + (tooltipItem.datasetIndex === 0 ? ' artikel' :
                                        ' rating'); // Tooltip dengan label artikel/rating
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Mulai dari 0
                        }
                    }
                }
            });
        </script>
    @endif
@endsection
