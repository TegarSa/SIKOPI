<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Koperasi SIKOPI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2, h3 {
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .divider {
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        .summary-box {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .box {
            width: 23%;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .title {
            font-weight: bold;
            font-size: 14px;
        }

        .value {
            margin-top: 5px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>LAPORAN KOPERASI SIKOPI</h2>
    <p>Ringkasan Keuangan & Aktivitas Sistem</p>
    <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
</div>

<div class="divider"></div>

<div class="section">
    <h3>Ringkasan Umum</h3>

    <div class="summary-box">
        <div class="box">
            <div class="title">Anggota</div>
            <div class="value">{{ $totalAnggota }}</div>
        </div>

        <div class="box">
            <div class="title">Simpanan</div>
            <div class="value">Rp {{ number_format($totalSimpanan,0,',','.') }}</div>
        </div>

        <div class="box">
            <div class="title">Pinjaman Aktif</div>
            <div class="value">{{ $totalPinjamanAktif }}</div>
        </div>

        <div class="box">
            <div class="title">Saldo Kas</div>
            <div class="value">Rp {{ number_format($saldoKas,0,',','.') }}</div>
        </div>
    </div>
</div>

<div class="divider"></div>

<div class="section">
    <h3>Rekap Transaksi Terbaru</h3>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Anggota</th>
                <th>Kategori</th>
                <th>Jenis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksiTerbaru as $item)
                <tr>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->anggota->nama ?? '-' }}</td>
                    <td>{{ ucfirst($item->kategori) }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>Rp {{ number_format($item->jumlah,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="divider"></div>

<div class="section">
    <h3>Rekap Kategori Transaksi</h3>

    <table>
        <tr>
            <th>Simpanan</th>
            <th>Pinjaman</th>
            <th>Angsuran</th>
        </tr>
        <tr>
            <td>Rp {{ number_format($totalKategoriSimpanan,0,',','.') }}</td>
            <td>Rp {{ number_format($totalKategoriPinjaman,0,',','.') }}</td>
            <td>Rp {{ number_format($totalKategoriAngsuran,0,',','.') }}</td>
        </tr>
    </table>
</div>

</body>
</html>