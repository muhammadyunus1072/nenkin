<?php

namespace App\Livewire\Exata\ExataAttachment;

use App\Helpers\Alert;
use App\Models\Exata\Exata;
use App\Models\Exata\ExataFormCandidate;
use App\Models\Exata\ExataJapaneseLanguageCertificate;
use App\Repositories\Exata\ExataCurriculumVitaeRepository;
use App\Repositories\Exata\ExataFormCandidateRepository;
use App\Repositories\Exata\ExataJapaneseLanguageCertificateRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $objId;
    public $type;

    public $attachments = [];
    public $attachment_type;

    public function mount()
    {
        if ($this->objId) {
            if ($this->type == Exata::PERMISSION_Cv) {

                $this->attachments = ExataCurriculumVitaeRepository::getBy([
                    ['exata_id', Crypt::decrypt($this->objId)]
                ])->toArray();
                $this->attachment_type = Exata::FILTER_ATTACHMENT_CV;
            }
            if ($this->type == Exata::PERMISSION_SertifikatBahasaJepang) {
                $this->attachments = ExataJapaneseLanguageCertificateRepository::getBy([
                    ['exata_id', Crypt::decrypt($this->objId)]
                ])->toArray();
                $this->attachment_type = Exata::FILTER_ATTACHMENT_SERTIFIKAT_BAHASA_JEPANG;
            }
        } else {
            return redirect()->route('exata.index');
        }
    }
    public function render()
    {
        return view('livewire.exata.exata-attachment.detail');
    }
}
