<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card card-md">
            <div class="card-header d-flex justify-content-between">
                <span>Data Pendapatan</span>
                <div wire:loading>
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="tgl_transaksi" class="form-label required">Tanggal</label>
                        <input type="date" class="form-control" id="tgl_transaksi" wire:model.defer="tglTransaksi">
                        @error('tglTransaksi') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                        <textarea class="form-control" id="keterangan" wire:model.defer="keterangan"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="pendapatan" class="form-label required">Pendapatan (Rp)</label>
                        <input type="text" class="form-control" id="pendapatan" wire:model.defer="pendapatan">
                        @error('pendapatan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button class="btn btn-primary" wire:click.prevent="submit">Simpan</button>
            </div>
        </div>
    </div>
</div>
