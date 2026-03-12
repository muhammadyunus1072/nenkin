<div>
    {{-- Export Data --}}
    <div class="row mt-4 d-flex gap-4">
        <div class="col-md-auto mb-2">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="fa fa-download"></i>
                Import
            </button>
        </div>
        <div class="col-auto">
            <button
                class="btn btn-success btn-sm"
                x-data
                @click="$dispatch('export', { type: '{{ App\Helpers\ExportHelper::TYPE_EXCEL }}' })">
                <i class="fa fa-file-excel"></i>
                Download
            </button>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row mt-4 d-flex gap-4">
    {{-- Singgle Filter --}}
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaLengkap.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" wire:model.live="nama_lengkap" placeholder="nama_lengkap" />
            </div>
        @endCan
        @canany([
            'exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NoTelpJepang.'.read',
            'exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NoTelpIndonesia.'.read'
        ])
            <div class="col-auto mb-2">
                <label class="form-label">No Whatsapp</label>
                <input type="text" class="form-control" wire:model.live="no_whatsapp" placeholder="no_whatsapp" />
            </div>
        @endCanany
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_EstimasiGaji.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Estimasi Gaji</label>
                <input type="text" class="form-control" wire:model.live="estimasi_gaji" placeholder="estimasi_gaji" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Domisili.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Dimisili</label>
                <input type="text" class="form-control" wire:model.live="domisili" placeholder="domisili" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Penempatankerja.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Penempatan Kerja</label>
                <input type="text" class="form-control" wire:model.live="penempatan_kerja" placeholder="penempatan_kerja" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaLPK.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Nama LPK</label>
                <input type="text" class="form-control" wire:model.live="nama_lpk" placeholder="nama_lpk" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaInstagram.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Instagram</label>
                <input type="text" class="form-control" wire:model.live="instagram" placeholder="instagram" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaTikTok.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Tiktok</label>
                <input type="text" class="form-control" wire:model.live="tiktok" placeholder="tiktok" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Keterangan.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Keterangan</label>
                <input type="text" class="form-control" wire:model.live="keterangan" placeholder="keterangan" />
            </div>
        @endCan
    </div>
    <div class="row mt-4 d-flex gap-4">
    {{-- Dropdown Filter --}}
        @canany([
            'exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_TglInput.'.read',
            'exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_TanggalPulang.'.read',
            'exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_tglSiapkerja.'.read'
        ])
            <div class="col-auto mb-2">
                <label class="form-label">Filter Tanggal</label>
                <select class="form-select" wire:model.live="date_type">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_TGL_CHOICE as $key => $name)
                        @can('exata_'.$key.'.read')
                            <option value="{{$name}}">{{$name}}</option>
                        @endCan
                    @endforeach
                </select>
            </div>
        @endcanany
        
        <div class="col-auto mb-2">
            <label class="form-label">Tanggal Dari</label>
            <input type="date" class="form-control" {{$date_type ? '' : 'disabled'}} wire:model.live="start_date"  />
        </div>
        <div class="col-auto mb-2">
            <label class="form-label">Tanggal Sampai</label>
            <input type="date" class="form-control" {{$date_type ? '' : 'disabled'}} wire:model.live="end_date"  />
        </div>
        

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_pipeline.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Pipeline</label>
                <select class="form-select" wire:model.live="pipeline">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_PIPELINE_CHOICE as $key => $name)
                        
                        @can('exata_'.$key.'.read')
                            <option value="{{$name}}">{{$name}}</option>
                        @endCan
                    @endforeach
                </select>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Gender.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Gender</label>
                <select class="form-select" wire:model.live="gender">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_GENDER_CHOICE as $key => $name)    
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Pendidikan.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Pendidikan</label>
                <select class="form-select" wire:model.live="pendidikan">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_PENDIDIKAN_CHOICE as $key => $name)    
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_LevelBahasa.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Level Bahasa</label>
                <select class="form-select" wire:model.live="level_bahasa">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_LEVEL_BAHASA_CHOICE as $key => $name)    
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Job.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Job</label>
                <select class="form-select" wire:model.live="job">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_JOB_CHOICE as $key => $name)    
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_BidangKerjadiJepang.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Bidang Kerja (Japan)</label>
                <input type="text" class="form-control" wire:model.live="bidang_kerja_japan" placeholder="bidang_kerja_japan" />
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_BidangKerjaPilihan.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Pilihan Kerja (Indonesia)</label>
                <select class="form-select" wire:model.live="pilihan_kerja_indonesia">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_JOB_PILIHAN_INDO_CHOICE as $key => $name)    
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_PICSales.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">PIC / Sales</label>
                <select class="form-select" wire:model.live="pic_sales">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_SALES_CHOICE as $key => $name)    
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_JenisVisa.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Jenis Visa</label>
                <select class="form-select" wire:model.live="jenis_visa">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_JENIS_VISA_CHOICE as $key => $name)    
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
        @endCan
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
                            <input type="file" wire:model="inputFile" class="form-control" id="inputFile">
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