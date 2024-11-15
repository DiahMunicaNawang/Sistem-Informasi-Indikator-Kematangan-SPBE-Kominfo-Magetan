@extends('layouts.main.index')

@section('back-button')
<a href="{{ route('article.index') }}">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection

@section('page-name', 'Article Validate')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <style>
        /* CSS styling for both dark and light themes */
        body {
            background-color: var(--background-color);
        }

        .header-title {
            margin: 20px 0;
            font-size: 2.5rem;
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

        .btn-custom {
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

        .btn-custom:hover {
            background-color: var(--button-bg-hover-color);
        }

        .search-box {
            display: flex;
            align-items: center;
            margin: 0 auto;
            width: 50%;
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
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: var(--card-bg-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--text-color);
            margin: 10px 0;
        }

        .card-text {
            font-size: 0.9rem;
            color: var(--subtext-color);
            margin-bottom: 10px;
        }

        .star-rating {
            color: #ffc107;
        }

        /* Dark and Light Theme Variables */
        :root {
            --background-color: #f8f9fa;
            --text-color: #343a40;
            --subtext-color: #6c757d;
            --button-bg-color: #007bff;
            --button-text-color: #ffffff;
            --button-bg-hover-color: #0056b3;
            --border-color: #ced4da;
            --input-bg-color: #ffffff;
            --card-bg-color: #ffffff;
        }

        /* Dark Mode */
        [data-theme="dark"] {
            --background-color: #121212;
            --text-color: #e0e0e0;
            --subtext-color: #b0b0b0;
            --button-bg-color: #1f73b7;
            --button-text-color: #ffffff;
            --button-bg-hover-color: #145a86;
            --border-color: #444444;
            --input-bg-color: #333333;
            --card-bg-color: #1e1e1e;
        }
    </style>

    <h1 class="header-title">Validasi Artikel</h1>

    <div class="button-container mx-4">
        <div class="button-container mx-4">
            <form action="{{ route('article.validateIndex') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari artikel..."
                        value="{{ request()->get('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>


    <div class="grid-container">
        @foreach ($artikel as $data)
            <div class="card">
                @php
                    if (str_starts_with($data->image, 'http')) {
                        $imageSrc = $data->image;
                    } else {
                        $imageSrc = asset('/' . $data->image);
                    }
                @endphp

                <a href="{{ route('article.validate', $data->id) }}"><img src="{{ $imageSrc }}" class="img-fluid rounded" alt="Article Thumbnail"></a>

                <h5 class="card-title">{{ $data->title }}</h5>
                <p class="card-text">{{ $data->article_summary }}</p>

                <!-- Tampilkan rating sebagai bintang -->
                <div class="card-text">
                    <span>Rating: </span>
                    @php
                        $averageRating = $data->average_rating;
                        $fullStars = floor($averageRating); // Bintang penuh
                        $halfStar = $averageRating - $fullStars >= 0.5; // Setengah bintang
                    @endphp

                    <!--  bintang penuh -->
                    @for ($i = 0; $i < $fullStars; $i++)
                        <i class="fas fa-star text-warning"></i>
                    @endfor

                    <!-- setengah bintang jika ada -->
                    @if ($halfStar)
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @endif

                    <!-- bintang kosong jika kurang dari 5 -->
                    @for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                        <i class="far fa-star text-warning"></i>
                    @endfor

                    <!--  nilai rata-rata -->
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

            // Hide results when clicking outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.search-box').length) {
                    $('#search-results').hide();
                }
            });

            // Handle click on search result
            $(document).on('click', '.search-result-item', function() {
                $('#search').val($(this).text());
                $('#search-results').hide();
            });
        });
    </script>
@endsection
