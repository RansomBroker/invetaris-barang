<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        h4, p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <h4>PT. CONTOH SAJA</h4>
    <p>Jl. Lembah Bening No 111</p>
    <p>Pluta City - Jupiter</p>
    <p>Phone Number : 01212234234</p>

    <br>
    <p><strong>Laporan Barang Masuk</strong></p>
    <p>Periode :
        {{ \Carbon\Carbon::parse(request()->from_date)->format('d M Y') }}
        s/d
        {{ \Carbon\Carbon::parse(request()->to_date)->format('d M Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pemasukan</th>
                <th>No Transaksi (Barang Masuk)</th>
                <th>Pengeluaran (Total Harga)</th>
                <th>Pendapatan</th>
                <th>Total Pendapatan Bersih</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendapatanData as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}
                    </td>
                    <td>
                        @php
                            $totalHarga = $row->barangMasuks->sum('total_harga');
                        @endphp
                        Rp. {{ number_format($totalHarga, 0, ',', '.') }}
                    </td>
                    <td>Rp. {{ number_format($row->jumlah, 0, ',', '.') }}</td>
                    <td>
                        @php
                            $pendapatanBersih = $row->jumlah - $row->barangMasuks->sum('total_harga');
                        @endphp
                        Rp. {{ number_format($pendapatanBersih, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No Data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
