<?php

namespace App\Livewire\Exata\ExataPreviewCandidate;

use App\Helpers\Alert;
use App\Helpers\PermissionHelper;
use App\Models\Exata\Exata;
use App\Repositories\Account\UserRepository;
use App\Repositories\Exata\ExataPreviewCandidateRepository;
use App\Repositories\Exata\ExataRepository;
use App\Traits\WithDatatable;
use Carbon\Carbon;
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


    // Toggle Column
    public $hideColumns = [];
    public $kunciKolom = false;

    public $objId;
    public $poin_rekomendasi;
    public $KodeUnik;
    public $TanggalLahir;
    public $Gender;
    public $Pendidikan;
    public $LevelBahasa;
    public $LamaDiJepang;
    public $EstimasiGaji;
    public $Domisili;
    public $Penempatankerja;
    public $TglSiapkerja;
    public $BidangKerjadiJepang;
    public $BidangKerjaPilihan;
    public $Sensei;
    public $Dokumen;
    public $Penerjemah;
    public $SoftSkill;
    public $SkillKomputer;
    public $Keterangan;

    public $Domisili_old = [];
    public $Penempatankerja_old = [];
    public $BidangKerjaPilihan_old = [];

    public function onMount()
    {
        $authUser = UserRepository::authenticatedUser();

        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA_PREVIEW_CANDIDATE, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_EXATA_PREVIEW_CANDIDATE, PermissionHelper::TYPE_DELETE));
    }


    public function hideColumn($index)
    {
        if (!$this->kunciKolom) {
            $this->hideColumns[] = $index;
        }
    }

    public function showAllColumns()
    {
        if (!$this->kunciKolom) {
            $this->hideColumns = [];
        }
    }

    public function toggleKunciKolom()
    {
        $this->kunciKolom = !$this->kunciKolom;
    }

    #[On('export')]
    public function export($type)
    {
        return redirect()->route(
            'exata_preview_candidate.create',
            ['sortBy' => $this->sortBy, 'sortDirection' => $this->sortDirection]
        );
    }


    public function selectDomisili($data)
    {
        $this->Domisili = $data['id'];
    }
    public function unSelectDomisili($data)
    {
        $index = array_search($data['id'], $this->Domisili);
        if ($index !== false) {
            unset($this->Domisili[$index]);
        }
    }

    public function selectPenempatankerja($data)
    {
        $this->Penempatankerja = $data['id'];
    }
    public function unSelectPenempatankerja($data)
    {
        $index = array_search($data['id'], $this->Penempatankerja);
        if ($index !== false) {
            unset($this->Penempatankerja[$index]);
        }
    }

    public function selectBidangKerjaPilihan($data)
    {;
        $this->BidangKerjaPilihan[] = $data['id'];
    }
    public function unSelectBidangKerjaPilihan($data)
    {
        $index = array_search($data['id'], $this->BidangKerjaPilihan);
        if ($index !== false) {
            unset($this->BidangKerjaPilihan[$index]);
        }
    }

    public function addPreviewCandidate($id)
    {

        try {
            DB::transaction(function () use ($id) {
                $id = Crypt::decrypt($id);
                ExataPreviewCandidateRepository::delete($id);
            });
            DB::commit();

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

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete) {
            return;
        }

        DB::table('exata_preview_candidates')->truncate();
        DB::table('_history_exata_preview_candidates')->truncate();
        $this->dispatch('refresh-table');

        Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel() {}

    #[On('showDeleteDialog')]
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

    public function edit($id)
    {
        $this->objId = $id;
        $exata = ExataPreviewCandidateRepository::find(Crypt::decrypt($this->objId));
        $this->poin_rekomendasi = $exata->poin_rekomendasi;

        $this->KodeUnik = $exata->KodeUnik;
        $this->TanggalLahir = $exata->TanggalLahir;
        $this->Gender = $exata->Gender;
        $this->Pendidikan = $exata->Pendidikan;
        $this->LevelBahasa = $exata->LevelBahasa;
        $this->LamaDiJepang = $exata->LamaDiJepang;
        $this->EstimasiGaji = $exata->EstimasiGaji;
        $this->Domisili = $exata->Domisili;
        $this->Penempatankerja = $exata->Penempatankerja;
        $this->TglSiapkerja = $exata->TglSiapkerja;
        $this->BidangKerjadiJepang = $exata->BidangKerjadiJepang;

        $this->Sensei = $exata->Sensei == 'YA' ? true : false;
        $this->Dokumen = $exata->Dokumen == 'YA' ? true : false;
        $this->Penerjemah = $exata->Penerjemah == 'YA' ? true : false;
        $this->SoftSkill = $exata->SoftSkill;
        $this->SkillKomputer = $exata->SkillKomputer;
        $this->Keterangan = $exata->Keterangan;
        $pilihan = collect(Exata::FILTER_JOB_PILIHAN_INDO_CHOICE)
            ->filter(function ($label) use ($exata) {
                return str_contains($exata->BidangKerjaPilihan, $label);
            })
            ->keys()
            ->values()
            ->toArray();
        $this->BidangKerjaPilihan = $pilihan;

        $this->dispatch(
            'consoleLog',
            $this->BidangKerjaPilihan
        );
        $this->dispatch(
            'set-select2-BidangKerjaPilihan',
            $pilihan
        );
    }

    public function save()
    {
        try {
            DB::transaction(function () {

                $validateData = [
                    'TanggalLahir' => $this->TanggalLahir,
                    'Gender' => $this->Gender,
                    'Pendidikan' => $this->Pendidikan,
                    'LevelBahasa' => $this->LevelBahasa,
                    'LamaDiJepang' => $this->LamaDiJepang,
                    'EstimasiGaji' => $this->EstimasiGaji,
                    'Domisili' => $this->Domisili,
                    'Penempatankerja' => $this->Penempatankerja,
                    'TglSiapkerja' => $this->TglSiapkerja,
                    'BidangKerjadiJepang' => $this->BidangKerjadiJepang,
                    'BidangKerjaPilihan' => implode(',', $this->BidangKerjaPilihan),
                    'Sensei' => $this->Sensei ? 'YA' : 'TIDAK',
                    'Dokumen' => $this->Dokumen ? 'YA' : 'TIDAK',
                    'Penerjemah' => $this->Penerjemah ? 'YA' : 'TIDAK',
                    'SoftSkill' => $this->SoftSkill,
                    'SkillKomputer' => $this->SkillKomputer,
                    'Keterangan' => $this->Keterangan,
                    'poin_rekomendasi' => $this->poin_rekomendasi
                ];
                $id = Crypt::decrypt($this->objId);

                ExataPreviewCandidateRepository::update($id, $validateData);
            });
            DB::commit();
            $this->dispatch('onSuccessEdit');
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil disimpan",
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

    #[On('refresh-table')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    public function getColumns(): array
    {
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
                    $id = Crypt::encrypt($item->exata_id);
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

                    $id = Crypt::encrypt($item->id);
                    $editHtml = "
                        <div class='col-auto mb-2'>
                            <button
                                class='btn btn-warning btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#editModal'
                                wire:click=\"edit('" . $id . "')\"
                            >
                                <i class='ki-duotone ki-pencil'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Edit
                            </button>
                        </div>
                        ";
                    $btn_preview = $item->exataPreviewCandidate ? 'btn-primary' : 'btn-success';
                    $addPreviewHtml = "
                        <div class='col-auto mb-2'>
                            <button class='btn " . $btn_preview . " btn-sm mx-0 px-1' 
                                wire:click=\"addPreviewCandidate('$id')\"
                            >
                                <i class='ki-duotone ki-like-tag fs-3'>
                                <span class='path1'></span>
                                <span class='path2'></span>
                                </i>
                            </button>
                        </div>
                        ";

                    $html = "<div class='row d-flex justify-content-start flex-nowrap gap-0'>
                        $editHtml $linkHtml $addPreviewHtml
                    </div>";

                    return $html;
                },
            ];
        }

        $columns[] = [
            'key' => 'poin_rekomendasi',
            'name' => 'Point of Recommendation',
        ];

        $authUser = UserRepository::authenticatedUser();
        foreach (Exata::EXATA_DATATABLE_PREVIEW_CHOICE() as $key => $access) {
            if ($authUser->hasPermissionTo("exata_" . $key . ".read")) {
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
        return $columns;
    }

    public function getQuery(): Builder
    {
        return ExataPreviewCandidateRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.exata.exata-preview-candidate.datatable';
    }
}
