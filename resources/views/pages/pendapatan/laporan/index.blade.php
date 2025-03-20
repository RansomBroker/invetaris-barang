@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none ">
        <div class="container-xl ">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Laporan
                    </div>
                    <h2 class="page-title">
                        Pendapatan
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-secondary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <i class="ti ti-filter icon"></i>
                            Filter
                        </a>
                        <a href="{{ route('pendapatan.laporan.pdf', [
                            'from_date' => request()->query('from_date'),
                            'to_date' => request()->query('to_date'),
                        ]) }}"
                            target="_blank" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-file-export icon"></i>
                            PDF
                        </a>
                        <a href="{{ route('pendapatan.laporan.excel', [
                            'from_date' => request()->query('from_date'),
                            'to_date' => request()->query('to_date'),
                        ]) }}"
                            target="_blank" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-table-export icon"></i>
                            Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            <!-- Alert -->
            <x-alert-success />
            <x-alert-error />

            <div class="row">
                <div class="col-12">
                    @if (request()->query('from_date'))
                        <div class="mb-3">
                            Filters
                            <span class="badge bg-cyan text-cyan-fg">Dari Tgl {{ request()->query('from_date') }}</span>
                            <span class="badge bg-cyan text-cyan-fg">Sampai {{ request()->query('to_date') }}</span>
                            <a class="ms-2 text-reset text-secondary" href="{{ route('pendapatan.laporan') }}">Reset</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Total : {{ $pendapatanData->count() }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th class="w-1">No</th>
                                        <th>Tanggal Pemasukan</th>
                                        <th>No Transaksi (Barang Masuk)</th>
                                        <th>Pengeluaran (Barang Masuk)</th>
                                        <th>Pendapatan</th>
                                        <th>Total Pendapatan Bersih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendapatanData as $row)
                                        <tr>
                                            <td class="text-secondary align-text-top" data-label="No">{{ $loop->iteration }}</td>

                                            <!-- Tanggal Pemasukan -->
                                            <td data-label="Tanggal Pemasukan">
                                                {{ $row->tanggal }} <!-- Tanggal dari Pendapatan -->
                                            </td>

                                            <!-- No Transaksi -->
                                            <td data-label="Transaksi">
                                                <div class="d-flex flex-column align-items-top">
                                                    @foreach ($row->barangMasuks as $barangMasuk)
                                                        <div class="font-weight-medium">{{ $barangMasuk->tgl_masuk }}</div>
                                                        <div class="text-secondary">
                                                            <a href="{{ route('barang-masuk.show', $barangMasuk->id) }}" target="_blank">{{ $barangMasuk->no_transaksi }}</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>

                                            <!-- Pengeluaran (Total Harga dari Barang Masuk) -->
                                            <td class="align-text-top text-start text-lg-center" data-label="Pengeluaran">
                                                @php
                                                    $totalHarga = $row->barangMasuks->sum('total_harga');
                                                @endphp
                                                Rp. {{ number_format($totalHarga, 0, ',', '.') }}
                                            </td>

                                            <!-- Pendapatan -->
                                            <td class="align-text-top text-start text-lg-center" data-label="Pendapatan">
                                                Rp. {{ number_format($row->jumlah, 0, ',', '.') }}
                                            </td>

                                            <!-- Total Pendapatan Bersih -->
                                            <td class="align-text-top text-start text-lg-center" data-label="Total Pendapatan Bersih">
                                                @php
                                                    $pendapatanBersih = $row->jumlah - $totalHarga;
                                                @endphp
                                                Rp. {{ number_format($pendapatanBersih, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No data found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="get">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" name="from_date"
                                value="{{ old('from_date', request()->from_date) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="to_date"
                                value="{{ old('to_date', request()->to_date) }}">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-secondary ms-auto">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom_script')
    <script src="{{ asset('dist/libs/fslightbox/index.js') }}" defer></script>
@endpush
