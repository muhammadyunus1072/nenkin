<?php

namespace App\Livewire\Exata\ExataPreviewCandidate;

use App\Repositories\Exata\ExataPreviewCandidateRepository;
use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $data;
    public $sortBy;
    public $sortDirection;

    public $nama_lpk = 'LPK HADITAMA';
    public $alamat_lpk = 'International Human Resource & Language Center 
Jl. Tanjung No. 45, Komplek Perkantoran, Jawa Barat';
    public $telp_lpk = '+62 812 2000 4752 | +62 21 8899 7766';

    public $showPoin = true;

    public function togglePoin()
    {
        $this->showPoin = !$this->showPoin;
    }

    public function mount()
    {
        $this->data = ExataPreviewCandidateRepository::datatable($this->sortBy, $this->sortDirection)->get();
    }

    public function render()
    {
        return view('livewire.exata.exata-preview-candidate.detail');
    }
}
