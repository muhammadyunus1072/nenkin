<?php

namespace App\Livewire\VehicleManagement\VehicleUsage;

use App\Helpers\Alert;
use App\Helpers\ExportHelper;
use App\Helpers\PermissionHelper;
use App\Repositories\Account\UserRepository;
use App\Repositories\VehicleManagement\VehicleRepository;
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

    public function onMount()
    {
        $authUser = UserRepository::authenticatedUser();
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_USER, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_USER, PermissionHelper::TYPE_DELETE));
    }

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete || $this->targetDeleteId == null) {
            return;
        }

        VehicleRepository::delete($this->targetDeleteId);
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

    #[On('refresh-table')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    #[On('export')]
    public function export($type)
    {
        $fileName = "Data Nenkin";
        return ExportHelper::export(
            $type,
            $fileName,
            $this->getQuery()->get()->toArray(),
            'app.convert-data-ichijikin.export',
            [
                'title' => 'Data Nenkin',
                'type' => $type,
            ],
            [
                'size' => 'legal',
                'orientation' => 'landscape',
            ]
        );
    }

    public function getColumns(): array
    {
        return [
            [
                'name' => 'Action',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {
                    $editHtml = "";

                    $id = Crypt::encrypt($item->id);
                    if ($this->isCanUpdate) {
                        $editUrl = route('vehicle.edit', $id);
                        $editHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-primary btn-sm' href='$editUrl'>
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
                                wire:click=\"showDeleteDialog($item->id)\">
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
                'key' => 'image',
                'name' => 'Foto Kendaraan',
                'render' => function ($item) {
                    $url = Storage::url($item->image);
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'>";
                }
            ],
            [
                'key' => 'name',
                'name' => 'Nama Kendaraan',
            ],
            [
                'key' => 'number_plate',
                'name' => 'Plat Nomor',
            ],
            [
                'key' => 'max_range',
                'name' => 'Jarak Tempuh Maksimal (Km)',
                'render' => function ($item) {
                    return number_format($item->max_range, 0, ',', '.') . " Km";
                }
            ],
            [
                'key' => 'initial_odometer',
                'name' => 'Odometer Awal (Km)',
                'render' => function ($item) {
                    return number_format($item->initial_odometer, 0, ',', '.') . " Km";
                }
            ],
            [
                'key' => 'is_active',
                'name' => 'Penanda Aktif',
                'render' => function ($item) {
                    return $item->is_active ? 'Aktif' : 'Tidak Aktif';
                }
            ],
            [
                'searchable' => false,
                'sortable' => false,
                'name' => 'Maintance',
                'render' => function ($item) {
                    $html = '<ul class="list-group list-group-flush">';
                    foreach ($item->vehicleServices as $service) {
                        $html .= "<li class='list-group-item'>$service->name Setiap $service->maintenance_interval Km, Saat ini $service->current_interval Km</li>";
                    }

                    $html .= '</ul>';
                    return $html;
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return VehicleRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.vehicle-management.vehicle-usage.datatable';
    }
}
