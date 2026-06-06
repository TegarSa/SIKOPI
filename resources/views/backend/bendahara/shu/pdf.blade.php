<!DOCTYPE html>
<html>
<head>
    <title>Laporan SHU</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 0; }
        .subtitle { text-align: center; margin-top: 0; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>LAPORAN SISA HASIL USAHA (SHU)</h2>

    <p class="subtitle">
        Periode:
        {{ \Carbon\Carbon::parse($shu->periode_awal)->format('d M Y') }}
        -
        {{ \Carbon\Carbon::parse($shu->periode_akhir)->format('d M Y') }}
    </p>

    <hr>

    <p>
        <b>Total Laba:</b> Rp {{ number_format($shu->total_laba,0,',','.') }} <br>
        <b>Persentase SHU:</b> {{ $shu->persentase_shu }}% <br>
        <b>Total Dibagikan:</b> Rp {{ number_format($shu->total_dibagikan,0,',','.') }}
    </p>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>SHU Diterima</th>
            </tr>
        </thead>

        <tbody>

            @foreach($shu->details as $detail)

                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $detail->anggota->nama ?? '-' }}</td>
                    <td>
                        Rp {{ number_format($detail->jumlah_shu,0,',','.') }}
                    </td>
                </tr>

            @endforeach

        </tbody>

    </table>

    <br><br>

    <p class="text-center">
        Dicetak pada: {{ now()->format('d M Y') }}
    </p>

</body>
</html>