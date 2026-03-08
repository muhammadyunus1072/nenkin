<div>
    {{-- Export Data --}}
    <div class="row mt-4 d-flex gap-4">
        <div class="col-md-auto mb-2">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="fa fa-download"></i>
                Import Data
            </button>
        </div>
        <div class="col-auto">
            <button
                class="btn btn-success btn-sm"
                x-data
                @click="$dispatch('export', { type: '{{ App\Helpers\ExportHelper::TYPE_EXCEL }}' })">
                <i class="fa fa-file-excel"></i>
                Export Excel
            </button>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row mt-4 d-flex gap-4">
     <div class="col-auto mb-2">
            <label class="form-label">no</label>
            <input type="date" class="form-control" wire:model="start_date" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">tgl_input</label>
            <input type="date" class="form-control" wire:model="start_date" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">habis_kontrak</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">kembali_ke_jepang</label>
            <input type="date" class="form-control" wire:model="start_date" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">nama_lengkap</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">tgl_pulang</label>
            <input type="date" class="form-control" wire:model="start_date" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">pic</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">nama_lpk</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">lama_di_jepang</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">referensi_kerja</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">jenis_kelamin</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">pendidikan</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">tahun_terbit</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">level_bahasa</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">sensei</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">dokumen</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">penerjemah</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">bidang_kerja_di_jepang</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">bidang_kerja_pilihan</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">senmongkyu</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">bidang_senmongkyu</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">jenis_visa</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">nama_tiktok</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">nama_instagram</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">no_telp_indonesia</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">no_telp_jepang</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">email</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">provinsi</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">kota</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
     <div class="col-auto mb-2">
            <label class="form-label">available</label>
        <input type="text" class="form-control" wire:model.lazy="kelurahan" />
        </div>
    </div>

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="storeImport">
                    <div class="modal-body import_modal">
                        <div class="form-group mb-2">
                            <label>File</label>
                            <input type="file" wire:model.lazy="inputFile" class="form-control" id="inputFile">
                            @error('input_file')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target='input_file'>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        Livewire.on('onSuccessImportData', () => {
            $('#importModal').modal('hide');
            $('#inputFile').val(null);
        })
    </script>
@endpush