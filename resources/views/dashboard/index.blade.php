@extends('layouts.main.index')

@section('page-name', 'Dashboard')

@section('content')

    <!-- Grafik Statistik Artikel dan Rating, hanya bisa di lihat super-admin dan manajer konten -->
    @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
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
