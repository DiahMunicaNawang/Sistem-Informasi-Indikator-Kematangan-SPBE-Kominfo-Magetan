<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #0056b3;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tbody tr:nth-child(odd) {
            background-color: #fdfdfd;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
        }

        .no-image {
            font-style: italic;
            color: #999;
            text-align: center;
        }

        .rating {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            color: #ff9500;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <h1>Daftar Artikel</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Ringkasan</th>
                <th>Gambar</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $index => $article)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->article_summary }}</td>
                    <td>
                        @if ($article->image)
                            @php
                                $imageSrc = str_starts_with($article->image, 'http')
                                    ? $article->image
                                    : public_path('storage/' . $article->image);
                            @endphp

                            @if (str_starts_with($article->image, 'http'))
                                <img src="{{ $imageSrc }}" alt="Gambar Artikel">
                            @else
                                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($imageSrc)) }}" alt="Gambar Artikel">
                            @endif
                        @else
                            <div class="no-image">Tidak ada gambar</div>
                        @endif
                    </td>
                    <td class="rating">{{ number_format($article->average_rating, 1) }}/5</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh sistem pada {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}.
    </div>
</body>

</html>
