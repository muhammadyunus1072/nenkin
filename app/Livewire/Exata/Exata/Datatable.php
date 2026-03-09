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

    public $no;
    public $tgl_input;
    public $habis_kontrak;
    public $kembali_ke_jepang;
    public $nama_lengkap;
    public $tgl_pulang;
    public $pic;
    public $nama_lpk;
    public $lama_di_jepang;
    public $referensi_kerja;
    public $jenis_kelamin;
    public $pendidikan;
    public $tahun_terbit;
    public $level_bahasa;
    public $sensei;
    public $dokumen;
    public $penerjemah;
    public $bidang_kerja_di_jepang;
    public $bidang_kerja_pilihan;
    public $senmongkyu;
    public $bidang_senmongkyu;
    public $jenis_visa;
    public $nama_tiktok;
    public $nama_instagram;
    public $no_telp_indonesia;
    public $no_telp_jepang;
    public $email;
    public $provinsi;
    public $kota;
    public $available;

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
        $data = [
            'no',
            'tgl_input',
            'habis_kontrak',
            'kembali_ke_jepang',
            'nama_lengkap',
            'tgl_pulang',
            'pic',
            'nama_lpk',
            'lama_di_jepang',
            'referensi_kerja',
            'jenis_kelamin',
            'pendidikan',
            'tahun_terbit',
            'level_bahasa',
            'sensei',
            'dokumen',
            'penerjemah',
            'bidang_kerja_di_jepang',
            'bidang_kerja_pilihan',
            'senmongkyu',
            'bidang_senmongkyu',
            'jenis_visa',
            'nama_tiktok',
            'nama_instagram',
            'no_telp_indonesia',
            'no_telp_jepang',
            'email',
            'provinsi',
            'kota',
        ];

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
        foreach ($data as $access) {
            if ($authUser->hasPermissionTo("exata_" . $access . ".read")) {
                $columns[] = [
                    'key' => $access,
                    'name' => $access,
                ];
            }
        }
        $columns[] = [
            'key' => 'available',
            'name' => 'available',
            'render' => function ($item) {
                return $item->available ? 'Ya' : 'Tidak';
            }
        ];
        return $columns;
    }

    public function getQuery(): Builder
    {
        return ExataRepository::datatable(
            $this->no,
            $this->tgl_input,
            $this->habis_kontrak,
            $this->kembali_ke_jepang,
            $this->nama_lengkap,
            $this->tgl_pulang,
            $this->pic,
            $this->nama_lpk,
            $this->lama_di_jepang,
            $this->referensi_kerja,
            $this->jenis_kelamin,
            $this->pendidikan,
            $this->tahun_terbit,
            $this->level_bahasa,
            $this->sensei,
            $this->dokumen,
            $this->penerjemah,
            $this->bidang_kerja_di_jepang,
            $this->bidang_kerja_pilihan,
            $this->senmongkyu,
            $this->bidang_senmongkyu,
            $this->jenis_visa,
            $this->nama_tiktok,
            $this->nama_instagram,
            $this->no_telp_indonesia,
            $this->no_telp_jepang,
            $this->email,
            $this->provinsi,
            $this->kota,
            $this->available,
        );
    }

    public function getView(): string
    {
        return 'livewire.exata.exata.datatable';
    }
}
