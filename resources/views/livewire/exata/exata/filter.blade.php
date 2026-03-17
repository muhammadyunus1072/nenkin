<div>
    {{-- Export Data --}}
    <div class="row mt-4 d-flex gap-4">
        @can(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA, PermissionHelper::TYPE_CREATE))
            <div class="col-md-auto mb-2">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fa fa-download"></i>
                    Import
                </button>
            </div>
        @endCan
        <div class="col-auto">
            <button
                class="btn btn-success btn-sm"
                x-data
                @click="$dispatch('export', { type: '{{ App\Helpers\ExportHelper::TYPE_EXCEL }}' })">
                <i class="fa fa-file-excel"></i>
                Download
            </button>
        </div>

        @can(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA, PermissionHelper::TYPE_DELETE))
            <div class="col-auto">
                <button class="btn btn-danger btn-sm" wire:click="showDeleteDialog">
                    <i class="fa fa-trash"></i>
                        Delete Data
                </button>
            </div>
        @endCan
        @can(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA, PermissionHelper::TYPE_UPDATE))
            <div class="col-auto">
                <button class="btn btn-warning btn-sm" data-bs-toggle='modal' data-bs-target='#bulkModal' wire:click="editBulk">
                    <i class='ki-duotone ki-notepad-edit'>
                        <span class='path1'></span>
                        <span class='path2'></span>
                    </i>
                    Edit Bulk
                </button>
            </div>
        @endCan
    </div>

    {{-- Filter --}}
    <div class="row mt-4 d-flex justify-content-start gap-0">
    {{-- Singgle Filter --}}
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaLengkap.'.read')
            <div style="flex:0 0 15%;">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" wire:model.live="nama_lengkap" placeholder="nama_lengkap" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_FilterNoWa.'.read')
            <div style="flex:0 0 10%;">
                <label class="form-label">No Whatsapp</label>
                <input type="text" class="form-control" wire:model.live="no_whatsapp" placeholder="no_whatsapp" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_EstimasiGaji.'.read')
            <div style="flex:0 0 10%;">
                <label class="form-label">Gaji Dari</label>
                <input type="text" class="form-control" wire:model.live="estimasi_gaji" placeholder="Gaji Dari" />
            </div>
            <div style="flex:0 0 10%;">
                <label class="form-label">Gaji Sampai</label>
                <input type="text" class="form-control" wire:model.live="estimasi_gaji_top" placeholder="Gaji Sampai" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Domisili.'.read')
            <div style="flex:0 0 10%;">
                <div class="w-100" wire:ignore>
                    <label>Domisili</label>
                    <select id="select2-domisili" class="form-select" multiple>
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Penempatankerja.'.read')
            <div style="flex:0 0 10%;">
                <div class="w-100" wire:ignore>
                    <label>Preferensi Lokasi</label>
                    <select id="select2-preferensi-lokasi" class="form-select" multiple>
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaLPK.'.read')
            <div style="flex:0 0 10%;">
                <label class="form-label">Nama LPK</label>
                <input type="text" class="form-control" wire:model.live="nama_lpk" placeholder="nama_lpk" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaInstagram.'.read')
            <div style="flex:0 0 10%;">
                <label class="form-label">Instagram</label>
                <input type="text" class="form-control" wire:model.live="instagram" placeholder="instagram" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaTikTok.'.read')
            <div style="flex:0 0 10%;">
                <label class="form-label">Tiktok</label>
                <input type="text" class="form-control" wire:model.live="tiktok" placeholder="tiktok" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Keterangan.'.read')
            <div style="flex:0 0 13%;">
                <label class="form-label">Keterangan</label>
                <input type="text" class="form-control" wire:model.live="keterangan" placeholder="keterangan" />
            </div>
        @endCan
    </div>
    <div class="row mt-4 d-flex gap-4">
    {{-- Dropdown Filter --}}
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_FilterTanggal.'.read')
            <div class="col-auto mb-2"  style="scale: 1;">
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
            <div class="col-auto mb-2"  style="scale: 1;">
                <label class="form-label">Tanggal Dari</label>
                <input type="date" class="form-control" {{$date_type ? '' : 'disabled'}} wire:model.live="start_date"  />
            </div>
            <div class="col-auto mb-2"  style="scale: 1;">
                <label class="form-label">Tanggal Sampai</label>
                <input type="date" class="form-control" {{$date_type ? '' : 'disabled'}} wire:model.live="end_date"  />
            </div>
        @endCan
        
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Pipeline.'.read')
            <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>Pipeline</label>
                    <select id="select2-pipeline" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_PIPELINE_CHOICE as $key => $name)
                            
                            @can('exata_'.$key.'.read')
                                <option value="{{$name}}">{{$name}}</option>
                            @endCan
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Gender.'.read')
            <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>Gender</label>
                    <select id="select2-gender" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_GENDER_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Pendidikan.'.read')
             <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>Pendidikan</label>
                    <select id="select2-pendidikan" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_PENDIDIKAN_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_LevelBahasa.'.read')
             <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>Level Bahasa</label>
                    <select id="select2-level-bahasa" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_LEVEL_BAHASA_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Job.'.read')
             <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>Job</label>
                    <select id="select2-job" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_JOB_CHOICE as $key => $name)    
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_BidangKerjadiJepang.'.read')
            <div class="col-auto mb-2">
                <label class="form-label">Bidang Kerja (Japan)</label>
                <input type="text" class="form-control" wire:model.live="bidang_kerja_japan" placeholder="bidang_kerja_japan" />
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_BidangKerjaPilihan.'.read')
             <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>Pilihan Kerja (Indonesia)</label>
                    <select id="select2-pilihan-kerja-indonesia" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_JOB_PILIHAN_INDO_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_PICSales.'.read')
             <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>PIC / Sales</label>
                    <select id="select2-pic-sales" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_SALES_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_JenisVisa.'.read')
             <div class="col-auto mb-4">
                <div class="w-100" wire:ignore>
                    <label>Jenis Visa</label>
                    <select id="select2-jenis-visa" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_JENIS_VISA_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        <div class="col-auto row d-flex align-items-end">
            <button class="btn btn-warning btn-sm mb-4" wire:click="resetFilter">
                Reset Filter
            </button>
        </div>
    </div>
    {{-- Edit Bulk Modal --}}
    <div class="modal fade" id="bulkModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-lg" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkModalLabel">Edit Bulk Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeImport">
                    <div class="modal-body import_modal">
                        
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Pipeline</label>
                                    <select class="form-select" wire:model="edit_bulk.Pipeline">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_PIPELINE_CHOICE as $key => $name)
                                            
                                            @can('exata_'.$key.'.read')
                                                <option value="{{$name}}">{{$name}}</option>
                                            @endCan
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Available</label>
                                    <select class="form-select" wire:model="edit_bulk.Available">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_AVAILABLE_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-select" wire:model="edit_bulk.Kategori">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_KATEGORI_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Keterangan</label>
                                    <textarea placeholder="Keterangan" class="form-control" cols="30" rows="4" wire:model="edit_bulk.Keterangan"></textarea>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target='saveBulk' wire:click="saveBulk">Simpan</button>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Manual Modal --}}
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-lg" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeImport">
                    <div class="modal-body import_modal">
                        @if ($edit_detail)
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Nama Lengkap</label>
                                    <p class="form-control">{{$edit_detail[App\Models\Exata\Exata::PERMISSION_NamaLengkap]}}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Provinsi</label>
                                    <p class="form-control">{{$edit_detail[App\Models\Exata\Exata::PERMISSION_Provinsi]}}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Kota</label>
                                    <p class="form-control">{{$edit_detail[App\Models\Exata\Exata::PERMISSION_Kota]}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Pipeline</label>
                                    <select class="form-select" wire:model="edit_detail.Pipeline">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_PIPELINE_CHOICE as $key => $name)
                                            
                                            @can('exata_'.$key.'.read')
                                                <option value="{{$name}}">{{$name}}</option>
                                            @endCan
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Available</label>
                                    <select class="form-select" wire:model="edit_detail.Available">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_AVAILABLE_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-select" wire:model="edit_detail.Kategori">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_KATEGORI_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Keterangan</label>
                                    <textarea placeholder="Keterangan" class="form-control" cols="30" rows="4" wire:model="edit_detail.Keterangan"></textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target='save_edit' wire:click="save_edit">Simpan</button>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-fullscreen" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeImportModal"></button>
                </div>
                <form wire:submit.prevent="storeImport">
                    <div class="modal-body import_modal">
                        <div class="form-group mb-2">
                            <label>File Import Excel</label>
                            <input type="file" wire:model="inputFile" class="form-control" id="inputFile">
                            @error('input_file')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            @if($previewRows)
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="imported" data-bs-toggle="tab" data-bs-target="#imported-pane" type="button" role="tab" aria-controls="imported-pane" aria-selected="true">Imported</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="invalid" data-bs-toggle="tab" data-bs-target="#invalid-pane" type="button" role="tab" aria-controls="invalid-pane" aria-selected="false">Invalid ({{count($errorRows)}})</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="imported-pane" role="tabpanel" aria-labelledby="imported" tabindex="0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @foreach(\App\Models\Exata\Exata::EXATA_IMPORT_CHOICE as $name => $value)
                                                        <th>{{$value['name']}}</th>
                                                    @endForeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($previewRows as $i => $row)
                                                    @if (!$row['error'])
                                                        <tr>
                                                        {{-- <tr class="{{ count($row['error']) ? '--kt-gray-100' : '' }}"> --}}
                                                                <td>{{ $loop->iteration }}</td>
                                                                @foreach ($row['data'] as $item)
                                                                    <td>{{ $item }}</td>
                                                                @endforeach
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="invalid-pane" role="tabpanel" aria-labelledby="invalid" tabindex="0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @foreach(\App\Models\Exata\Exata::EXATA_IMPORT_CHOICE as $name => $value)
                                                        <th>{{$value['name']}}</th>
                                                    @endForeach
                                                        <th>Pesan Error System</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($previewRows as $i => $row)
                                                    @if ($row['error'])
                                                        <tr>
                                                        {{-- <tr class="{{ count($row['error']) ? '--kt-gray-100' : '' }}"> --}}
                                                                <td>{{ $loop->iteration }}</td>
                                                                @foreach ($row['data'] as $item)
                                                                    <td>{{ $item }}</td>
                                                                @endforeach
                                                            <td>
                                                                @foreach($row['error'] as $field => $msg)
                                                                    <div>{{ $msg[0] }}</div>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeImportModal">Tutup</button>
                        
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
        Livewire.on('onSuccessEditData', () => {
            $('#editModal').modal('hide');
        })
        Livewire.on('onSuccessEditBulk', () => {
            $('#bulkModal').modal('hide');
        })
        Livewire.on('reset-select2', () => {
             $('#select2-domisili')
                .val(null)
                .trigger('change');
             $('#select2-preferensi-lokasi')
                .val(null)
                .trigger('change');
             $('#select2-pipeline')
                .val(null)
                .trigger('change');
             $('#select2-gender')
                .val(null)
                .trigger('change');
             $('#select2-pendidikan')
                .val(null)
                .trigger('change');
             $('#select2-level-bahasa')
                .val(null)
                .trigger('change');
             $('#select2-job')
                .val(null)
                .trigger('change');
             $('#select2-pilihan-kerja-indonesia')
                .val(null)
                .trigger('change');
             $('#select2-pic-sales')
                .val(null)
                .trigger('change');
             $('#select2-jenis-visa')
                .val(null)
                .trigger('change');
        })

        // Domisili
        $('#select2-domisili').select2({
                placeholder: "-- Pilih --",
                ajax: {
                    url: "{{ route('exata.get.regency') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    "id": item.text,
                                    "text": item.text,
                                }
                            })
                        };
                    },
                },
                cache: true
            });

            $('#select2-domisili').on('select2:select', function(e) {
                @this.call('selectDomisili', e.params.data)
            });

            $('#select2-domisili').on('select2:unselect', function(e) {
                @this.call('unSelectDomisili', e.params.data)
            });

        // Preferensi Lokasi
        $('#select2-preferensi-lokasi').select2({
                placeholder: "-- Pilih --",
                ajax: {
                    url: "{{ route('exata.get.regency') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    "id": item.text,
                                    "text": item.text,
                                }
                            })
                        };
                    },
                },
                cache: true
            });

            $('#select2-preferensi-lokasi').on('select2:select', function(e) {
                @this.call('selectPreferensiLokasi', e.params.data)
            });

            $('#select2-preferensi-lokasi').on('select2:unselect', function(e) {
                @this.call('unSelectPreferensiLokasi', e.params.data)
            });

        // Pipeline
        $('#select2-pipeline').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-pipeline').on('select2:select', function(e) {
            @this.call('selectPipeline', e.params.data)
        });

        $('#select2-pipeline').on('select2:unselect', function(e) {
            @this.call('unSelectPipeline', e.params.data)
        });

        // Gender
        $('#select2-gender').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-gender').on('select2:select', function(e) {
            @this.call('selectGender', e.params.data)
        });

        $('#select2-gender').on('select2:unselect', function(e) {
            @this.call('unSelectGender', e.params.data)
        });

        // Pendidikan
        $('#select2-pendidikan').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-pendidikan').on('select2:select', function(e) {
            @this.call('selectPendidikan', e.params.data)
        });

        $('#select2-pendidikan').on('select2:unselect', function(e) {
            @this.call('unSelectPendidikan', e.params.data)
        });

        // Level Bahasa
        $('#select2-level-bahasa').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-level-bahasa').on('select2:select', function(e) {
            @this.call('selectLevelBahasa', e.params.data)
        });

        $('#select2-level-bahasa').on('select2:unselect', function(e) {
            @this.call('unSelectLevelBahasa', e.params.data)
        });

        // Job
        $('#select2-job').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-job').on('select2:select', function(e) {
            @this.call('selectJob', e.params.data)
        });

        $('#select2-job').on('select2:unselect', function(e) {
            @this.call('unSelectJob', e.params.data)
        });

        // Pilihan Kerja Indonesia
        $('#select2-pilihan-kerja-indonesia').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-pilihan-kerja-indonesia').on('select2:select', function(e) {
            @this.call('selectPilihanKerjaIndonesia', e.params.data)
        });

        $('#select2-pilihan-kerja-indonesia').on('select2:unselect', function(e) {
            @this.call('unSelectPilihanKerjaIndonesia', e.params.data)
        });

        // PIC / Sales
        $('#select2-pic-sales').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-pic-sales').on('select2:select', function(e) {
            @this.call('selectPicSales', e.params.data)
        });

        $('#select2-pic-sales').on('select2:unselect', function(e) {
            @this.call('unSelectPicSales', e.params.data)
        });

        // Jenis Visa
        $('#select2-jenis-visa').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-jenis-visa').on('select2:select', function(e) {
            @this.call('selectJenisVisa', e.params.data)
        });

        $('#select2-jenis-visa').on('select2:unselect', function(e) {
            @this.call('unSelectJenisVisa', e.params.data)
        });
    </script>
@endpush