<?php

namespace App\Livewire\Exata\ExataFormCandidate;

use App\Helpers\Alert;
use App\Helpers\PermissionHelper;
use App\Repositories\Account\UserRepository;
use App\Repositories\Exata\ExataFormCandidateRepository;
use App\Traits\WithDatatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
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
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA_FORM_CANDIDATE, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA_FORM_CANDIDATE, PermissionHelper::TYPE_DELETE));
    }

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete || $this->targetDeleteId == null) {
            return;
        }

        ExataFormCandidateRepository::delete($this->targetDeleteId);
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
                        $editUrl = route('exata_form_candidate.edit', $id);
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
                'key' => 'expired_at',
                'name' => 'Expired Pada'
            ],
            [
                'key' => 'password',
                'name' => 'Password'
            ],
            [
                'key' => 'status',
                'name' => 'Status'
            ],
            [
                'sortable' => false,
                'searcable' => false,
                'name' => 'Kode Unik Kandidat',
                'render' => function ($item) {
                    return $item->exata ? $item->exata->KodeUnik : '-';
                }
            ],

            [
                'sortable' => false,
                'searcable' => false,
                'name' => 'Link',
                'render' => function ($item) {
                    $link = route('exata_form_candidate.form', Crypt::encrypt($item->id));
                    $linkHtml = "

                        <div class='col-auto mb-2'>
                            <p
                                class='form-control'
                                onclick=\"copyToClipboard('$link')\"
                            >" . $link . "</p>
                        </div>
                        <div class='col-auto mb-2'>
                            <button
                                class='btn btn-success btn-sm'
                                onclick=\"copyToClipboard('$link')\"
                            >
                                <i class='ki-duotone ki-archive-tick fs-3'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Link
                            </button>
                        </div>
                        
                        ";
                    return $linkHtml;
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return ExataFormCandidateRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.master-data.regency.datatable';
    }
}
