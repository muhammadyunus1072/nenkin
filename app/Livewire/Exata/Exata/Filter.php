<?php

namespace App\Livewire\Exata\Exata;

use App\Helpers\Alert;
use App\Imports\ExcelImportExata;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Filter extends Component
{
    use WithFileUploads;

    public $inputFile;

    public $no;
    public $tgl_input;
    public $habis_kontrak;
    public $kembali_ke_jepang;
    public $nama_lengkap;
    public $tgl_pulang;
    public $pic;
    public $nama_lpk;
    public $lama_di_jepang;
    public $referensi_kerja;
    public $jenis_kelamin;
    public $pendidikan;
    public $tahun_terbit;
    public $level_bahasa;
    public $sensei;
    public $dokumen;
    public $penerjemah;
    public $bidang_kerja_di_jepang;
    public $bidang_kerja_pilihan;
    public $senmongkyu;
    public $bidang_senmongkyu;
    public $jenis_visa;
    public $nama_tiktok;
    public $nama_instagram;
    public $no_telp_indonesia;
    public $no_telp_jepang;
    public $email;
    public $provinsi;
    public $kota;
    public $available;


    public function mount() {}

    public function storeImport()
    {
        try {
            DB::beginTransaction();
            $path = $this->inputFile->store('temp');
            Excel::import(new ExcelImportExata(), Storage::path($path));
            DB::commit();

            $this->dispatch('onSuccessImportData');

            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );

            $this->dispatch('refresh-table');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function updated()
    {
        $this->dispatch('datatable-add-filter', [
            'no' => $this->no,
            'tgl_input' => $this->tgl_input,
            'habis_kontrak' => $this->habis_kontrak,
            'kembali_ke_jepang' => $this->kembali_ke_jepang,
            'nama_lengkap' => $this->nama_lengkap,
            'tgl_pulang' => $this->tgl_pulang,
            'pic' => $this->pic,
            'nama_lpk' => $this->nama_lpk,
            'lama_di_jepang' => $this->lama_di_jepang,
            'referensi_kerja' => $this->referensi_kerja,
            'jenis_kelamin' => $this->jenis_kelamin,
            'pendidikan' => $this->pendidikan,
            'tahun_terbit' => $this->tahun_terbit,
            'level_bahasa' => $this->level_bahasa,
            'sensei' => $this->sensei,
            'dokumen' => $this->dokumen,
            'penerjemah' => $this->penerjemah,
            'bidang_kerja_di_jepang' => $this->bidang_kerja_di_jepang,
            'bidang_kerja_pilihan' => $this->bidang_kerja_pilihan,
            'senmongkyu' => $this->senmongkyu,
            'bidang_senmongkyu' => $this->bidang_senmongkyu,
            'jenis_visa' => $this->jenis_visa,
            'nama_tiktok' => $this->nama_tiktok,
            'nama_instagram' => $this->nama_instagram,
            'no_telp_indonesia' => $this->no_telp_indonesia,
            'no_telp_jepang' => $this->no_telp_jepang,
            'email' => $this->email,
            'provinsi' => $this->provinsi,
            'kota' => $this->kota,
            'available' => $this->available,
        ]);
    }

    public function render()
    {
        return view('livewire.exata.exata.filter');
    }
}
