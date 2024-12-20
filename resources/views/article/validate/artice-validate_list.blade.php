@extends('layouts.main.index')

@section('back-button')
    <a href="{{ route('article.index') }}">
        <i class="bi bi-arrow-left-square-fill text-muted" style="font-size: 34px"></i>
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
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .btn-theme {
            background-color: var(--button-bg-color);
            color: var(--button-text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-theme:hover {
            background-color: var(--button-bg-hover-color);
        }

        .search-box {
            display: flex;
            align-items: center;
            margin: 0 auto;
            width: 100%;
            /* Full width on small screens */
        }

        .search-input {
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            width: 100%;
            background-color: var(--input-bg-color);
            color: var(--text-color);
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

            .search-box {
                flex-direction: column;
                /* Stack search input and button */
                width: 100%;
            }

            .search-input {
                margin-bottom: 10px;
                /* Space between input and button */
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
                align-items: center;
                /* Center buttons */
            }
        }
    </style>

    <h5 class="header-title">Validasi Artikel</h5>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('article.validateIndex') }}" method="GET" class="search-form">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari artikel..."
                            value="{{ request()->get('search') }}">

                        <select name="status" class="form-select" aria-label="Filter Status">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request()->get('status') === 'published' ? 'selected' : '' }}>
                                Published</option>
                            <option value="draft" {{ request()->get('status') === 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="rejected" {{ request()->get('status') === 'rejected' ? 'selected' : '' }}>
                                Rejected</option>
                            <option value="proses" {{ request()->get('status') === 'proses' ? 'selected' : '' }}>Proses
                            </option>
                        </select>

                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
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

                    <a href="{{ route('article.validate', $data->id) }}">
                        <img src="{{ $imageSrc }}" class="img-fluid rounded" alt="Article Thumbnail">
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

                    <div class="mt-auto">
                        <form action="{{ route('article.destroy', $data->id) }}" method="POST"
                            id="delete-form-{{ $data->id }}">
                            @csrf
                            @method('DELETE')
                            <div class="row justify-content-end">
                                <button type="button" class="align-self-end btn btn-lg btn-block btn-danger"
                                    onclick="confirmDelete('{{ $data->id }}')">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Anda tidak bisa mengembalikan aksi ini",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            }
        </script>
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
