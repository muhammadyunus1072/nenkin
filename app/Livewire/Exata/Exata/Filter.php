<?php

namespace App\Livewire\Exata\Exata;

use App\Helpers\Alert;
use App\Imports\ExcelImportExata;
use App\Imports\ExcelImportExataPreview;
use App\Models\Exata\Exata;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


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

    // Import
    public $previewRows;
    public $errorRows = [];


    public function mount() {}

    public function showDeleteDialog()
    {
        Alert::confirmation(
            $this,
            Alert::ICON_QUESTION,
            "Hapus Data",
            "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
            "on-delete-dialog-confirm",
            "on-delete-dialog-cancel",
            "Hapus",
            "Batal",
        );
    }

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        DB::table('exatas')->truncate();
        DB::table('_history_exatas')->truncate();
        $this->dispatch('refresh-table');
        // Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel() {}

    public function updatedInputFile()
    {
        $import = new ExcelImportExataPreview();

        Excel::import($import, $this->inputFile);

        $this->previewRows = [];
        $this->errorRows = [];

        $data_import = [];
        foreach (Exata::EXATA_DATATABLE_CHOICE as $key => $value) {
            if (!isset($value['isNotImport'])) {
                $data_import[] = [
                    $value['name'] => [
                        'render' => function ($item) use ($value) {
                            return ($value['isDate']) ? (strtoupper(preg_replace('/\s+/u', '', trim($item))) ? strtoupper(preg_replace('/\s+/u', '', trim($item))) : null) : strtoupper($item);
                        }
                    ]
                ];
            }
        }
        $val = [];
        foreach (Exata::EXATA_DATATABLE_CHOICE as $key => $value) {
            if (!isset($value['isNotImport'])) {
                $val[$value['name']] =  $value['isDate'] ? 'nullable|date' : '';
            }
        }
        foreach ($import->rows as $index => $row) {

            $d = [];

            foreach ($data_import as $indexData => $value) {
                foreach ($value as $keyName => $v) {
                    $d[$keyName] = call_user_func($v['render'], $row[$indexData]);
                }
            }

            $estimasi_gaji = explode('-', preg_replace('/[^0-9\-]/', '', $d['Estimasi Gaji']));
            $d['Estimasi Gaji'] = $estimasi_gaji[0];
            $d['Estimasi Gaji Top'] = isset($estimasi_gaji[1]) ? $estimasi_gaji[1] : null;

            $validator = Validator::make($d, $val, [
                'date' => 'Format Tanggal Tidak Sesuai'
            ]);

            $this->previewRows[] = [
                'data' => $d,
                'error' => $validator->errors()->toArray()
            ];

            if ($validator->fails()) {
                $this->errorRows[] = $index;
            }
        }
    }

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
            'item' => $this->domisili,
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
