<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Absen</title>
    <style>
         body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .qr-container {
            display: flex;
            justify-content: space-around;
        }
        .qr-item {
            text-align: center;
        }
        .qr-code {
            margin-bottom: 10px;
        }
        .qr-code img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    @php
use Carbon\Carbon;
@endphp
    <div class="container">
        <div class="header">
            <h1>QR Absen</h1>
            <p>Tanggal: {{ Carbon::parse($qrAbsen->date)->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
        </div>
        <div class="qr-container">
            <div class="qr-item">
                <h2>Check-in</h2>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeCheckin }}" alt="Check-in QR Code">
                </div>
                <p>Kode: {{ $qrAbsen->qr_checkin }}</p>
            </div>
            <div class="qr-item">
                <h2>Check-out</h2>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCodeCheckout }}" alt="Check-out QR Code">
                </div>
                <p>Kode: {{ $qrAbsen->qr_checkout }}</p>
            </div>
        </div>
    </div>
</body>
</html>
