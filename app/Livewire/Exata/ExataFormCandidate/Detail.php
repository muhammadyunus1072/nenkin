<?php

namespace App\Livewire\Exata\ExataFormCandidate;

use App\Helpers\Alert;
use App\Models\Exata\ExataFormCandidate;
use App\Repositories\Exata\ExataFormCandidateRepository;
use App\Repositories\MasterData\Regency\RegencyRepository;
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

    public $password;
    public $expired_at;
    public $link;
    public $user;

    public function mount()
    {
        if ($this->objId) {
            $form = ExataFormCandidateRepository::find(Crypt::decrypt($this->objId));
            $this->password = $form->password;
            $this->expired_at = Carbon::parse($form->expired_at)->format('Y-m-d\TH:i');
            $this->link = route('exata_form_candidate.form', Crypt::encrypt($form->id));
            $this->user = $form->user->toArray();
        }
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('exata_form_candidate.edit', $this->objId);
        } else {
            $this->redirectRoute('exata_form_candidate.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('exata_form_candidate.index');
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                // Vehicle
                $validateData = [
                    'expired_at' => $this->expired_at,
                    'password' => $this->password,
                    'status' => ExataFormCandidate::STATUS_CREATED,
                    'user_id' => Auth::user()->id,
                ];
                $vehicle_id = null;
                if ($this->objId) {
                    $regency_id = Crypt::decrypt($this->objId);
                    ExataFormCandidateRepository::update($regency_id, $validateData);
                } else {
                    $vehicle = ExataFormCandidateRepository::create($validateData);
                    $vehicle_id = $vehicle->id;
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
        return view('livewire.exata.exata-form-candidate.detail');
    }
}
