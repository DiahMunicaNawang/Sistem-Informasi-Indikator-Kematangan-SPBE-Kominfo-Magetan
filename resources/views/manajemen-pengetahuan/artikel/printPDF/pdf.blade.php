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
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f8f8f8;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
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
                                if (str_starts_with($article->image, 'http')) {
                                    // URL eksternal
                                    $imageSrc = $article->image;
                                } else {
                                    // URL lokal, harus diubah menjadi path absolut untuk PDF
                                    $imageSrc = public_path('storage/' . $article->image);
                                }
                            @endphp

                            @if (str_starts_with($article->image, 'http'))
                                <img src="{{ $imageSrc }}" alt="Gambar Artikel"
                                    style="max-width: 100px; max-height: 100px; object-fit: cover;">
                            @else
                                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($imageSrc)) }}"
                                    alt="Gambar Artikel" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                            @endif
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td>{{ number_format($article->average_rating, 1) }}/5</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
