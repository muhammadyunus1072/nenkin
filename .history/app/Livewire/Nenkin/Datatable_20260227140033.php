<?php

namespace App\Livewire\Nenkin;

use App\Helpers\Alert;
use App\Models\MasterData\PaymentMethod;
use App\Permissions\AccessMasterData;
use App\Permissions\PermissionHelper;
use App\Repositories\Account\UserRepository;
use App\Repositories\MasterData\PaymentMethod\PaymentMethodRepository;
use App\Repositories\Nenkin\NenkinRepository;
use App\Traits\WithDatatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Datatable extends Component
{
    use WithDatatable;

    public $isCanUpdate;
    public $isCanDelete;
    public $isCanUpdateBookingTime;
    public $isCanUpdateDetail;

    // Delete Dialog
    public $targetDeleteId;

    public function onMount() {}

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete || $this->targetDeleteId == null) {
            return;
        }

        NenkinRepository::delete(Crypt::decrypt($this->targetDeleteId));
        Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel()
    {
        $this->targetDeleteId = null;
    }

    public function showDeleteDialog($id)
    {
        $this->targetDeleteId = $id;

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

    public function getColumns(): array
    {
        return [
            [
                'name' => 'Aksi',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $editHtml = "";
                    $id = Crypt::encrypt($item->id);
                    if ($this->isCanUpdate) {
                        $editHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-primary btn-sm' href=''>
                                <i class='ki-duotone ki-notepad-edit fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Ubah
                            </a>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($this->isCanDelete) {
                        $destroyHtml = "<div class='col-auto mb-2'>
                            <button class='btn btn-danger btn-sm m-0' 
                                wire:click=\"showDeleteDialog('$id')\">
                                <i class='ki-duotone ki-trash fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                                Hapus
                            </button>
                        </div>";
                    }


                    $html = "<div class='row'>
                        $editHtml $destroyHtml 
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'date',
                'name' => 'Tanggal',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/date.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->date;
                }
            ],
            [
                'key' => 'payment_top',
                'name' => 'Pembayaran',
            ],
            [
                'key' => 'payment',
                'name' => 'Pembayaran 100%',
            ],
            [
                'key' => 'income',
                'name' => 'Pembayaran 20%',
            ],
            [
                'key' => 'net',
                'name' => 'Pembayaran 80%',
            ],
            [
                'key' => 'number',
                'name' => 'Nomor Nenkin',
            ],
            [
                'key' => 'name',
                'name' => 'Nama',
            ],
            [
                'key' => 'address',
                'name' => 'Alamat',
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return NenkinRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.nenkin.datatable';
    }
}
