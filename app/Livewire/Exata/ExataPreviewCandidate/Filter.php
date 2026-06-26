<?php

namespace App\Livewire\Exata\ExataPreviewCandidate;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Filter extends Component
{
    public function mount() {}

    public function render()
    {
        return view('livewire.exata.exata-preview-candidate.filter');
    }
}
