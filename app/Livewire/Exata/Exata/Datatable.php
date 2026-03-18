<?php

namespace App\Livewire\Exata\Exata;

use App\Helpers\Alert;
use App\Helpers\ExportHelper;
use App\Helpers\PermissionHelper;
use App\Models\Exata\Exata;
use App\Repositories\Account\UserRepository;
use App\Repositories\Exata\ExataRepository;
use App\Traits\WithDatatable;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
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
    public $estimasi_gaji_top;
    public $domisili = [];
    public $preferensi_lokasi = [];
    public $nama_lpk;
    public $instagram;
    public $tiktok;
    public $keterangan;
    public $date_type;
    public $start_date;
    public $end_date;
    public $pipeline = [];
    public $gender = [];
    public $pendidikan = [];
    public $level_bahasa = [];
    public $job_sensei;
    public $job_staff_dokumen;
    public $job_penerjemah;
    public $bidang_kerja_japan;
    public $pilihan_kerja_indonesia = [];
    public $pic_sales = [];
    public $jenis_visa = [];

    // Delete Dialog
    public $targetDeleteId;

    public function onMount()
    {
        $authUser = UserRepository::authenticatedUser();

        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA, PermissionHelper::TYPE_DELETE));
    }

    #[On('on-delete-datatable-confirm')]
    public function onDialogDeleteConfirm()
    {

        try {
            DB::transaction(function () {

                $this->getQuery()->delete();
            });


            DB::commit();

            $this->dispatch('onSuccessEditBulk');

            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Dihapus",
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

    #[On('reset-filter')]
    public function resetFilter()
    {
        $this->reset(
            'nama_lengkap',
            'no_whatsapp',
            'estimasi_gaji',
            'estimasi_gaji_top',
            'domisili',
            'preferensi_lokasi',
            'nama_lpk',
            'instagram',
            'tiktok',
            'keterangan',
            'date_type',
            'start_date',
            'end_date',
            'pipeline',
            'gender',
            'pendidikan',
            'level_bahasa',
            'job_sensei',
            'job_staff_dokumen',
            'job_penerjemah',
            'bidang_kerja_japan',
            'pilihan_kerja_indonesia',
            'pic_sales',
            'jenis_visa',
        );
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel()
    {
        $this->targetDeleteId = null;
    }

    #[On('saveBulk')]
    public function saveBulk($editBulk)
    {
        try {
            DB::transaction(function () use ($editBulk) {
                // Vehicle
                $validateData = [
                    'Pipeline' => $editBulk['Pipeline'],
                    'Available' => $editBulk['Available'],
                    'Kategori' => $editBulk['Kategori'],
                    'Keterangan' => $editBulk['Keterangan'],
                ];
                $this->getQuery()->update($validateData);
            });


            DB::commit();

            $this->dispatch('onSuccessEditBulk');

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
        $fileName = "Data Kandidat";
        return ExportHelper::export(
            $type,
            $fileName,
            $this->getQuery()->get()->toArray(),
            'app.exata.exata.export',
            [
                'title' => 'Data Kandidat',
                'type' => $type,
            ],
            [
                'size' => 'legal',
                'orientation' => 'landscape',
            ]
        );
    }

    #[On('export-preview')]
    public function exportPreview($type)
    {
        $fileName = "Preview Kandidat";
        return ExportHelper::export(
            $type,
            $fileName,
            $this->getQuery()->get()->toArray(),
            'app.exata.exata.export-preview',
            [
                'title' => 'Preview Kandidat',
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
        if ($this->isCanUpdate) {
            $columns[] = [
                'name' => 'Action',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {
                    $editHtml = "";

                    $id = Crypt::encrypt($item->id);

                    $editHtml = "
                        <div class='col-auto mb-2'>
                            <button 
                                class='btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#editModal'
                                x-data
                                @click=\"\$dispatch('editData', { id: '" . $id . "' })\"
                            >
                                <i class='ki-duotone ki-notepad-edit fs-3'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Ubah
                            </button>
                        </div>
                        ";
                    $routeLink = route('exata.edit', $id);
                    $linkHtml = "
                        <div class='col-auto mb-2'>
                            <button
                                class='btn btn-success btn-sm'
                                onclick=\"copyToClipboard('$routeLink')\"
                            >
                                <i class='ki-duotone ki-archive-tick fs-3'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Link
                            </button>
                        </div>
                        ";

                    $html = "<div class='row d-flex justify-content-start flex-nowrap gap-0'>
                        $editHtml $linkHtml
                    </div>";

                    return $html;
                },
            ];
        }
        foreach (Exata::EXATA_DATATABLE_CHOICE() as $key => $access) {
            if ($authUser->hasPermissionTo("exata_" . $key . ".read")) {
                if ($access['name'] == 'Estimasi Gaji') {
                    $columns[] = [
                        'key' => str_replace('DATATABLE_', '', $key),
                        'name' => $access['name'],
                        'render' => function ($item) {
                            return $item->EstimasiGaji . ($item->EstimasiGajiTop ? '-' . $item->EstimasiGajiTop : '');
                        },
                        'class' => isset($access['class']) ? $access['class'] : ''
                    ];
                } else if ($access['name'] == 'Bidang Kerja Pilihan') {
                    $columns[] = [
                        'key' => str_replace('DATATABLE_', '', $key),
                        'name' => $access['name'],
                        'render' => function ($item) {
                            $array = explode(',', $item->BidangKerjaPilihan);

                            $chunks = array_chunk($array, 3);

                            $result = array_map(function ($chunk) {
                                return implode(', ', $chunk);
                            }, $chunks);

                            return implode(',<br>', $result);
                        },
                        'class' => isset($access['class']) ? $access['class'] : ''
                    ];
                } else {

                    $columns[] = [
                        'key' => str_replace('DATATABLE_', '', $key),
                        'name' => $access['name'],
                        'class' => isset($access['class']) ? $access['class'] : '',
                        'render' => isset($access['render']) ? $access['render'] : '',
                        'sortable' => isset($access['sortable']) ? $access['sortable'] : true,
                        'searchable' => isset($access['searchable']) ? $access['sortable'] : true
                    ];
                }
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
            $this->estimasi_gaji_top,
            $this->domisili,
            $this->preferensi_lokasi,
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
            $this->job_sensei,
            $this->job_staff_dokumen,
            $this->job_penerjemah,
            $this->bidang_kerja_japan,
            $this->pilihan_kerja_indonesia,
            $this->pic_sales,
            $this->jenis_visa,
        );
    }

    public function getView(): string
    {
        return 'livewire.exata.exata.datatable';
    }
}
