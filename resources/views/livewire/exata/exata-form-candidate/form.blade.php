<div>

    
        
        <div wire:loading wire:target="images, store"
        class="position-fixed top-0 start-0 w-100 h-100 
                bg-dark bg-opacity-50 
                justify-content-center align-items-center"
        style="z-index:9999;">

            <div class="bg-white p-4 rounded shadow">
                <p class="text-dark" style="font-size: 1.5rem; width: 100%; text-align: center;"> 
                    <i class="text-dark animate-wand fas fa-wand-magic-sparkles text-dark"></i> &nbsp; Sedang Memproses
                </p>
            </div>
        </div>
        @if ($authorized)
            <form wire:submit.prevent="store">
                <div class="row">

                    <div class="col-md-6 mb-2">
                        <label>Nama Lengkap</label>
                        <input type="text" wire:model="NamaLengkap" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Tanggal Lahir</label>
                        <input type="date" wire:model="TanggalLahir" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Gender</label>
                        <select wire:model="Gender" class="form-control">
                            <option value="">-- ISI --</option>
                            @foreach (App\Models\Exata\Exata::FILTER_GENDER_CHOICE as $key => $name)    
                                <option value="{{$name}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Pendidikan</label>
                        <select wire:model="Pendidikan" class="form-control">
                            <option value="">-- ISI --</option>
                            @foreach (App\Models\Exata\Exata::FILTER_PENDIDIKAN_CHOICE as $key => $name)    
                                <option value="{{$name}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Level Bahasa</label>
                        <select wire:model="LevelBahasa" class="form-control">
                            <option value="">-- ISI --</option>
                            @foreach (App\Models\Exata\Exata::FILTER_LEVEL_BAHASA_CHOICE as $key => $name)    
                                <option value="{{$name}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Tahun Terbit</label>
                        <input type="number" wire:model="TahunTerbit" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Lama di Jepang (Bulan)</label>
                        <input type="number" wire:model="LamaDiJepang" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Tanggal Pulang</label>
                        <input type="date" wire:model="TanggalPulang" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="checkbox" wire:model="Sensei">
                                    <label class="form-label ms-2 mb-2">
                                        Sensei
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="checkbox" wire:model="Dokumen">
                                    <label class="form-label ms-2 mb-2">
                                        Dokumen
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="checkbox" wire:model="Penerjemah">
                                    <label class="form-label ms-2 mb-2">
                                        Penerjemah
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Estimasi Gaji</label>
                        <input type="number" wire:model="EstimasiGaji" class="form-control" placeholder="cth: 8000000">
                    </div>
                    <div class="col-md-6" wire:ignore>
                        <label>Domisili</label>
                        <select id="select2-domisili" class="form-select">
                        </select>
                    </div>

                    <div class="col-md-6" wire:ignore>
                        <label>Penempatan Kerja</label>
                        <select id="select2-preferensi-lokasi" class="form-select" multiple>
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Tanggal Siap Kerja</label>
                        <input type="date" wire:model="TglSiapkerja" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Bidang Kerja di Jepang</label>
                        <input type="text" wire:model="BidangKerjadiJepang" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2" wire:ignore>
                        <label>Bidang Kerja Pilihan</label>
                        <select id="select2-BidangKerjaPilihan" class="form-select" multiple>
                            <option value="">-- ISI --</option>
                            @foreach (App\Models\Exata\Exata::FILTER_JOB_PILIHAN_INDO_CHOICE as $key => $name)    
                                <option value="{{$name}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <div class="form-check m-2">
                            <input class="form-check-input" type="checkbox" wire:model="Senmongkyu">
                            <label class="form-label ms-2 mb-2">
                                Senmongkyu
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Bidang Senmon Kyu</label>
                        <input type="text" wire:model="BidangSenmongkyu" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Jenis Visa</label>
                        <select wire:model="JenisVisa" class="form-control">
                            <option value="">-- ISI --</option>
                            @foreach (App\Models\Exata\Exata::FILTER_JENIS_VISA_CHOICE as $key => $name)    
                                <option value="{{$name}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Provinsi</label>
                        <input type="text" wire:model="Provinsi" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Kota</label>
                        <input type="text" wire:model="Kota" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Nama TikTok</label>
                        <input type="text" wire:model="NamaTikTok" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Nama Instagram</label>
                        <input type="text" wire:model="NamaInstagram" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>No Telp Indonesia</label>
                        <input type="text" wire:model="NoTelpIndonesia" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>No Telp Jepang</label>
                        <input type="text" wire:model="NoTelpJepang" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Email</label>
                        <input type="email" wire:model="Email" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Nama LPK</label>
                        <input type="text" wire:model="NamaLPK" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="tinggi_badan">Tinggi Badan</label>
                        
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Tinggi Badan" aria-label="Tinggi Badan" id="tinggi_badan" wire:model="tinggi_badan">
                            <span class="input-group-text">Kg</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_badan">Berat Badan</label>
                        
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Berat Badan" aria-label="Berat Badan" id="berat_badan" wire:model="berat_badan">
                            <span class="input-group-text">Cm</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="skill_bahasa_lain">Skill Bahasa Lain</label>
                        <input type="text" id="skill_bahasa_lain" wire:model="skill_bahasa_lain" class="form-control" placeholder="contoh: Bahasa Inggris, Mandarin, Dll">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="skill_komputer">Skill Komputer</label>
                        <input type="text" id="skill_komputer" wire:model="skill_komputer" class="form-control" placeholder="contoh: MS Office, Editing Video, Dll">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="pencapaian_tertinggi">Pencapaian Tertinggi Selama Bekerja</label>
                        <input type="text" id="pencapaian_tertinggi" wire:model="pencapaian_tertinggi" class="form-control" placeholder="Pencapaian Tertinggi Selama Bekerja">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="value_saat_di_jepang">Value saat berada di Jepang yang diterapkan di kegiatan sehari-hari </label>
                        <input type="text" id="value_saat_di_jepang" wire:model="value_saat_di_jepang" class="form-control" placeholder="Value saat berada di Jepang yang diterapkan di kegiatan sehari-hari ">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="soft_skill">Soft Skill </label>
                        <input type="text" id="soft_skill" wire:model="soft_skill" class="form-control" placeholder="Soft Skill ">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="skill_lainnya">Skill Lainnya </label>
                        <input type="text" id="skill_lainnya" wire:model="skill_lainnya" class="form-control" placeholder="Skill Lainnya ">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="pengalaman_kerja">Pengalaman Kerja </label>
                        <input type="text" id="pengalaman_kerja" wire:model="pengalaman_kerja" class="form-control" placeholder="Pengalaman Kerja ">
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Sertifikat Bahasa Jepang</label>
                            <input type="file" wire:model="sertifikat_bahasa_jepang" multiple class="form-control">
            
                            @error('sertifikat_bahasa_jepang.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Preview --}}
                        <div class="row mt-3">
                            @foreach ($sertifikat_bahasa_jepang as $index => $image)
                                <div class="col-md-6 mb-2 position-relative" wire:key="sertifikat_bahasa_jepang_{{$index}}">
                                    <button type="button" class="position-absolute btn btn-danger btn-sm p-2 m-2" wire:click="removeSertifikatBahasaJepang({{$index}})">
                                        <i class='ki-duotone ki-trash fs-4'>
                                            <span class='path1'></span>
                                            <span class='path2'></span>
                                            <span class='path3'></span>
                                            <span class='path4'></span>
                                            <span class='path5'></span>
                                        </i>
                                    </button>
                                    @php
                                        $ext = $image->getClientOriginalExtension();
                                        if(in_array($ext, ['jpg','jpeg','png','gif','webp'])){
                                            $url = $image->temporaryUrl();
                                        }else{
                                            $url = $image->getClientOriginalName();
                                        }
                                        

                                        $ext = strtolower($ext);
                                        
                                    @endphp
                                    @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
            
                                        <img src="{{ $url }}" class="img-fluid rounded">
                                    @else

                                        <div class="border rounded p-4 text-center bg-light">
                                            <i class="bi bi-file-earmark fs-1"></i>
                                            <div class="mt-2">
                                                {{$url}}
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            @endforeach
                            @foreach ($sertifikat_bahasa_jepang_old as $index => $image)
                                <div class="col-md-6 mb-2 position-relative" wire:key="sertifikat_bahasa_jepang_old_{{$index}}">
                                    <button type="button" class="position-absolute btn btn-danger btn-sm p-2 m-2" wire:click="removeSertifikatBahasaJepangOld({{$index}})">
                                        <i class='ki-duotone ki-trash fs-4'>
                                            <span class='path1'></span>
                                            <span class='path2'></span>
                                            <span class='path3'></span>
                                            <span class='path4'></span>
                                            <span class='path5'></span>
                                        </i>
                                    </button>
                                    @php
                                        
                                        if (is_array($image)) {
                                            $ext = pathinfo($image['file'], PATHINFO_EXTENSION);
                                            $url = $image['file'];
                                        }

                                        $ext = strtolower($ext);
                                        
                                    @endphp
                                    @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
            
                                        <img src="{{ $url }}" class="img-fluid rounded">
                                    @else
                                        <div class="border rounded p-4 text-center bg-light">
                                            <i class="bi bi-file-earmark fs-1"></i>
                                            <div class="mt-2">
                                                {{ $image['name'] }}
                                            </div>

                                            <a href="{{ $url }}" download="{{$image['name']}}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                                Download
                                            </a>
                                        </div>

                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>CV</label>
                            <input type="file" wire:model="cv" multiple class="form-control">
            
                            @error('cv.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
            
                        {{-- Preview --}}
                        <div class="row mt-3">
                            @foreach ($cv as $index => $image)
                                <div class="col-md-6 mb-2 position-relative" wire:key="cv_{{$index}}">
                                    <button type="button" class="position-absolute btn btn-danger btn-sm p-2 m-2" wire:click="removeCV({{$index}})">
                                        <i class='ki-duotone ki-trash fs-4'>
                                            <span class='path1'></span>
                                            <span class='path2'></span>
                                            <span class='path3'></span>
                                            <span class='path4'></span>
                                            <span class='path5'></span>
                                        </i>
                                    </button>
                                    @php
                                        $ext = $image->getClientOriginalExtension();
                                        if(in_array($ext, ['jpg','jpeg','png','gif','webp'])){
                                            $url = $image->temporaryUrl();
                                        }else{
                                            $url = $image->getClientOriginalName();
                                        }
                                        

                                        $ext = strtolower($ext);
                                        
                                    @endphp
                                    @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
            
                                        <img src="{{ $url }}" class="img-fluid rounded">
                                    @else

                                        <div class="border rounded p-4 text-center bg-light">
                                            <i class="bi bi-file-earmark fs-1"></i>
                                            <div class="mt-2">
                                                {{$url}}
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            @endforeach
                            @foreach ($cv_old as $index => $image)
                                <div class="col-md-6 mb-2 position-relative" wire:key="cv_old_{{$index}}">
                                    <button type="button" class="position-absolute btn btn-danger btn-sm p-2 m-2" wire:click="removeCVOld({{$index}})">
                                        <i class='ki-duotone ki-trash fs-4'>
                                            <span class='path1'></span>
                                            <span class='path2'></span>
                                            <span class='path3'></span>
                                            <span class='path4'></span>
                                            <span class='path5'></span>
                                        </i>
                                    </button>
                                    @php
                                        
                                        if (is_array($image)) {
                                            $ext = pathinfo($image['file'], PATHINFO_EXTENSION);
                                            $url = $image['file'];
                                        }

                                        $ext = strtolower($ext);
                                        
                                    @endphp
                                    @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
            
                                        <img src="{{ $url }}" class="img-fluid rounded">
                                    @else
                                        <div class="border rounded p-4 text-center bg-light">
                                            <i class="bi bi-file-earmark fs-1"></i>
                                            <div class="mt-2">
                                                {{ $image['name'] }}
                                            </div>

                                            <a href="{{ $url }}" download="{{$image['name']}}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                                Download
                                            </a>
                                        </div>

                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mt-3">
                    Save
                </button>
            </form>
        @else
        <form wire:submit.prevent="checkPassword">

            <div class="row d-flex justify-content-center">
                <div class="col-md-4 text-center">
                    <h3>Masukkan Password</h3>
                    <input type="text" class="form-control text-center" wire:model="input_password">
                    <div class="col-auto">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mt-3">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>

        </form>
        @endif

        


</div>

@push('css')
    <style>
        @keyframes pulse-wand {
            0%   { transform: scale(1);   opacity: 1; }
            50%  { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1);   opacity: 1; }
        }

        .animate-wand {
            animation: pulse-wand 1s infinite ease-in-out;
        }
    </style>
@endpush

@push('js')
    <script>

        Livewire.on('onAuthorized', (data) => {
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
            $('#select2-BidangKerjaPilihan').select2({
                placeholder: "-- Pilih --",
                cache: true
            });
    
            $('#select2-preferensi-lokasi').on('select2:select', function(e) {
                @this.call('selectPreferensiLokasi', e.params.data)
            });
    
            $('#select2-preferensi-lokasi').on('select2:unselect', function(e) {
                @this.call('unSelectPreferensiLokasi', e.params.data)
            });
            $('#select2-BidangKerjaPilihan').on('select2:select', function(e) {
                @this.call('selectBidangKerjaPilihan', e.params.data)
            });
    
            $('#select2-BidangKerjaPilihan').on('select2:unselect', function(e) {
                @this.call('unSelectBidangKerjaPilihan', e.params.data)
            });
        });
    </script>
@endpush