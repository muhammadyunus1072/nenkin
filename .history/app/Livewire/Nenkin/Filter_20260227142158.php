<?php

namespace App\Livewire\Nenkin;

use Carbon\Carbon;
use Livewire\Component;

class Filter extends Component
{
    public $end_date;
    public $start_date;
    public $filter_payor;

    public $payor_choice = [];

    public function mount() {}

    public function updated()
    {
        $this->emit('addFilter', [
            'end_date' => $this->end_date,
            'start_date' => $this->start_date,
            'filter_payor' => $this->filter_payor,
        ]);
    }

    public function render()
    {
        return view('livewire.e-klaim.laporan.rekap-realisasi.filter');
    }
}
