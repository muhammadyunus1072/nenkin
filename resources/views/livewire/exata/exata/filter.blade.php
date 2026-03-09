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
     @can('exata_no.read')
     <div class="col-auto mb-2">
            <label class="form-label">no</label>
            <input type="text" class="form-control" wire:model.live="no" placeholder="no" />
        </div>
    @endCan
     @can('exata_tgl_input.read')
     <div class="col-auto mb-2">
            <label class="form-label">tgl_input</label>
            <input type="date" class="form-control" wire:model.live="tgl_input" />
        </div>
        @endCan
     @can('exata_habis_kontrak.read')
     <div class="col-auto mb-2">
            <label class="form-label">habis_kontrak</label>
            <select class="form-select" wire:model.live="habis_kontrak">
                <option value="">Semua</option>
                <option value="Habis Kontrak">Habis Kontrak</option>
                <option value="Resign">Resign</option>
                <option value="Cuti">Cuti</option>
            </select>
        </div>
     @endCan
     @can('exata_kembali_ke_jepang.read')
     <div class="col-auto mb-2">
            <label class="form-label">kembali_ke_jepang</label>
            <input type="date" class="form-control" wire:model.live="kembali_ke_jepang" />
        </div>
     @endCan
     @can('exata_nama_lengkap.read')
     <div class="col-auto mb-2">
            <label class="form-label">nama_lengkap</label>
        <input type="text" class="form-control" wire:model.live="nama_lengkap" placeholder="nama_lengkap" />
        </div>
     @endCan
     @can('exata_tgl_pulang.read')
     <div class="col-auto mb-2">
            <label class="form-label">tgl_pulang</label>
            <input type="date" class="form-control" wire:model.live="tgl_pulang"  />
        </div>
     @endCan
     @can('exata_pic.read')
     <div class="col-auto mb-2">
            <label class="form-label">pic</label>
        <input type="text" class="form-control" wire:model.live="pic" placeholder="pic" />
        </div>
     @endCan
     @can('exata_nama_lpk.read')
     <div class="col-auto mb-2">
            <label class="form-label">nama_lpk</label>
        <input type="text" class="form-control" wire:model.live="nama_lpk" placeholder="nama_lpk" />
        </div>
     @endCan
     @can('exata_lama_di_jepang.read')
     <div class="col-auto mb-2">
            <label class="form-label">lama_di_jepang</label>
        <input type="text" class="form-control" wire:model.live="lama_di_jepang" placeholder="lama_di_jepang" />
        </div>
     @endCan
     @can('exata_referensi_kerja.read')
     <div class="col-auto mb-2">
            <label class="form-label">referensi_kerja</label>
            <select class="form-select" wire:model.live="referensi_kerja">
                <option value="">Semua</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
     @endCan
     @can('exata_jenis_kelamin.read')
     <div class="col-auto mb-2">
            <label class="form-label">jenis_kelamin</label>
            <select class="form-select" wire:model.live="jenis_kelamin">
                <option value="">Semua</option>
                <option value="L">L</option>
                <option value="P">P</option>
            </select>
        </div>
     @endCan
     @can('exata_pendidikan.read')
     <div class="col-auto mb-2">
            <label class="form-label">pendidikan</label>
            <select class="form-select" wire:model.live="pendidikan">
                <option value="">Semua</option>
                <option value="SMA / SMK">SMA / SMK</option>
                <option value="D1">D1</option>
                <option value="D3">D3</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
            </select>
        </div>
     @endCan
     @can('exata_tahun_terbit.read')
     <div class="col-auto mb-2">
            <label class="form-label">tahun_terbit</label>
        <input type="number" class="form-control" wire:model.live="tahun_terbit" placeholder="tahun_terbit"/>
        </div>
     @endCan
     @can('exata_level_bahasa.read')
     <div class="col-auto mb-2">
            <label class="form-label">level_bahasa</label>
            <select class="form-select" wire:model.live="level_bahasa" placeholder="level_bahasa">
                <option value="">Semua</option>
                <option value="N1">N1</option>
                <option value="N2">N2</option>
                <option value="N3">N3</option>
                <option value="N4">N4</option>
                <option value="N5">N5</option>
                <option value="Tidak Punya">Tidak Punya</option>
            </select>
        </div>
     @endCan
     @can('exata_sensei.read')
     <div class="col-auto mb-2">
            <label class="form-label">sensei</label>
            <select class="form-select" wire:model.live="sensei" placeholder="sensei">
                <option value="">Semua</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
     @endCan
     @can('exata_dokumen.read')
     <div class="col-auto mb-2">
            <label class="form-label">dokumen</label>
            <select class="form-select" wire:model.live="dokumen" placeholder="dokumen">
                <option value="">Semua</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
     @endCan
     @can('exata_penerjemah.read')
     <div class="col-auto mb-2">
            <label class="form-label">penerjemah</label>
            <select class="form-select" wire:model.live="penerjemah" placeholder="penerjemah">
                <option value="">Semua</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
     @endCan
     @can('exata_bidang_kerja_di_jepang.read')
     <div class="col-auto mb-2">
            <label class="form-label">bidang_kerja_di_jepang</label>
        <input type="text" class="form-control" wire:model.live="bidang_kerja_di_jepang" placeholder="bidang_kerja_di_jepang" />
        </div>
     @endCan
     @can('exata_bidang_kerja_pilihan.read')
     <div class="col-auto mb-2">
            <label class="form-label">bidang_kerja_pilihan</label>

            <select class="form-select" wire:model.live="bidang_kerja_pilihan">
                <option value="">Semua</option>
                <option value="Administrasi Dan Sumber Daya Manusia (HR)">Administrasi Dan Sumber Daya Manusia (HR)</option>
                <option value="Administrasi Perkantoran">Administrasi Perkantoran</option>
                <option value="Hotel">Hotel</option>
                <option value="Hukum Dan Legal">Hukum Dan Legal</option>
                <option value="Industri Kreatif, Seni, Dan Media">Industri Kreatif, Seni, Dan Media</option>
                <option value="Kesehatan Dan Medis (Perawat, Farmasi)">Kesehatan Dan Medis (Perawat, Farmasi)</option>
                <option value="Keuangan Dan Perbankan">Keuangan Dan Perbankan</option>
                <option value="Logistik Dan Transportasi">Logistik Dan Transportasi</option>
                <option value="Manufaktur / Pabrik">Manufaktur / Pabrik</option>
                <option value="Otomotif/Bengkel">Otomotif/Bengkel</option>
                <option value="Pariwisata Dan Agen Perjalanan">Pariwisata Dan Agen Perjalanan</option>
                <option value="Pembangunan (Konstruksi)">Pembangunan (Konstruksi)</option>
                <option value="Pendidikan Dan Akademis">Pendidikan Dan Akademis</option>
                <option value="Pengelasan">Pengelasan</option>
                <option value="Perikanan Dan Kelautan">Perikanan Dan Kelautan</option>
                <option value="Pertambangan Dan Energi">Pertambangan Dan Energi</option>
                <option value="Pertanian Dan Perkebunan">Pertanian Dan Perkebunan</option>
                <option value="Restoran">Restoran</option>
                <option value="Ritel Dan Perdagangan (Grosir/Eceran)">Ritel Dan Perdagangan (Grosir/Eceran)</option>
                <option value="Sensei/Guru Bahasa Jepang">Sensei/Guru Bahasa Jepang</option>
                <option value="Teknologi Informasi (IT) Dan Telekomunikasi">Teknologi Informasi (IT) Dan Telekomunikasi</option>
                <option value="Tekstil Dan Garmen">Tekstil Dan Garmen</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
     @endCan
     @can('exata_senmongkyu.read')
     <div class="col-auto mb-2">
            <label class="form-label">senmongkyu</label>
            <select class="form-select" wire:model.live="senmongkyu">
                <option value="">Semua</option>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
     @endCan
     @can('exata_bidang_senmongkyu.read')
     <div class="col-auto mb-2">
            <label class="form-label">bidang_senmongkyu</label>
        <input type="text" class="form-control" wire:model.live="bidang_senmongkyu" placeholder="bidang_senmongkyu" />
        </div>
     @endCan
     @can('exata_jenis_visa.read')
     <div class="col-auto mb-2">
            <label class="form-label">jenis_visa</label>
            <select class="form-select" wire:model.live="jenis_visa">
                <option value="">Semua</option>
                <option value="Specified Skilled Worker (I)">Specified Skilled Worker (I)</option>
                <option value="Technical Intern Training (I) (B)">Technical Intern Training (I) (B)</option>
                <option value="Technical Intern Training (II) (B)">Technical Intern Training (II) (B)</option>
                <option value="Technical Intern Training (III) (B)">Technical Intern Training (III) (B)</option>
                <option value="Designated Activities">Designated Activities</option>
                <option value="Dependent">Dependent</option>
                <option value="Engineering">Engineering</option>
                <option value="Medical Services">Medical Services</option>
                <option value="Intra Company Transferee">Intra Company Transferee</option>
                <option value="Skilled Labor">Skilled Labor</option>
                <option value="Nursing Care">Nursing Care</option>
            </select>
        </div>
     @endCan
     @can('exata_nama_tiktok.read')
     <div class="col-auto mb-2">
            <label class="form-label">nama_tiktok</label>
            <input type="text" class="form-control" wire:model.live="nama_tiktok" placeholder="nama_tiktok" />
        </div>
     @endCan
     @can('exata_nama_instagram.read')
     <div class="col-auto mb-2">
            <label class="form-label">nama_instagram</label>
            <input type="text" class="form-control" wire:model.live="nama_instagram" placeholder="nama_instagram" />
        </div>
     @endCan
     @can('exata_no_telp_indonesia.read')
     <div class="col-auto mb-2">
            <label class="form-label">no_telp_indonesia</label>
            <input type="text" class="form-control" wire:model.live="no_telp_indonesia" placeholder="no_telp_indonesia" />
        </div>
     @endCan
     @can('exata_no_telp_jepang.read')
     <div class="col-auto mb-2">
            <label class="form-label">no_telp_jepang</label>
            <input type="text" class="form-control" wire:model.live="no_telp_jepang" placeholder="no_telp_jepang" />
        </div>
     @endCan
     @can('exata_email.read')
     <div class="col-auto mb-2">
            <label class="form-label">email</label>
            <input type="email" class="form-control" wire:model.live="email" placeholder="email" />
        </div>
     @endCan
     @can('exata_provinsi.read')
     <div class="col-auto mb-2">
            <label class="form-label">provinsi</label>
            <input type="text" class="form-control" wire:model.live="provinsi" placeholder="provinsi" />
        </div>
     @endCan
     @can('exata_kota.read')
     <div class="col-auto mb-2">
            <label class="form-label">kota</label>
            <input type="text" class="form-control" wire:model.live="kota" placeholder="kota" />
        </div>
     @endCan
     @can('exata_available.read')
     <div class="col-auto mb-2">
            <label class="form-label">available</label>
            <select class="form-select" wire:model.live="available">
                <option value="">Semua</option>
                <option value="y">Ya</option>
                <option value="t">Tidak</option>
            </select>
        </div>
    </div>
    @endCan

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