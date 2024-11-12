@extends('layouts.main.index')

@section('page-name', 'Article')

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

    <h1 class="header-title">Jelajahi Artikel</h1>

    <div class="button-container mx-4">
        <a href="{{ route('article.create') }}" class="btn-custom"><i class="fas fa-plus"></i> Buat Artikel</a>
        <div class="search-box">
            <input type="text" class="search-input" placeholder="Search articles...">
        </div>
        <a href="#" class="btn-custom"><i class="fas fa-print"></i> Cetak Artikel</a>
    </div>

    <div class="grid-container">
        <!-- Card 1 -->
        <div class="card">
            <img src="path/to/image1.jpg" alt="Article Image">
            <h5 class="card-title">Lorem Ipsum</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            <div class="star-rating">★★★★★</div>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <img src="path/to/image2.jpg" alt="Article Image">
            <h5 class="card-title">Lorem Ipsum</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            <div class="star-rating">★★★★★</div>
        </div>

        <!-- Tambahkan lebih banyak kartu sesuai kebutuhan -->
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
                        data: { term: searchTerm },
                        success: function(data) {
                            $('#search-results').empty();
                            if (data.length > 0) {
                                $.each(data, function(index, item) {
                                    $('#search-results').append('<div class="search-result-item">' + item + '</div>');
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
