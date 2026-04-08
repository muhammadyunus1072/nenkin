<?php

namespace App\Livewire\Exata\ExataPreviewCandidate;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Filter extends Component
{
    public function mount() {}

    public function truncateTable()
    {
        DB::table('exata_preview_candidates')->truncate();
        DB::table('_history_exata_preview_candidates')->truncate();
        $this->dispatch('refresh-table');
    }

    public function render()
    {
        return view('livewire.exata.exata-preview-candidate.filter');
    }
}
