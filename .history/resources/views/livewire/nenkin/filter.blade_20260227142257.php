<div>
    <div class="row">
        <div class="col-md-3 mb-2">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" wire:model="start_date" />
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" class="form-control" wire:model="end_date" />
        </div>
        <div class="col-md-3 mb-2">
            <label>Jaminan</label>
            <select class="form-control" wire:model="filter_payor">
                @foreach ($payor_choice as $item)
                    <option value="{{ $item['payor_id'] }}">
                        {{ $item['payor_nm'] }} {{ $item['payor_id'] ? ' - ' . $item['payor_id'] : '' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Export Data --}}
    <div class="row col-12 mt-2">
        <div class="col-auto">
            <label>Export Data:</label>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-success btn-sm"
                wire:click="$emit('export', '{{ App\Helpers\ExportHelper::TYPE_EXCEL }}')">
                <i class="fa fa-file-excel"></i>
                Export Excel
            </button>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-danger btn-sm"
                wire:click="$emit('export', '{{ App\Helpers\ExportHelper::TYPE_PDF }}')">
                <i class="fa fa-file-pdf"></i>
                Export PDF
            </button>
        </div>
    </div>

    {{-- Export Data --}}
    {{-- <div class="row align-items-center mt-3">
        <div class="col-auto">
            <label>Export Data:</label>
        </div>
        <div class="col-auto">
            <button class="btn btn-sm btn-outline-success"
                wire:click="$emit('export','{{ App\Helpers\ExportHelper::TYPE_EXCEL }}')">
                <i class="fa fa-file-excel"></i>
                Export Excel
            </button>
        </div>
        <div class="col-auto">
            <button class="btn btn-sm btn-outline-danger"
                wire:click="$emit('export','{{ App\Helpers\ExportHelper::TYPE_PDF }}')">
                <i class="fa fa-file-pdf"></i>
                Export PDF
            </button>
        </div>
    </div> --}}
</div>
