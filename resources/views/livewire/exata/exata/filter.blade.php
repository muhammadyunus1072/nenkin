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
                <label class="form-label">Estimasi Gaji</label>
                <input type="text" class="form-control" wire:model.live="estimasi_gaji" placeholder="gaji" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Domisili.'.read')
            <div style="flex:0 0 10%;">
                <label class="form-label">Domisili</label>
                <input type="text" class="form-control" wire:model.live="domisili" placeholder="domisili" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Penempatankerja.'.read')
            <div style="flex:0 0 12%;">
                <label class="form-label">Preferensi Lokasi</label>
                <input type="text" class="form-control" wire:model.live="penempatan_kerja" placeholder="Preferensi Lokasi" />
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
        <div class="col-auto row d-flex align-items-end">
            <button class="btn btn-warning btn-sm mb-2" wire:click="resetFilter">
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
                                    <select class="form-select" wire:model="edit_bulk.pipeline">
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
                                    <select class="form-select" wire:model="edit_detail.pipeline">
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
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            @foreach($previewRows[0]['data'] as $name => $value)
                                            
                                                <th>{{$name}}</th>
                                            @endForeach
                                                <th>Pesan Error System</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($previewRows as $i => $row)
                                            <tr class="{{ count($row['error']) ? 'table-danger' : '' }}">
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
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeImportModal">Tutup</button>
                        @if (!$errorRows && $previewRows)
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                wire:target='input_file'>Simpan</button>
                        @endif
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
    </script>
@endpush