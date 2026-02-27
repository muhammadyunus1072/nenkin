<?php

namespace App\Http\Livewire\EKlaim\Laporan\RekapRealisasi;

use App\Models\PetaKontraktorPayor;
use Carbon\Carbon;
use Livewire\Component;

class Filter extends Component
{
    public $end_date;
    public $start_date;
    public $filter_payor;

    public $payor_choice = [];

    public function mount()
    {
        $this->start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_date = Carbon::now()->endOfMonth()->format('Y-m-d');

        $this->payor_choice = PetaKontraktorPayor::select('payor_id', 'payor_nm')->distinct()->orderBy('payor_nm')->get()->toArray();
        $this->filter_payor = $this->payor_choice[0]['payor_id'];
    }

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
