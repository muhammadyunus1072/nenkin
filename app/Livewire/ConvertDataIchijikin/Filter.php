<?php

namespace App\Livewire\ConvertDataIchijikin;

use App\Helpers\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use ZipArchive;
use Illuminate\Support\Facades\File;


class Filter extends Component
{
    public $end_date;
    public $start_date;
    public $filter_payor;

    public $payor_choice = [];

    public function mount() {}


    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        DB::table('convert_data_ichijikins')->truncate();
        DB::table('_history_convert_data_ichijikins')->truncate();
        Storage::disk('public')->deleteDirectory('convert_data_ichijikin');
        Storage::disk('public')->deleteDirectory('convert_data_ichijikin');
        $this->dispatch('refresh-table');
        // Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel() {}

    public function downloadLabeled()
    {
        $folderPath = storage_path('app/public/convert-data-ichijikin-labeled');
        $zipPath = storage_path('app/public/convert-data-ichijikin-labeled.zip');

        // Hapus zip lama kalau ada
        if (File::exists($zipPath)) {
            File::delete($zipPath);
        }

        $zip = new ZipArchive;

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

            $files = File::files($folderPath);

            foreach ($files as $file) {
                $zip->addFile($file->getRealPath(), $file->getFilename());
            }

            $zip->close();
        }
        return redirect(asset('storage/convert-data-ichijikin-labeled.zip'));
    }

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

    public function render()
    {
        return view('livewire.convert-data-ichijikin.filter');
    }
}
