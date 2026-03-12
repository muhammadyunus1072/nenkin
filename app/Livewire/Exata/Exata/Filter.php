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

    public $nama_lengkap;
    public $no_whatsapp;
    public $estimasi_gaji;
    public $domisili;
    public $penempatan_kerja;
    public $nama_lpk;
    public $instagram;
    public $tiktok;
    public $keterangan;

    public $date_type;
    public $start_date;
    public $end_date;
    public $pipeline;
    public $gender;
    public $pendidikan;
    public $level_bahasa;
    public $job;
    public $bidang_kerja_japan;
    public $pilihan_kerja_indonesia;
    public $pic_sales;
    public $jenis_visa;


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
            'nama_lengkap' => $this->nama_lengkap,
            'no_whatsapp' => $this->no_whatsapp,
            'estimasi_gaji' => $this->estimasi_gaji,
            'domisili' => $this->domisili,
            'penempatan_kerja' => $this->penempatan_kerja,
            'nama_lpk' => $this->nama_lpk,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'keterangan' => $this->keterangan,
            'date_type' => $this->date_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'pipeline' => $this->pipeline,
            'gender' => $this->gender,
            'pendidikan' => $this->pendidikan,
            'level_bahasa' => $this->level_bahasa,
            'job' => $this->job,
            'bidang_kerja_japan' => $this->bidang_kerja_japan,
            'pilihan_kerja_indonesia' => $this->pilihan_kerja_indonesia,
            'pic_sales' => $this->pic_sales,
            'jenis_visa' => $this->jenis_visa,
        ]);
    }

    public function render()
    {
        return view('livewire.exata.exata.filter');
    }
}
