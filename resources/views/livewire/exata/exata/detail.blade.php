<div>

    <form wire:submit.prevent="store">
        
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
        <div class="row">

            <div class="col-md-6 mb-2">
                <label for="skill_bahasa_lain">Nama Lengkap</label>
                <input type="text" disabled class="form-control" value="{{$candidate_profile['NamaLengkap']}}">
            </div>
            <div class="col-md-6 mb-2">
                <label for="skill_bahasa_lain">Nama LPK</label>
                <input type="text" disabled class="form-control" value="{{$candidate_profile['NamaLPK']}}">
            </div>
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
                    <input type="file" wire:model="cv" multiple class="form-control @error('cv') is-invalid @enderror">

                    @error('cv')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
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