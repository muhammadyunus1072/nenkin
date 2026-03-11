<?php

namespace App\Livewire\Exata\Exata;

use App\Helpers\Alert;
use App\Helpers\ExportHelper;
use App\Helpers\PermissionHelper;
use App\Models\Exata\Exata;
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
        $fileName = "Data Exata";
        return ExportHelper::export(
            $type,
            $fileName,
            $this->getQuery()->get()->toArray(),
            'app.exata.exata.export',
            [
                'title' => 'Data Exata',
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
        // $role = $authUser->roles;

        // $role = RoleRepository::find($role[0]->id);

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
        foreach (Exata::EXATA_DATATABLE_CHOICE as $key => $access) {
            if ($authUser->hasPermissionTo("exata_" . $key . ".read")) {
                $columns[] = [
                    'key' => str_replace('DATATABLE_', '', $key),
                    'name' => $access,
                ];
            }
        }
        return $columns;
    }

    public function getQuery(): Builder
    {
        return ExataRepository::datatable(
            $this->nama_lengkap,
            $this->no_whatsapp,
            $this->estimasi_gaji,
            $this->domisili,
            $this->penempatan_kerja,
            $this->nama_lpk,
            $this->instagram,
            $this->tiktok,
            $this->keterangan,
            $this->date_type,
            $this->start_date,
            $this->end_date,
            $this->pipeline,
            $this->gender,
            $this->pendidikan,
            $this->level_bahasa,
            $this->job,
            $this->bidang_kerja_japan,
            $this->pilihan_kerja_indonesia,
            $this->pic_sales,
        );
    }

    public function getView(): string
    {
        return 'livewire.exata.exata.datatable';
    }
}
