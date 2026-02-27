<?php

namespace App\Livewire\Nenkin;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Filter extends Component
{
    public $end_date;
    public $start_date;
    public $filter_payor;

    public $payor_choice = [];

    public function mount() {}

    public function delete()
    {
        Storage::disk('public')->deleteDirectory('labeled');
    }

    public function render()
    {
        return view('livewire.nenkin.filter');
    }
}
