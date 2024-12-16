@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('indikator-spbe.index') }}" class="btn btn-light">
        <i class="fas fa-arrow-left"></i>
    </a>
@endsection


@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <style>
        body {
            background-color: var(--background-color);
        }

        .header-title {
            margin: 20px 0;
            font-size: 2rem;
            /* Adjusted for better responsiveness */
            font-weight: bold;
            color: var(--text-color);
            text-align: center;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            /* Stack buttons on small screens */
            align-items: center;
            margin: 20px 0;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
            /* Center buttons */
        }

        .btn-theme {
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            /* Adjusted min width */
            gap: 20px;
            padding: 20px;
        }

        .card {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .header-title {
                font-size: 1.5rem;
                /* Smaller font size for mobile */
            }

            .btn-theme {
                width: 100%;
                /* Full width buttons on small screens */
            }

            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                /* Smaller cards */
            }
        }

        @media (max-width: 576px) {
            .button-container {
                flex-direction: column;
                /* Stack buttons vertically */
            }
        }
    </style>

    <h1 class="header-title">Jelajahi Artikel</h1>

    <div class="mx-4 mb-3 button-container">
        <form action="{{ route('article.index') }}" method="GET" class="mb-2 search-form d-flex">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari artikel..."
                    value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>

        <div class="button-group">
            @if (session('user_informations.role') === 'super-admin' ||
                    session('user_informations.role') === 'pengguna-terdaftar' ||
                    session('user_informations.role') === 'manajer-konten')
                <a href="{{ route('article.checkArticle') }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> Lihat Artikel Saya
                </a>
            @endif

            @if (session('user_informations.role') === 'super-admin' ||
                    session('user_informations.role') === 'pengguna-terdaftar' ||
                    session('user_informations.role') === 'manajer-konten')
                <a href="{{ route('article.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Artikel
                </a>
            @endif

            @if (session('user_informations.role') === 'super-admin' ||
                    session('user_informations.role') === 'pengguna-terdaftar' ||
                    session('user_informations.role') === 'manajer-konten' ||
                    session('user_informations.role') === 'pengguna-umum')
                <a href="{{ route('article.printPDF', ['search' => request()->get('search')]) }}" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak Artikel PDF
                </a>
            @endif

            @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten')
                <a href="{{ route('article.validateIndex') }}" class="btn btn-primary">
                    <i class="fas fa-check -circle"></i> Validasi Index
                </a>
            @endif
        </div>
    </div>

    @if ($artikel->isEmpty())
        <div class="text-center alert alert-warning">
            Tidak ada hasil yang ditemukan
            @if (request()->get('search'))
                untuk kata kunci <strong>"{{ request()->get('search') }}"</strong>.
            @else
                saat ini.
            @endif
        </div>
    @else
        <div class="grid-container">
            @foreach ($artikel as $data)
                <div class="card">
                    @php
                        $imageSrc = str_starts_with($data->image, 'http')
                            ? $data->image
                            : asset('storage/' . $data->image);
                    @endphp

                    {{-- @if (session('user_informations.role') === 'super-admin' || session('user_informations.role') === 'manajer-konten' || session('user_informations.role') === 'pengguna-terdaftar' || session('user_informations.role') === 'pengguna-umum')
                        <a href="{{ route('article.show', $data->id) }}">
                            <img src="{{ $imageSrc }}" class="rounded img-fluid" alt="Article Thumbnail">
                        </a>
                    @else
                        <img src="{{ $imageSrc }}" class="rounded img-fluid" alt="Article Thumbnail">
                    @endif --}}

                    <a href="{{ route('article.show', $data->id) }}">
                        <img src="{{ $imageSrc }}" class="rounded img-fluid" alt="Article Thumbnail">
                    </a>

                    <h5 class="card-title m-2">{{ $data->title }}</h5>
                    <p class="card-text">{{ $data->article_summary }}</p>

                    <div class="card-text">
                        <span>Rating: </span>
                        @php
                            $averageRating = $data->average_rating;
                            $fullStars = floor($averageRating);
                            $halfStar = $averageRating - $fullStars >= 0.5;
                        @endphp

                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor

                        @if ($halfStar)
                            <i class="fas fa-star-half-alt text-warning"></i>
                        @endif

                        @for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                            <i class="far fa-star text-warning"></i>
                        @endfor

                        <span>({{ number_format($averageRating, 1) }})</span>
                        <br>
                        <span> By : {{ $data->ratings->count('rating_value') }} User </span>
                    </div>
                </div>
            @endforeach
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#search').on('input', function() {
                    var searchTerm = $(this).val();
                    if (searchTerm.length > 2) {
                        $.ajax({
                            url: "{{ route('article.index') }}",
                            method: 'GET',
                            data: {
                                term: searchTerm
                            },
                            success: function(data) {
                                $('#search-results').empty();
                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        $('#search-results').append(
                                            '<div class="search-result-item">' + item +
                                            '</div>');
                                    });
                                    $('#search-results').show();
                                } else {
                                    $('#search-results').hide();
                                }
                            },
                            error: function() {
                                console.error('Error fetching data');
                            }
                        });
                    } else {
                        $('#search-results').hide();
                    }
                });

                $(document).on('click', function(event) {
                    if (!$(event.target).closest('.search-box').length) {
                        $('#search-results').hide();
                    }
                });

                $(document).on('click', '.search-result-item', function() {
                    $('#search').val($(this).text());
                    $('#search-results').hide();
                });
            });
        </script>
    @endif
@endsection
