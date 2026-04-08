<?php

namespace App\Livewire\Exata\ExataFormCandidate;

use App\Helpers\Alert;
use App\Helpers\FilePathHelper;
use App\Models\Exata\Exata;
use App\Models\Exata\ExataFormCandidate;
use App\Repositories\Exata\ExataCurriculumVitaeRepository;
use App\Repositories\Exata\ExataFormCandidateRepository;
use App\Repositories\Exata\ExataJapaneseLanguageCertificateRepository;
use App\Repositories\Exata\ExataRepository;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $objId;
    public $exata_id;

    public $candidate_profile;

    // Form J-Expert
    public $NamaLengkap;
    public $TanggalLahir;
    public $Gender;
    public $Pendidikan;
    public $LevelBahasa;
    public $TahunTerbit;
    public $LamaDiJepang;
    public $TanggalPulang;
    public $Sensei;
    public $Dokumen;
    public $Penerjemah;
    public $EstimasiGaji;
    public $Domisili;
    public $Penempatankerja;
    public $TglSiapkerja;
    public $BidangKerjadiJepang;
    public $BidangKerjaPilihan;
    public $Senmongkyu;
    public $BidangSenmongkyu;
    public $JenisVisa;
    public $Provinsi;
    public $Kota;
    public $NamaTikTok;
    public $NamaInstagram;
    public $NoTelpIndonesia;
    public $NoTelpJepang;
    public $Email;
    public $PICSales;
    public $NamaLPK;

    // Form Input
    public $sertifikat_bahasa_jepang = [];
    public $cv = [];
    public $sertifikat_bahasa_jepang_old = [];
    public $cv_old = [];
    public $sertifikat_bahasa_jepang_removes = [];
    public $cv_removes = [];
    public $tinggi_badan;
    public $berat_badan;
    public $skill_bahasa_lain;
    public $skill_komputer;
    public $pencapaian_tertinggi;
    public $value_saat_di_jepang;
    public $soft_skill;
    public $skill_lainnya;
    public $pengalaman_kerja;

    public $password;
    public $input_password;
    public $max_attempts = 3;
    public $authorized = false;

    public function mount()
    {
        try {
            $form_id = Crypt::decrypt($this->objId);
            $form = ExataFormCandidateRepository::find($form_id);
            if (!$form) {
                abort(404, 'Form Tidak Tersedia');
            }
            if ($form->expired_at && now()->greaterThan($form->expired_at)) {
                ExataFormCandidateRepository::update(
                    Crypt::decrypt($this->objId),
                    ['status' => ExataFormCandidate::STATUS_EXPIRED]
                );
                abort(403, 'Form sudah expired');
            }
            if ($form->exata_id && $form->status == ExataFormCandidate::STATUS_SUBMITTED) {
                abort(403, 'Form sudah expired');
            }
            $this->password = $form->password;
        } catch (DecryptException $e) {
            abort(404, 'Form tidak tersedia');
        }
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm() {}

    #[On('on-dialog-cancel')]
    public function onDialogCancel() {}

    public function checkPassword()
    {
        try {

            $form_id = Crypt::decrypt($this->objId);

            $form = ExataFormCandidateRepository::find($form_id);

            if (!$form) {
                abort(404, 'Form tidak ditemukan');
            }

            // ✅ check expired first
            if ($form->expired_at && now()->greaterThan($form->expired_at)) {
                abort(403, 'Form sudah expired');
            }

            // ✅ password validation
            if ($this->input_password !== $form->password) {

                $this->max_attempts--;

                Alert::fail(
                    $this,
                    "Password Salah",
                    "Sisa percobaan: {$this->max_attempts}"
                );

                // lock form when attempts finished
                if ($this->max_attempts <= 0) {

                    ExataFormCandidateRepository::update(
                        $form_id,
                        ['expired_at' => now()]
                    );

                    return redirect()->route(
                        'exata_form_candidate.form',
                        $this->objId
                    );
                }

                return;
            }

            // ✅ SUCCESS ACCESS
            $this->authorized = true;

            Alert::success($this, "Berhasil", "Password benar");
            $this->dispatch('onAuthorized');
        } catch (DecryptException $e) {
            abort(404, 'Form tidak tersedia');
        }
    }

    public function removeSertifikatBahasaJepang($index)
    {
        unset($this->sertifikat_bahasa_jepang[$index]);

        // IMPORTANT → reset index array
        $this->sertifikat_bahasa_jepang = array_values($this->sertifikat_bahasa_jepang);
    }
    public function removeCV($index)
    {
        unset($this->cv[$index]);

        // IMPORTANT → reset index array
        $this->cv = array_values($this->cv);
    }

    public function removeSertifikatBahasaJepangOld($index)
    {

        if ($this->sertifikat_bahasa_jepang_old[$index]['id']) {
            $this->sertifikat_bahasa_jepang_removes[] = $this->sertifikat_bahasa_jepang_old[$index]['id'];
        }
        unset($this->sertifikat_bahasa_jepang_old[$index]);
    }
    public function removeCVOld($index)
    {

        if ($this->cv_old[$index]['id']) {
            $this->cv_removes[] = $this->cv_old[$index]['id'];
        }
        unset($this->cv_old[$index]);
    }

    public function selectDomisili($data)
    {
        $this->Domisili[] = $data['id'];
    }
    public function unSelectDomisili($data)
    {
        $index = array_search($data['id'], $this->Domisili);
        if ($index !== false) {
            unset($this->Domisili[$index]);
        }
    }

    public function selectPreferensiLokasi($data)
    {
        $this->Penempatankerja[] = $data['id'];
    }
    public function unSelectPreferensiLokasi($data)
    {
        $index = array_search($data['id'], $this->Penempatankerja);
        if ($index !== false) {
            unset($this->Penempatankerja[$index]);
        }
    }

    public function selectBidangKerjaPilihan($data)
    {
        $this->BidangKerjaPilihan[] = $data['id'];
    }
    public function unSelectBidangKerjaPilihan($data)
    {
        $index = array_search($data['id'], $this->BidangKerjaPilihan);
        if ($index !== false) {
            unset($this->BidangKerjaPilihan[$index]);
        }
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                // Form Candidate
                $validateData = [
                    // Form J-Expert
                    'NamaLengkap' => $this->NamaLengkap,
                    'TanggalLahir' => $this->TanggalLahir,
                    'Gender' => $this->Gender,
                    'Pendidikan' => $this->Pendidikan,
                    'LevelBahasa' => $this->LevelBahasa,
                    'TahunTerbit' => $this->TahunTerbit,
                    'LamaDiJepang' => $this->LamaDiJepang,
                    'TanggalPulang' => $this->TanggalPulang,
                    'Sensei' => $this->Sensei ? 'YA' : 'TIDAK',
                    'Dokumen' => $this->Dokumen ? 'YA' : 'TIDAK',
                    'Penerjemah' => $this->Penerjemah ? 'YA' : 'TIDAK',
                    'EstimasiGaji' => $this->EstimasiGaji,
                    'Domisili' => $this->Domisili ? $this->Domisili[0] : null,
                    'Penempatankerja' => $this->Penempatankerja ? implode(',', $this->Penempatankerja) : null,
                    'TglSiapkerja' => $this->TglSiapkerja,
                    'BidangKerjadiJepang' => $this->BidangKerjadiJepang,
                    'BidangKerjaPilihan' => $this->BidangKerjaPilihan ? implode(',', $this->BidangKerjaPilihan) : null,
                    'Senmongkyu' => $this->Senmongkyu ? 'YA' : 'TIDAK',
                    'BidangSenmongkyu' => $this->BidangSenmongkyu,
                    'JenisVisa' => $this->JenisVisa,
                    'Provinsi' => $this->Provinsi,
                    'Kota' => $this->Kota,
                    'NamaTikTok' => $this->NamaTikTok,
                    'NamaInstagram' => $this->NamaInstagram,
                    'NoTelpIndonesia' => $this->NoTelpIndonesia,
                    'NoTelpJepang' => $this->NoTelpJepang,
                    'Email' => $this->Email,
                    'PICSales' => $this->PICSales,
                    'NamaLPK' => $this->NamaLPK,

                    'TinggiBadan' => $this->tinggi_badan ? $this->tinggi_badan : null,
                    'BeratBadan' => $this->berat_badan ? $this->berat_badan : null,
                    'SkillBahasaLain' => $this->skill_bahasa_lain,
                    'SkillKomputer' => $this->skill_komputer,
                    'PencapaianTertinggi' => $this->pencapaian_tertinggi,
                    'ValueSaatDiJepang' => $this->value_saat_di_jepang,
                    'SoftSkill' => $this->soft_skill,
                    'SkillLainnya' => $this->skill_lainnya,
                    'PengalamanKerja' => $this->pengalaman_kerja,
                    'Pipeline' => Exata::FILTER_PIPELINE_CHOICE[Exata::PIPELINE_NEW_LEAD],
                    'TglInput' => now(),
                    'PICSales' => Exata::FILTER_SALES_FORM_KANDIDAT,
                ];
                // if ($this->exata_id) {

                //     $exata = ExataRepository::update($this->exata_id, $validateData);
                //     $exata_id = $exata->id;
                // } else {

                //     }
                $exata = ExataRepository::create($validateData);
                $exata_id = $exata->id;
                foreach ($this->sertifikat_bahasa_jepang as $sertifikat) {

                    $path = $sertifikat->store(FilePathHelper::FILE_CANDIDATE_JAPANESE_LANGUAGE_CERTIFICATE, 'public');
                    $validatedSertifikat = [
                        'exata_id' => $exata_id,
                        'file' => $path,
                        'name' => $sertifikat->getClientOriginalName()
                    ];

                    ExataJapaneseLanguageCertificateRepository::create($validatedSertifikat);
                }
                foreach ($this->cv as $cv) {

                    $path = $cv->store(FilePathHelper::FILE_CANDIDATE_CURRICULUM_VITAE, 'public');
                    $validatedCv = [
                        'exata_id' => $exata_id,
                        'file' => $path,
                        'name' => $cv->getClientOriginalName()
                    ];

                    ExataCurriculumVitaeRepository::create($validatedCv);
                }

                ExataFormCandidateRepository::update(
                    Crypt::decrypt($this->objId),
                    [
                        'status' => ExataFormCandidate::STATUS_SUBMITTED,
                        'exata_id' => $exata_id,
                    ]
                );
            });


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
        return view('livewire.exata.exata-form-candidate.form');
    }
}
