<!DOCTYPE html>
<html>
<head>
    <title>Reminder Pembayaran</title>
</head>
<body>
    <h1>Halo, {{ $billing->customer->nama }}</h1>
    <p>Pembayaran untuk paket {{ $billing->paket->nama }} dengan harga {{ $billing->paket->harga }} akan jatuh tempo pada tanggal {{ $billing->jatuh_tempo }}.</p>
    <p>Harap segera melakukan pembayaran untuk menghindari gangguan layanan.</p>
    <p>Terima kasih telah menggunakan layanan kami.</p>
</body>
</html>