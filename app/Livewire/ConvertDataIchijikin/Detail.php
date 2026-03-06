<?php

namespace App\Livewire\ConvertDataIchijikin;

use App\Helpers\Alert;
use App\Repositories\ConvertDataIchijikin\ConvertDataIchijikinRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $objId;

    public $images = [];

    public function mount()
    {
        if ($this->objId) {
        }
    }


    public function store()
    {
        try {
            DB::transaction(function () {
                foreach ($this->images as $image) {
                    $folder = 'convert-data-ichijikin/' . Str::uuid();
                    $path = $image->store($folder, 'public');

                    ConvertDataIchijikinRepository::create([
                        'image' => $path
                    ]);
                }
            });

            $this->reset(['images']);

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
        return view('livewire.convert-data-ichijikin.detail');
    }
}
