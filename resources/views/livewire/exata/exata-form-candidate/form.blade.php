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
                    <input type="text" placeholder="isi" wire:model="NamaLengkap"
                        class="form-control @error('NamaLengkap') is-invalid @enderror">
                    @error('NamaLengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tanggal Lahir</label>
                    <input type="date" wire:model="TanggalLahir"
                        class="form-control @error('TanggalLahir') is-invalid @enderror">
                    @error('TanggalLahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Gender</label>
                    <select wire:model="Gender"
                        class="form-control @error('Gender') is-invalid @enderror">
                        <option value="">-- ISI --</option>
                        @foreach (App\Models\Exata\Exata::FILTER_GENDER_CHOICE as $key => $name)
                        <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                    @error('Gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Pendidikan</label>
                    <select wire:model="Pendidikan"
                        class="form-control @error('Pendidikan') is-invalid @enderror">
                        <option value="">-- ISI --</option>
                        @foreach (App\Models\Exata\Exata::FILTER_PENDIDIKAN_CHOICE as $key => $name)
                        <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                    @error('Pendidikan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Level Bahasa</label>
                    <select wire:model="LevelBahasa"
                        class="form-control @error('LevelBahasa') is-invalid @enderror">
                        <option value="">-- ISI --</option>
                        @foreach (App\Models\Exata\Exata::FILTER_LEVEL_BAHASA_CHOICE as $key => $name)
                        <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                    @error('LevelBahasa')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tahun Terbit</label>
                    <input type="number" wire:model="TahunTerbit"
                        class="form-control @error('TahunTerbit') is-invalid @enderror">
                    @error('TahunTerbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Lama di Jepang (Bulan)</label>
                    <input type="number" wire:model="LamaDiJepang"
                        class="form-control @error('LamaDiJepang') is-invalid @enderror">
                    @error('LamaDiJepang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tanggal Pulang</label>
                    <input type="date" wire:model="TanggalPulang"
                        class="form-control @error('TanggalPulang') is-invalid @enderror">
                    @error('TanggalPulang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- CHECKBOX GROUP --}}
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
                    <input type="number" wire:model="EstimasiGaji"
                        class="form-control @error('EstimasiGaji') is-invalid @enderror" placeholder="cth: 8000000">
                    @error('EstimasiGaji')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6  @error('Domisili') border border-danger @enderror">
                    <label>Domisili</label>
                    <div class="w-full" wire:ignore>
                        <select id="select2-domisili" class="form-select">
                        </select>
                    </div>
                    <input type="hidden" class="@error('Domisili') is-invalid @enderror">
                    @error('Domisili')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 @error('Penempatankerja') border border-danger @enderror">
                    <label>Penempatan Kerja</label>
                    <div class="w-full" wire:ignore>
                        <select id="select2-preferensi-lokasi" class="form-select" multiple>
                        </select>
                    </div>
                    <input type="hidden" class="@error('Penempatankerja') is-invalid @enderror">
                    @error('Penempatankerja')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tanggal Siap Kerja</label>
                    <input type="date" wire:model="TglSiapkerja"
                        class="form-control @error('TglSiapkerja') is-invalid @enderror">
                    @error('TglSiapkerja')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Bidang Kerja di Jepang</label>
                    <input type="text" placeholder="isi" wire:model="BidangKerjadiJepang"
                        class="form-control @error('BidangKerjadiJepang') is-invalid @enderror">
                    @error('BidangKerjadiJepang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-2 @error('BidangKerjaPilihan') border border-danger @enderror">
                    <label>Bidang Kerja Pilihan</label>
                    <div class="w-full" wire:ignore>
                        <select id="select2-BidangKerjaPilihan" class="form-select" multiple>
                            <option value="">-- ISI --</option>
                            @foreach (App\Models\Exata\Exata::FILTER_JOB_PILIHAN_INDO_CHOICE as $key => $name)    
                                <option value="{{$name}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" class="@error('BidangKerjaPilihan') is-invalid @enderror">
                    @error('BidangKerjaPilihan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2 mb-2 d-flex align-items-center"> 
                    <div class="form-check m-2"> 
                        <input class="form-check-input" type="checkbox" wire:model="Senmongkyu"> 
                        <label class="form-label ms-2 mb-2"> Senmongkyu </label> 
                    </div> 
                </div>
                <div class="col-md-4 mb-2">
                    <label>Bidang Senmon Kyu</label>
                    <input type="text" placeholder="isi" wire:model="BidangSenmongkyu"
                        class="form-control @error('BidangSenmongkyu') is-invalid @enderror">
                    @error('BidangSenmongkyu')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label>Jenis Visa</label>
                    <select wire:model="JenisVisa"
                        class="form-control @error('JenisVisa') is-invalid @enderror">
                        <option value="">-- ISI --</option>
                        @foreach (App\Models\Exata\Exata::FILTER_JENIS_VISA_CHOICE as $key => $name)
                        <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                    @error('JenisVisa')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- LOCATION --}}
                <div class="row">
                    {{-- Provinsi --}}
                    <div class="col-md-6 mb-2">
                        <label>Provinsi</label>
                        <input type="text"
                            wire:model="Provinsi"
                            class="form-control @error('Provinsi') is-invalid @enderror">
                        @error('Provinsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kota --}}
                    <div class="col-md-6 mb-2">
                        <label>Kota</label>
                        <input type="text"
                            wire:model="Kota"
                            class="form-control @error('Kota') is-invalid @enderror">
                        @error('Kota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama TikTok --}}
                    <div class="col-md-6 mb-2">
                        <label>Nama TikTok</label>
                        <input type="text"
                            wire:model="NamaTikTok"
                            class="form-control @error('NamaTikTok') is-invalid @enderror">
                        @error('NamaTikTok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Instagram --}}
                    <div class="col-md-6 mb-2">
                        <label>Nama Instagram</label>
                        <input type="text"
                            wire:model="NamaInstagram"
                            class="form-control @error('NamaInstagram') is-invalid @enderror">
                        @error('NamaInstagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- No Telp Indonesia --}}
                    <div class="col-md-6 mb-2">
                        <label>No Telp Indonesia</label>
                        <input type="text"
                            wire:model="NoTelpIndonesia"
                            class="form-control @error('NoTelpIndonesia') is-invalid @enderror">
                        @error('NoTelpIndonesia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- No Telp Jepang --}}
                    <div class="col-md-6 mb-2">
                        <label>No Telp Jepang</label>
                        <input type="text"
                            wire:model="NoTelpJepang"
                            class="form-control @error('NoTelpJepang') is-invalid @enderror">
                        @error('NoTelpJepang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 mb-2">
                        <label>Email</label>
                        <input type="email"
                            wire:model="Email"
                            class="form-control @error('Email') is-invalid @enderror">
                        @error('Email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama LPK --}}
                    <div class="col-md-6 mb-2">
                        <label>Nama LPK</label>
                        <input type="text"
                            wire:model="NamaLPK"
                            class="form-control @error('NamaLPK') is-invalid @enderror">
                        @error('NamaLPK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                {{-- BODY --}}
                <div class="col-md-3">
                    <label for="tinggi_badan">Tinggi Badan</label>
                    
                    <div class="input-group mb-3 @error('tinggi_badan') is-invalid @enderror">
                        <input type="number" class="@error('tinggi_badan') is-invalid @enderror form-control" placeholder="Tinggi Badan" aria-label="Tinggi Badan" id="tinggi_badan" wire:model="tinggi_badan">

                        <span class="input-group-text">Kg</span>
                    </div>
                    @error('tinggi_badan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="berat_badan">Berat Badan</label>
                    
                    <div class="input-group mb-3 @error('berat_badan') is-invalid @enderror ">
                        <input type="number" class="@error('berat_badan') is-invalid @enderror form-control" placeholder="Berat Badan" aria-label="Berat Badan" id="berat_badan" wire:model="berat_badan">

                        <span class="input-group-text">Cm</span>
                    </div>

                    @error('berat_badan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="skill_bahasa_lain">Skill Bahasa Lain</label>
                    <input type="text" id="skill_bahasa_lain" wire:model="skill_bahasa_lain" class="@error('skill_bahasa_lain') is-invalid @enderror form-control" placeholder="contoh: Bahasa Inggris, Mandarin, Dll">

                    @error('skill_bahasa_lain')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="skill_komputer">Skill Komputer</label>
                    <input type="text" id="skill_komputer" wire:model="skill_komputer" class="@error('skill_komputer') is-invalid @enderror form-control" placeholder="contoh: MS Office, Editing Video, Dll">

                    @error('skill_komputer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="pencapaian_tertinggi">Pencapaian Tertinggi Selama Bekerja</label>
                    <input type="text" id="pencapaian_tertinggi" wire:model="pencapaian_tertinggi" class="@error('pencapaian_tertinggi') is-invalid @enderror form-control" placeholder="Pencapaian Tertinggi Selama Bekerja">

                    @error('pencapaian_tertinggi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="value_saat_di_jepang">Value saat berada di Jepang yang diterapkan di kegiatan sehari-hari </label>
                    <input type="text" id="value_saat_di_jepang" wire:model="value_saat_di_jepang" class="@error('value_saat_di_jepang') is-invalid @enderror form-control" placeholder="Value saat berada di Jepang yang diterapkan di kegiatan sehari-hari ">

                    @error('value_saat_di_jepang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="soft_skill">Soft Skill </label>
                    <input type="text" id="soft_skill" wire:model="soft_skill" class="@error('soft_skill') is-invalid @enderror form-control" placeholder="Soft Skill ">

                    @error('soft_skill')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="skill_lainnya">Skill Lainnya </label>
                    <input type="text" id="skill_lainnya" wire:model="skill_lainnya" class="@error('skill_lainnya') is-invalid @enderror form-control" placeholder="Skill Lainnya ">

                    @error('skill_lainnya')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="pengalaman_kerja">Pengalaman Kerja </label>
                    <input type="text" id="pengalaman_kerja" wire:model="pengalaman_kerja" class="@error('pengalaman_kerja') is-invalid @enderror form-control" placeholder="Pengalaman Kerja ">

                    @error('pengalaman_kerja')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- FILE --}}
                <div class="col-md-6">
                    <label>Sertifikat Bahasa Jepang</label>
                    <input type="file"
                        wire:model="sertifikat_bahasa_jepang"
                        multiple
                        class="form-control @error('sertifikat_bahasa_jepang') is-invalid @enderror">
                    @error('sertifikat_bahasa_jepang')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label>CV</label>
                    <input type="file"
                        wire:model="cv"
                        multiple
                        class="form-control @error('cv') is-invalid @enderror">
                    @error('cv')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                    <input type="text" placeholder="isi" class="form-control text-center" wire:model="input_password">
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
document.addEventListener('livewire:init', () => {

    Livewire.on('onAuthorized', () => {

        setTimeout(() => initSelect2(), 100);

    });

});

function initSelect2() {
// Domisili
            $('#select2-domisili').select2({
                placeholder: "-- Pilih --",
                ajax: {
                    url: "{{ route('public.get.regency') }}",
                    dataType: "json",
                    type: "GET",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    delay: 250,
                    cache: true,

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
                    url: "{{ route('public.get.regency') }}",
                    dataType: "json",
                    type: "GET",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    delay: 250,
                    cache: true,

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

}
    </script>
@endpush