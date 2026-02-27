<?php

namespace App\Livewire\Nenkin;

use App\Helpers\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Filter extends Component
{
    public $end_date;
    public $start_date;
    public $filter_payor;

    public $payor_choice = [];

    public function mount() {}

    public function showDeleteDialog()
    {
        Alert::confirmation(
            $this,
            Alert::ICON_QUESTION,
            "Hapus Data",
            "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
            "on-delete-dialog-confirm",
            "on-delete-dialog-cancel",
            "Hapus",
            "Batal",
        );
    }

    public function delete()
    {
        Storage::disk('public')->deleteDirectory('labeled');
    }

    public function render()
    {
        return view('livewire.nenkin.filter');
    }
}
