<?php

namespace App\Livewire\Nenkin;

use App\Helpers\Alert;
use App\Helpers\ExportHelper;
use App\Models\MasterData\PaymentMethod;
use App\Permissions\AccessMasterData;
use App\Permissions\PermissionHelper;
use App\Repositories\Account\UserRepository;
use App\Repositories\MasterData\PaymentMethod\PaymentMethodRepository;
use App\Repositories\Nenkin\NenkinRepository;
use App\Traits\WithDatatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;


class Datatable extends Component
{
    use WithDatatable;

    public $isCanUpdate;
    public $isCanDelete;
    public $isCanUpdateBookingTime;
    public $isCanUpdateDetail;

    // Delete Dialog
    public $targetDeleteId;

    #[On('export')]
    public function export($type)
    {
        dd('halo');
        $fileName = "Data Nenkin";
        return ExportHelper::export(
            $type,
            $fileName,
            $this->getQuery()->get()->toArray(),
            'app.nenkin.export',
            [
                'title' => 'Data Nenkin',
                'type' => $type,
            ],
            [
                'size' => 'legal',
                'orientation' => 'landscape',
            ]
        );
    }

    public function getColumns(): array
    {
        return [
            [
                'name' => 'Aksi',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $editHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-primary btn-sm' download href='" . Storage::url($item->image) . "'>
                                <i class='ki-duotone ki-eye fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                                Original
                            </a>
                        </div>";

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/labeled.pdf');

                    $destroyHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-success btn-sm' download href='" . $url . "'>
                                <i class='ki-duotone ki-eye fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                                Labeled
                            </a>
                        </div>";



                    $html = "<div class='row'>
                        $editHtml $destroyHtml 
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'date',
                'name' => 'Tanggal',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/date.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->date;
                }
            ],
            [
                'key' => 'payment_top',
                'name' => 'Pembayaran',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/payment_top.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->payment_top;
                }
            ],
            [
                'key' => 'payment',
                'name' => 'Pembayaran 100%',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/payment.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->payment;
                }
            ],
            [
                'key' => 'income',
                'name' => 'Pembayaran 20%',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/income.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->income;
                }
            ],
            [
                'key' => 'net',
                'name' => 'Pembayaran 80%',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/net.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->net;
                }
            ],
            [
                'key' => 'number',
                'name' => 'Nomor Nenkin',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/number.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->number;
                }
            ],
            [
                'key' => 'name',
                'name' => 'Nama',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/name.png');
                    return "<img src='" . $url . "' style='width:150px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->name;
                }
            ],
            [
                'key' => 'address',
                'name' => 'Alamat',
                'render' => function ($item) {

                    $epath = explode('/', $item->image);
                    $folder = $epath[0] . '/' . $epath[1];
                    $url = Storage::url($folder . '/address.png');
                    return "<img src='" . $url . "' style='width:500px; height:auto; border:1px solid black; border-radius:5px;'><br>" . $item->address;
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return NenkinRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.nenkin.datatable';
    }
}
