<?php

namespace App\Livewire\Exata\Exata;

use App\Helpers\Alert;
use App\Imports\ExcelImportExataPreview;
use App\Models\Exata\Exata;
use App\Repositories\Exata\ExataCurriculumVitaeRepository;
use App\Repositories\Exata\ExataJapaneseLanguageCertificateRepository;
use App\Repositories\Exata\ExataRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Filter extends Component
{
    use WithFileUploads;

    public $inputFile;

    public $nama_lengkap;
    public $no_whatsapp;
    public $estimasi_gaji;
    public $estimasi_gaji_top;
    public $domisili = [];
    public $preferensi_lokasi;
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

    // Import
    public $previewRows;
    public $errorRows = [];

    // Edit Manual
    public $edit_detail = [];

    // Edit Bulk
    public $edit_bulk = [
        'Pipeline' => '',
        'Available' => '',
        'Kategori' => '',
        'Keterangan' => '',
    ];

    public $candidate_attachments = [];


    public function mount() {}

    public function showDeleteDialog()
    {
        Alert::confirmation(
            $this,
            Alert::ICON_QUESTION,
            "Hapus Data",
            "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
            "on-delete-datatable-confirm",
            "on-delete-datatable-cancel",
            "Hapus",
            "Batal",
        );
    }

    // #[On('on-delete-dialog-confirm')]
    // public function onDialogDeleteConfirm()
    // {
    //     DB::table('exatas')->truncate();
    //     DB::table('_history_exatas')->truncate();
    //     $this->dispatch('refresh-table');
    //     // Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    // }

    // #[On('on-delete-dialog-cancel')]
    // public function onDialogDeleteCancel() {}

    #[On('showFileJapaneseLanguageCertificate')]
    public function showFileJapaneseLanguageCertificate($id)
    {
        $this->candidate_attachments = ExataJapaneseLanguageCertificateRepository::getBy([
            ['exata_id', Crypt::decrypt($id)]
        ])->toArray();
    }
    #[On('showFileCurriculumVitae')]
    public function showFileCurriculumVitae($id)
    {
        $this->candidate_attachments = ExataCurriculumVitaeRepository::getBy([
            ['exata_id', Crypt::decrypt($id)]
        ])->toArray();
    }

    #[On('editData')]
    public function editData($id)
    {
        $this->edit_detail = ExataRepository::find(Crypt::decrypt($id))->toArray();
    }

    public function editBulk()
    {
        $this->edit_bulk = [
            'Pipeline' => '',
            'Available' => '',
            'Kategori' => '',
            'Keterangan' => '',
        ];
    }

    public function saveBulk()
    {
        $this->dispatch('saveBulk', $this->edit_bulk);
    }

    public function save_edit()
    {
        try {
            DB::transaction(function () {
                // Vehicle
                $validateData = [
                    'Pipeline' => $this->edit_detail['Pipeline'],
                    'Available' => $this->edit_detail['Available'],
                    'Kategori' => $this->edit_detail['Kategori'],
                    'Keterangan' => $this->edit_detail['Keterangan'],
                ];
                ExataRepository::update($this->edit_detail['id'], $validateData);
            });


            DB::commit();

            $this->dispatch('onSuccessEditData');
            $this->edit_detail = [];
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

    public function updatedInputFile()
    {
        $import = new ExcelImportExataPreview();

        Excel::import($import, $this->inputFile);

        $this->previewRows = [];
        $this->errorRows = [];

        $data_import = [];
        foreach (Exata::EXATA_IMPORT_CHOICE() as $key => $value) {
            if (!isset($value['isNotImport'])) {
                $data_import[] = [
                    $value['name'] => [
                        'render' => function ($item) use ($value) {
                            return ($value['isDate']) ? (strtoupper(preg_replace('/\s+/u', '', trim($item))) ? strtoupper(preg_replace('/\s+/u', '', trim($item))) : null) : strtoupper($item);
                        }
                    ]
                ];
            }
        }
        $val = [];
        $valmessage = [];
        foreach (Exata::EXATA_IMPORT_CHOICE() as $key => $value) {
            if (!isset($value['isNotImport'])) {
                $val[$value['name']] =  $value['validator'] ?? '';
                $valmessage[$value['name']] =  $value['validator_message'] ?? '';
            }
        }
        foreach ($import->rows as $index => $row) {

            $d = [];

            foreach ($data_import as $indexData => $value) {
                foreach ($value as $keyName => $v) {
                    $d[$keyName] = call_user_func($v['render'], $row[$indexData]);
                }
            }

            $estimasi_gaji = explode('-', preg_replace('/[^0-9\-]/', '', $d['Estimasi Gaji']));
            $d['Estimasi Gaji'] = $estimasi_gaji[0];
            // $d['Estimasi Gaji Top'] = isset($estimasi_gaji[1]) ? $estimasi_gaji[1] : null;

            $validator = Validator::make($d, $val, $valmessage);

            $this->previewRows[] = [
                'data' => $d,
                'error' => $validator->errors()->toArray()
            ];

            if ($validator->fails()) {
                $this->errorRows[] = $index;
            }
        }
    }

    public function closeImportModal()
    {
        $this->reset('inputFile');
        $this->previewRows = [];
        $this->errorRows = [];
    }

    public function storeImport()
    {
        try {
            DB::beginTransaction();
            $path = $this->inputFile->getRealPath();
            foreach ($this->previewRows as $key => $value) {
                if (!$value['error']) {
                    $exata = ExataRepository::create($value['data']);
                }
            }
            unlink($path);
            DB::commit();

            $this->closeImportModal();
            $this->dispatch('onSuccessImportData');
            $this->dispatch('refresh-table');

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
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

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
        $this->dispatch('reset-select2');
        $this->dispatch('reset-filter');
    }

    public function selectDomisili($data)
    {
        $this->domisili[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'domisili' => $this->domisili,
        ]);
    }
    public function unSelectDomisili($data)
    {
        $index = array_search($data['id'], $this->domisili);
        if ($index !== false) {
            unset($this->domisili[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'domisili' => $this->domisili,
        ]);
    }

    public function selectPreferensiLokasi($data)
    {
        $this->preferensi_lokasi[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'preferensi_lokasi' => $this->preferensi_lokasi,
        ]);
    }
    public function unSelectPreferensiLokasi($data)
    {
        $index = array_search($data['id'], $this->preferensi_lokasi);
        if ($index !== false) {
            unset($this->preferensi_lokasi[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'preferensi_lokasi' => $this->preferensi_lokasi,
        ]);
    }

    public function selectPipeline($data)
    {
        $this->pipeline[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'pipeline' => $this->pipeline,
        ]);
    }
    public function unSelectPipeline($data)
    {
        $index = array_search($data['id'], $this->pipeline);
        if ($index !== false) {
            unset($this->pipeline[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'pipeline' => $this->pipeline,
        ]);
    }

    public function selectGender($data)
    {
        $this->gender[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'gender' => $this->gender,
        ]);
    }
    public function unSelectGender($data)
    {
        $index = array_search($data['id'], $this->gender);
        if ($index !== false) {
            unset($this->gender[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'gender' => $this->gender,
        ]);
    }

    public function selectPendidikan($data)
    {
        $this->pendidikan[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'pendidikan' => $this->pendidikan,
        ]);
    }
    public function unSelectPendidikan($data)
    {
        $index = array_search($data['id'], $this->pendidikan);
        if ($index !== false) {
            unset($this->pendidikan[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'pendidikan' => $this->pendidikan,
        ]);
    }

    public function selectLevelBahasa($data)
    {
        $this->level_bahasa[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'level_bahasa' => $this->level_bahasa,
        ]);
    }
    public function unSelectLevelBahasa($data)
    {
        $index = array_search($data['id'], $this->level_bahasa);
        if ($index !== false) {
            unset($this->level_bahasa[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'level_bahasa' => $this->level_bahasa,
        ]);
    }

    public function selectJob($data)
    {
        switch ($data['id']) {
            case Exata::FILTER_JOB_SENSEI:
                $this->job_sensei = 'YA';
                $this->dispatch('datatable-add-filter', [
                    'job_sensei' => 'YA',
                ]);
                break;
            case Exata::FILTER_JOB_STAFF_DOKUMEN:
                $this->job_staff_dokumen = 'YA';
                $this->dispatch('datatable-add-filter', [
                    'job_staff_dokumen' => $this->job_staff_dokumen,
                ]);
                break;
            case Exata::FILTER_JOB_PENERJEMAH:
                $this->job_penerjemah = 'YA';
                $this->dispatch('datatable-add-filter', [
                    'job_penerjemah' => $this->job_penerjemah,
                ]);
                break;
        }
    }
    public function unSelectJob($data)
    {
        switch ($data['id']) {
            case Exata::FILTER_JOB_SENSEI:
                $this->job_sensei = 'TIDAK';
                $this->dispatch('datatable-add-filter', [
                    'job_sensei' => $this->job_sensei,
                ]);
                break;
            case Exata::FILTER_JOB_STAFF_DOKUMEN:
                $this->job_staff_dokumen = 'TIDAK';
                $this->dispatch('datatable-add-filter', [
                    'job_staff_dokumen' => $this->job_staff_dokumen,
                ]);
                break;
            case Exata::FILTER_JOB_PENERJEMAH:
                $this->job_penerjemah = 'TIDAK';
                $this->dispatch('datatable-add-filter', [
                    'job_penerjemah' => $this->job_penerjemah,
                ]);
                break;
        }
    }

    public function selectPilihanKerjaIndonesia($data)
    {
        $this->pilihan_kerja_indonesia[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'pilihan_kerja_indonesia' => $this->pilihan_kerja_indonesia,
        ]);
    }
    public function unSelectPilihanKerjaIndonesia($data)
    {
        $index = array_search($data['id'], $this->pilihan_kerja_indonesia);
        if ($index !== false) {
            unset($this->pilihan_kerja_indonesia[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'pilihan_kerja_indonesia' => $this->pilihan_kerja_indonesia,
        ]);
    }

    public function selectPicSales($data)
    {
        $this->pic_sales[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'pic_sales' => $this->pic_sales,
        ]);
    }
    public function unSelectPicSales($data)
    {
        $index = array_search($data['id'], $this->pic_sales);
        if ($index !== false) {
            unset($this->pic_sales[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'pic_sales' => $this->pic_sales,
        ]);
    }

    public function selectJenisVisa($data)
    {
        $this->jenis_visa[] = $data['id'];

        $this->dispatch('datatable-add-filter', [
            'jenis_visa' => $this->jenis_visa,
        ]);
    }
    public function unSelectJenisVisa($data)
    {
        $index = array_search($data['id'], $this->jenis_visa);
        if ($index !== false) {
            unset($this->jenis_visa[$index]);
        }

        $this->dispatch('datatable-add-filter', [
            'jenis_visa' => $this->jenis_visa,
        ]);
    }

    public function updated()
    {
        $this->dispatch('datatable-add-filter', [
            'nama_lengkap' => $this->nama_lengkap,
            'no_whatsapp' => $this->no_whatsapp,
            'estimasi_gaji' => $this->estimasi_gaji,
            'estimasi_gaji_top' => $this->estimasi_gaji_top,
            'nama_lpk' => $this->nama_lpk,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'keterangan' => $this->keterangan,
            'date_type' => $this->date_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'bidang_kerja_japan' => $this->bidang_kerja_japan,
        ]);
    }

    public function render()
    {
        return view('livewire.exata.exata.filter');
    }
}
