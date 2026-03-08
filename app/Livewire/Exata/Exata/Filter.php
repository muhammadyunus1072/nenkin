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

    public $payor_choice = [];

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

    public function render()
    {
        return view('livewire.exata.exata.filter');
    }
}
