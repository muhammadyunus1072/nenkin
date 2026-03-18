<?php

namespace App\Livewire\Exata\Exata;

use App\Helpers\Alert;
use App\Helpers\FilePathHelper;
use App\Repositories\Exata\ExataCurriculumVitaeRepository;
use App\Repositories\Exata\ExataJapaneseLanguageCertificateRepository;
use App\Repositories\Exata\ExataRepository;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $objId;

    public $candidate_profile;

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

    public function mount()
    {
        if ($this->objId) {
            $candidate = ExataRepository::find(Crypt::decrypt($this->objId));
            $this->candidate_profile = $candidate->toArray();

            foreach ($candidate->exataJapaneseLanguageCertificates as $certificate) {
                $this->sertifikat_bahasa_jepang_old[] = [
                    'id' => Crypt::encrypt($certificate->id),
                    'name' => $certificate->name,
                    'file' => Storage::url($certificate->file),
                ];
            }
            foreach ($candidate->exataCurriculumVitaes as $cv) {
                $this->cv_old[] = [
                    'id' => Crypt::encrypt($cv->id),
                    'name' => $cv->name,
                    'file' => Storage::url($cv->file),
                ];
            }
            $this->tinggi_badan = $candidate->TinggiBadan;
            $this->berat_badan = $candidate->BeratBadan;
            $this->skill_bahasa_lain = $candidate->SkillBahasaLain;
            $this->skill_komputer = $candidate->SkillKomputer;
            $this->pencapaian_tertinggi = $candidate->PencapaianTertinggi;
            $this->value_saat_di_jepang = $candidate->ValueSaatDiJepang;
            $this->soft_skill = $candidate->SoftSkill;
            $this->skill_lainnya = $candidate->SkillLainnya;
            $this->pengalaman_kerja = $candidate->PengalamanKerja;
        }
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm() {}

    #[On('on-dialog-cancel')]
    public function onDialogCancel() {}



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

    public function store()
    {
        try {
            DB::transaction(function () {
                // Form Candidate
                $validateData = [
                    'TinggiBadan' => $this->tinggi_badan ? $this->tinggi_badan : null,
                    'BeratBadan' => $this->berat_badan ? $this->berat_badan : null,
                    'SkillBahasaLain' => $this->skill_bahasa_lain,
                    'SkillKomputer' => $this->skill_komputer,
                    'PencapaianTertinggi' => $this->pencapaian_tertinggi,
                    'ValueSaatDiJepang' => $this->value_saat_di_jepang,
                    'SoftSkill' => $this->soft_skill,
                    'SkillLainnya' => $this->skill_lainnya,
                    'PengalamanKerja' => $this->pengalaman_kerja,
                ];
                if ($this->objId) {
                    $exata_id = Crypt::decrypt($this->objId);
                    ExataRepository::update($exata_id, $validateData);
                }

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

                // Remove
                foreach ($this->sertifikat_bahasa_jepang_removes as $sertifikat_remove) {
                    ExataJapaneseLanguageCertificateRepository::delete(Crypt::decrypt($sertifikat_remove));
                }
                foreach ($this->cv_removes as $cv_remove) {
                    ExataCurriculumVitaeRepository::delete(Crypt::decrypt($cv_remove));
                }
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
        return view('livewire.exata.exata.detail');
    }
}
