<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Validation Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #4CAF50;
            text-align: center;
        }
        p {
            color: #333;
            line-height: 1.6;
        }
        .status {
            font-weight: bold;
            color: #fff;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .status.published {
            background-color: #4CAF50; /* Green for published */
        }
        .status.rejected {
            background-color: #F44336; /* Red for rejected */
        }
        .status.proses {
            background-color: #FF9800; /* Orange for process */
        }
        blockquote {
            border-left: 4px solid #ccc;
            padding-left: 16px;
            margin-left: 0;
            color: #555;
            font-style: italic;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Artikel Anda Telah Divalidasi</h1>

        <p>Halo,</p>
        <p>Artikel Anda dengan judul <strong>{{ $title }}</strong> telah berhasil divalidasi. Berikut adalah informasi terbaru mengenai artikel Anda:</p>

        <div class="status {{ strtolower($status) }}">
            Status Validasi: {{ ucfirst($status) }}
        </div>

        @if($comments)
            <p>Catatan dari validator:</p>
            <blockquote>{{ $comments }}</blockquote>
        @else
            <p>Tidak ada catatan tambahan dari validator.</p>
        @endif

        <p>Terima kasih atas kontribusi Anda dalam membuat artikel ini.</p>

        <div class="footer">
            <p>Jika Anda memiliki pertanyaan, Anda dapat menghubungi kami melalui <a href="mailto:support@example.com">support@example.com</a>.</p>
        </div>
    </div>
</body>
</html>
