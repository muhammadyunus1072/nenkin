<?php

namespace App\Livewire\Exata\ExataHistoryFilePreview;

use App\Helpers\Alert;
use App\Helpers\FilePathHelper;
use App\Repositories\Exata\HistoryFilePreviewRepository;
use App\Repositories\MasterData\Regency\RegencyRepository;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $objId;

    public $description;
    public $file;

    public function mount()
    {
        if ($this->objId) {
            $regency = HistoryFilePreviewRepository::find(Crypt::decrypt($this->objId));
            $this->description = $regency->description;
        }
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('exata_history_file_preview.edit', $this->objId);
        } else {
            $this->redirectRoute('exata_history_file_preview.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('exata_history_file_preview.index');
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                // Vehicle
                $validateData = [
                    'description' => $this->description,
                ];
                if ($this->file) {
                    $storedName = Str::uuid() . '.' . $this->file->extension();

                    $filePath = FilePathHelper::FILE_HISTORY_FILE_PREVIEW;
                    $path = $this->file->storeAs(
                        $filePath,
                        $storedName,
                        'private'
                    );
                    $validateData = array_merge($validateData, [
                        'path' => $path,
                        'stored_name' => $storedName,
                        'original_name' => $this->file->getClientOriginalName(),
                    ]);
                }
                if ($this->objId) {
                    $regency_id = Crypt::decrypt($this->objId);
                    HistoryFilePreviewRepository::update($regency_id, $validateData);
                } else {
                    $vehicle = HistoryFilePreviewRepository::create($validateData);
                    $vehicle_id = $vehicle->id;
                }
            });


            DB::commit();
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
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.exata.exata-history-file-preview.detail');
    }
}
