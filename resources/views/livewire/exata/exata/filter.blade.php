<div>
    {{-- Export Data --}}
    <div class="row mt-4 d-flex gap-0">
        @can(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA, PermissionHelper::TYPE_CREATE))

            <div class="col-md-auto mb-0">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal" wire:click="setImportBy('header')">
                    <i class="fa fa-upload"></i>
                    Import By Header
                </button>
            </div>
            <div class="col-md-auto mb-0">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal" wire:click="setImportBy('row')">
                    <i class="fa fa-upload"></i>
                    Import By Row
                </button>
            </div>
        @endCan
            <div class="col-md-auto mb-0">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importPipelineModal">
                    <i class="fa fa-upload"></i>
                    Import Pipeline
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
        <div class="col-auto">
            <button
                class="btn btn-success btn-sm"
                x-data
                @click="$dispatch('export-preview', { type: '{{ App\Helpers\ExportHelper::TYPE_EXCEL }}' })">
                <i class="fa fa-file-excel"></i>
                Download Preview
            </button>
        </div>
        <div class="col-auto">
            <a href="{{asset('template_import.xlsx')}}" download="Template Import Seluruh Data"
                class="btn btn-success btn-sm">
                <i class="fa fa-file-excel"></i>
                Download Template Import Row
            </a>
        </div>
        <div class="col-auto">
            <a href="{{asset('template_pipeline.xlsx')}}" download="Template Pipeline"
                class="btn btn-success btn-sm">
                <i class="fa fa-file-excel"></i>
                Download Template Pipeline 
            </a>
        </div>
        {{-- @can(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA, PermissionHelper::TYPE_UPDATE))
            <div class="col-auto">
                <button class="btn btn-warning btn-sm" data-bs-toggle='modal' data-bs-target='#bulkModal' wire:click="editBulk">
                    <i class='ki-duotone ki-notepad-edit'>
                        <span class='path1'></span>
                        <span class='path2'></span>
                    </i>
                    Edit Bulk
                </button>
            </div>
        @endCan --}}
    </div>

    {{-- Filter --}}
    <div class="row mt-2 d-flex justify-content-start gap-0">
    {{-- Singgle Filter --}}
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaLengkap.'.read')
            <div style="margin-bottom:0; flex:0 0 15%;">
                <label class="form-label mb-0">Nama Lengkap</label>
                <input type="text" class="form-control py-1" wire:model.live="nama_lengkap" placeholder="Nama Lengkap" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_FilterNoWa.'.read')
            <div style="margin-bottom:0; flex:0 0 10%;">
                <label class="form-label mb-0">No Whatsapp</label>
                <input type="text" class="form-control py-1" wire:model.live="no_whatsapp" placeholder="No Whatsapp" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_EstimasiGaji.'.read')
            <div style="margin-bottom:0; flex:0 0 10%;">
                <label class="form-label mb-0">Gaji Dari</label>
                <div class="input-group mb-2">
                    <input type="number" class="form-control py-1 px-0 text-center" wire:model.live="estimasi_gaji" placeholder="-- Isi --" >
                    <span class="input-group-text px-1 py-1" id="basic-addon2">00.000</span>
                </div>
            </div>
            <div style="margin-bottom:0; flex:0 0 10%;">
                <label class="form-label mb-0">Gaji Sampai</label>
                <div class="input-group mb-2">
                    <input type="number" class="form-control py-1 px-0 text-center" wire:model.live="estimasi_gaji_top" placeholder="-- Isi --" >
                    <span class="input-group-text px-1 py-1" id="basic-addon2">00.000</span>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Domisili.'.read')
            <div style="margin-bottom:0; flex:0 0 10%;">
                <div class="w-100" wire:ignore>
                    <label>Domisili</label>
                    <select id="select2-domisili" class="form-select py-1" multiple>
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Penempatankerja.'.read')
            <div style="margin-bottom:0; flex:0 0 10%;">
                <div class="w-100" wire:ignore>
                    <label>Preferensi Lokasi</label>
                    <select id="select2-preferensi-lokasi" class="form-select" multiple>
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaLPK.'.read')
            <div style="margin-bottom:0; flex:0 0 10%;">
                <label class="form-label mb-0">Nama LPK</label>
                <input type="text" class="form-control py-1" wire:model.live="nama_lpk" placeholder="Nama LPK" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaInstagram.'.read')
            <div style="margin-bottom:0; flex:0 0 10%;">
                <label class="form-label mb-0">Instagram</label>
                <input type="text" class="form-control py-1" wire:model.live="instagram" placeholder="Instagram" />
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_NamaTikTok.'.read')
            <div style="margin-bottom:0; flex:0 0 10%;">
                <label class="form-label mb-0">Tiktok</label>
                <input type="text" class="form-control py-1" wire:model.live="tiktok" placeholder="Tiktok" />
            </div>
        @endCan
    </div>
    <div class="row mt-0 d-flex gap-1">
    {{-- Dropdown Filter --}}
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_FilterTanggal.'.read')
            <div class="col-auto mb-0"  style="scale: 1;">
                <label class="form-label mb-0">Filter Tanggal</label>
                <select class="form-select py-1" wire:model.live="date_type">
                    <option value="">-- Pilih --</option>
                    @foreach (App\Models\Exata\Exata::FILTER_TGL_CHOICE as $key => $name)
                        @can('exata_'.$key.'.read')
                            <option value="{{$name}}">{{$name}}</option>
                        @endCan
                    @endforeach
                </select>
            </div>
            <div class="col-auto mb-0"  style="scale: 1;">
                <label class="form-label mb-0">Tanggal Dari</label>
                <input type="date" class="form-control py-1" {{$date_type ? '' : 'disabled'}} wire:model.live="start_date"  />
            </div>
            <div class="col-auto mb-0"  style="scale: 1;">
                <label class="form-label mb-0">Tanggal Sampai</label>
                <input type="date" class="form-control py-1" {{$date_type ? '' : 'disabled'}} wire:model.live="end_date"  />
            </div>
        @endCan
        
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Pipeline.'.read')
            <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Pipeline</label><br>
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
            <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Gender</label><br>
                    <select id="select2-gender" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_GENDER_CHOICE as $key => $name)    
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Pendidikan.'.read')
             <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Pendidikan</label><br>
                    <select id="select2-pendidikan" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_PENDIDIKAN_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_LevelBahasa.'.read')
             <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Level Bahasa</label><br>
                    <select id="select2-level-bahasa" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_LEVEL_BAHASA_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Job.'.read')
             <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Job</label><br>
                    <select id="select2-job" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_JOB_CHOICE as $key => $name)    
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_BidangKerjadiJepang.'.read')
            <div class="col-auto mb-0">
                <label class="form-label mb-0">Bidang Kerja (Japan)</label>
                <input type="text" class="form-control py-1" wire:model.live="bidang_kerja_japan" placeholder="Bidang kerja Jepang" />
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_BidangKerjaPilihan.'.read')
             <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Pilihan Kerja (Indonesia)</label><br>
                    <select id="select2-pilihan-kerja-indonesia" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_JOB_PILIHAN_INDO_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_PICSales.'.read')
             <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>PIC / Sales</label><br>
                    <select id="select2-pic-sales" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_SALES_CHOICE as $key => $name)    
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_JenisVisa.'.read')
             <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Jenis Visa</label><br>
                    <select id="select2-jenis-visa" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_JENIS_VISA_CHOICE as $key => $name)    
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan
        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Attachment.'.read')
             <div class="col-auto mb-0">
                <div class="w-100" wire:ignore>
                    <label>Lampiran</label><br>
                    <select id="select2-attachment" class="form-select" multiple>
                        @foreach (App\Models\Exata\Exata::FILTER_ATTACHMENT_CHOICE as $key => $name)    
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endCan

        @can('exata_FILTER_'.App\Models\Exata\Exata::PERMISSION_Keterangan.'.read')
            <div style="flex:0 0 13%;">
                <label class="form-label mb-0">Keterangan</label>
                <input type="text" class="form-control py-1" wire:model.live="keterangan" placeholder="Keterangan" />
            </div>
        @endCan
        <div class="col-auto row d-flex align-items-end">
            <button class="btn btn-warning btn-sm mb-0" wire:click="resetFilter">
                Reset Filter
            </button>
        </div>
    </div>
    {{-- Show Candidate Attachment Modal --}}
    <div class="modal fade" id="showCandidateAttachmentModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-fullscreen" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header">
                    <h5 class="modal-title" id="showCandidateAttachmentModalLabel">Lampiran Kandidat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeImport">
                    <div class="modal-body import_modal">
                        
                        <div class="row d-flex justify-content-center">
                            @foreach ($candidate_attachments as $index => $image)
                                <div class="col-md-10 mb-3 position-relative">
                                   <a href="{{ Storage::url($image['file']) }}" download="{{$image['name']}}" class="position-absolute btn btn-primary btn-sm p-2 m-4">
                                        <i class="fa fa-download"></i>
                                        Download
                                    </a>
                                        @php
                                            if (is_array($image)) {
                                                $ext = pathinfo($image['file'], PATHINFO_EXTENSION);
                                                $url = Storage::url($image['file']);
                                            }

                                            $ext = strtolower($ext);
                                        @endphp
                                        @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                
                                            <img src="{{ $url }}" class="img-fluid rounded">
                                        @elseif(in_array($ext, ['pdf']))
                                            <iframe
                                                src="{{ route('exata.view_pdf', ['id' => Crypt::encrypt($image['id']), 'type' => $candidate_attachment_type]) }}"
                                                width="100%"
                                                height="900"
                                                style="border:none">
                                            </iframe>
                                        @else
                                            <div class="border rounded p-4 text-center bg-light">
                                                <i class="bi bi-file-earmark fs-1"></i>
                                                <div class="mt-2">
                                                    {{ $image['name'] }}
                                                </div>
                                            </div>

                                        @endif
                                        
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Bulk Modal --}}
    {{-- <div class="modal fade" id="bulkModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                                    <label class="form-label mb-0">Pipeline</label>
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
                                    <label class="form-label mb-0">Available</label>
                                    <select class="form-select" wire:model="edit_bulk.Available">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_AVAILABLE_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label mb-0">Kategori</label>
                                    <select class="form-select" wire:model="edit_bulk.Kategori">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_KATEGORI_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Keterangan</label>
                                    <textarea placeholder="Keterangan" class="form-control py-1" cols="30" rows="4" wire:model="edit_bulk.Keterangan"></textarea>
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
    </div> --}}
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
                                    <p class="form-control py-1">{{$edit_detail[App\Models\Exata\Exata::PERMISSION_NamaLengkap]}}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Provinsi</label>
                                    <p class="form-control py-1">{{$edit_detail[App\Models\Exata\Exata::PERMISSION_Provinsi]}}</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Kota</label>
                                    <p class="form-control py-1">{{$edit_detail[App\Models\Exata\Exata::PERMISSION_Kota]}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label mb-0">Pipeline</label>
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
                                    <label class="form-label mb-0">Available</label>
                                    <select class="form-select" wire:model="edit_detail.Available">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_AVAILABLE_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label mb-0">Kategori</label>
                                    <select class="form-select" wire:model="edit_detail.Kategori">
                                        <option value="">-- Pilih --</option>
                                        @foreach (App\Models\Exata\Exata::FILTER_KATEGORI_CHOICE as $key => $name)    
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Keterangan</label>
                                    <textarea placeholder="Keterangan" class="form-control py-1" cols="30" rows="4" wire:model="edit_detail.Keterangan"></textarea>
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
                            <input type="file" wire:model="inputFile" class="form-control py-1" id="inputFile">
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
                                                    @foreach(\App\Models\Exata\Exata::EXATA_IMPORT_CHOICE() as $name => $value)
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
                                                    @foreach(\App\Models\Exata\Exata::EXATA_IMPORT_CHOICE() as $name => $value)
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
    {{-- Import Pipeline Modal --}}
    <div class="modal fade" id="importPipelineModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-fullscreen" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header">
                    <h5 class="modal-title" id="importPipelineModalLabel">Import Pipeline Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeImportPipelineModal"></button>
                </div>
                <form wire:submit.prevent="storeImportPipeline">
                    <div class="modal-body import_modal">
                        <div class="form-group mb-2">
                            <label>File Import Excel</label>
                            <input type="file" wire:model="inputFilePipeline" class="form-control py-1" id="inputFilePipeline">
                            @error('input_file')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            @if($previewPipelineRows)
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="imported-pipeline" data-bs-toggle="tab" data-bs-target="#imported-pipeline-pane" type="button" role="tab" aria-controls="imported-pipeline-pane" aria-selected="true">Imported</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="invalid-pipeline" data-bs-toggle="tab" data-bs-target="#invalid-pipeline-pane" type="button" role="tab" aria-controls="invalid-pipeline-pane" aria-selected="false">Invalid ({{count($errorPipelineRows)}})</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="imported-pipeline-pane" role="tabpanel" aria-labelledby="imported" tabindex="0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @foreach(\App\Models\Exata\Exata::EXATA_IMPORT_PIPELINE_CHOICE() as $name => $value)
                                                        <th>{{$value['name']}}</th>
                                                    @endForeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($previewPipelineRows as $i => $row)
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
                                <div class="tab-pane fade" id="invalid-pipeline-pane" role="tabpanel" aria-labelledby="invalid" tabindex="0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @foreach(\App\Models\Exata\Exata::EXATA_IMPORT_PIPELINE_CHOICE() as $name => $value)
                                                        <th>{{$value['name']}}</th>
                                                    @endForeach
                                                        <th>Pesan Error System</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($previewPipelineRows as $i => $row)
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeImportPipelineModal">Tutup</button>
                        
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target='input_file_pipeline'>Simpan</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('css')
    <style>
        
        /* Container height & padding */
        .select2-container .select2-selection--multiple {
            min-height: 32px !important;
            padding: 2px 6px !important;
            width: 100%;
        }

        /* Selected item badge */
        .select2-container .select2-selection__choice {
            margin-top: 2px !important;
        }

        /* Search input inside select2 */
        .select2-container .select2-search__field {
            margin-top: 2px !important;
        }

        /* Border like bootstrap form-select */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: .375rem;
        }

        /* Focus effect */
        .select2-container--default.select2-container--focus
        .select2-selection--multiple {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .25rem rgba(13,110,253,.25);
        }
        /* Dropdown container */
        .select2-dropdown {
            font-size: 13px;          /* font size option */
        }

        /* Each option */
        .select2-results__option {
            padding: 6px 10px;
            font-size: 13px;
        }

        /* Hover option */
        .select2-results__option--highlighted {
            background-color: #0d6efd !important;
            color: white !important;
        }

        /* Selected option */
        .select2-results__option[aria-selected=true] {
            background-color: #e9ecef;
        }
        /* Selected badge */
        .select2-selection__choice {
            font-size: 12px;
            padding: 2px 20px;
        }

        /* Remove button */
        .select2-selection__choice__remove {
            margin-right: 40px;
        }
        /* keep selected items inline */
        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-y: hidden;
            white-space: nowrap;
        }

        /* prevent each badge wrapping */
        .select2-selection__choice {
            flex: 0 0 auto;
        }
        /* give space before arrow */
        .select2-container .select2-selection--multiple {
            padding-right: 15px !important;
        }
    </style>
@endpush

@push('js')
    <script>
        Livewire.on('onSuccessImportData', () => {
            $('#importModal').modal('hide');
            $('#inputFile').val(null);
        })
        Livewire.on('onSuccessImportPipelineData', () => {
            $('#importPipelineModal').modal('hide');
            $('#inputFilePipeline').val(null);
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
             $('#select2-attachment')
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
            cache: true,
            width: '100%',
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
            cache: true,
            width: '100%',
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

        // Attachment
        $('#select2-attachment').select2({
            placeholder: "-- Pilih --",
            cache: true
        });

        $('#select2-attachment').on('select2:select', function(e) {
            @this.call('selectAttachment', e.params.data)
        });

        $('#select2-attachment').on('select2:unselect', function(e) {
            @this.call('unSelectAttachment', e.params.data)
        });
    </script>
@endpush