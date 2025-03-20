<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
</head>

<body>

    <h4>PT. CONTOH SAJA</h4>
    <p>Jl. Lembah Bening No 111</p>
    <p>Pluta City - Jupiter</p>
    <p>Phone Number : 01212234234</p>

    <p></p>
    <p>Laporan Barang Masuk</p>
    <p>Periode :
        {{ \Carbon\Carbon::parse(request()->from_date)->format('d M Y') }}
        s/d
        {{ \Carbon\Carbon::parse(request()->to_date)->format('d M Y') }}
    </p>
    <table>
        <thead>
            <tr>
                <th style="text-align:center; border: 1px solid black">No</th>
                <th style="text-align:center; border: 1px solid black">Tanggal Pemasukan</th>
                <th style="text-align:center; border: 1px solid black">No Transaksi (Barang Masuk)</th>
                <th style="text-align:center; border: 1px solid black">Pengeluaran (Barang Masuk)</th>
                <th style="text-align:center; border: 1px solid black">Pendapatan</th>
                <th style="text-align:center; border: 1px solid black">Total</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($pendapatanData as $row)
                <tr>
                    <td style="text-align:center; border: 1px solid black">{{ $loop->iteration }}</td>
                    <td style="text-align:center; border: 1px solid black">{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                    <td style="text-align:center; border: 1px solid black">
                        {{ \Carbon\Carbon::parse($row->barangMasuk->tgl_masuk)->format('d M Y') }}
                    </td>
                    <td style="text-align:left; border: 1px solid black">Rp. {{ number_format($row->barangMasuk->total_harga, 0, ',', '.') }}</td>
                    <td style="text-align:right; border: 1px solid black">Rp. {{ number_format($row->jumlah, 0, ',', '.') }}</td>
                    <td style="text-align:center; border: 1px solid black">@php
                                                $pendapatanBersih = $row->jumlah - $row->barangMasuk->total_harga;
                                            @endphp
                                            Rp. {{ number_format($pendapatanBersih, 0, ',', '.') }}</td>

                </tr>
            @empty
                <tr>
                    <td>No Data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
