<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .page {
            /* max-width: 80em; */
            /* margin: 0 auto;' */
            /* position: absolute; */
            /* top: 170px; */
            position: relative;
            top: 5;
        }

        table th,
        table td {
            text-align: left;
        }

        table.layout {
            width: 100%;
            border-collapse: collapse;
        }

        table.display {
            margin: 1em 0;
        }

        table.display th,
        table.display td {
            border: 1px solid #B3BFAA;
            padding: .5em 1em;
        }

        table.display th {
            background: #D5E0CC;
        }

        table.display td {
            background: #fff;
        }

        table.responsive-table {
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }

        .garis {
            margin-top: 20px;
            height: 3px;
            border-top: 3px solid black;
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <table style="width:100%">
        <tr>
            <td style="text-align: right; width: 100px;">
                @php
                    //encode logo ke base64
                    // $image = public_path('/img/').\Setting::getSetting()->logo;
                    $image = 'https://www.solonohio.org/ImageRepository/Document?documentID=11108';

                    // Read image path, convert to base64 encoding
                    $imageData = base64_encode(file_get_contents($image));
                @endphp
                <img width="100px" height="100px"
                    src="data:image/png;base64, {{ base64_encode(file_get_contents('https://www.solonohio.org/ImageRepository/Document?documentID=11108')) }}"
                    alt="">
            </td>
            <td style="text-align: center; width: 200px;">

                <div style="font-size: 24px">PT. CONTOH SAJA</div>
                <div style="font-size: 24px"></div>
                <div style="font-size: 16px">Jl. Tani Bersaudara No. 9 Johor Medan</div>
                <div style="font-size: 16px">Telp : (061) 7755 - 440 - Hp : 0819 1234 1231</div>
                <div style="font-size: 16px">Email : legalisat@gmail.com</div>
            </td>
            <td style="text-align: right; width: 50px;">

            </td>
        </tr>
    </table>
    <div class="garis"></div>
    <div style="text-align: center">
        <p style="font-size: 18px"><strong><u>Laporan Pendapatan</u></strong></p>
        <div style="font-size: 14px">Periode :
            {{ \Carbon\Carbon::parse(request()->from_date)->format('d M Y') }}
            s/d
            {{ \Carbon\Carbon::parse(request()->to_date)->format('d M Y') }}
        </div>
    </div>
    <div class="page">

        <table class="layout display responsive-table" style="font-size: 12px">
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
    </div>
</body>

</html>
