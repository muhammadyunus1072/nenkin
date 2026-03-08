<?php

namespace App\Livewire\Exata\Exata;

use App\Helpers\Alert;
use App\Helpers\ExportHelper;
use App\Helpers\PermissionHelper;
use App\Repositories\Account\RoleRepository;
use App\Repositories\Account\UserRepository;
use App\Repositories\Exata\ExataRepository;
use App\Traits\WithDatatable;
use Illuminate\Database\Eloquent\Builder;
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

        ExataRepository::delete($this->targetDeleteId);
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
        $authUser = UserRepository::authenticatedUser();
        $role = $authUser->roles;

        $role = RoleRepository::find($role[0]->id);

        $columns = [
            [
                'sortable' => false,
                'searchable' => false,
                'name' => '#',
                'render' => function ($item, $index) {
                    $i = $index + 1;
                    return $i;
                }
            ]
        ];
        foreach ($role->permissions as $rolePermission) {
            if (str_starts_with($rolePermission->name, 'exata_')) {
                $name = explode('.', $rolePermission->name);
                $name = str_replace('exata_', '', $name[0]);
                $columns[] = [
                    'key' => $name,
                    'name' => $name,
                ];
            }
        }
        return $columns;
    }

    public function getQuery(): Builder
    {
        return ExataRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.exata.exata.datatable';
    }
}
