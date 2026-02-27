<div>

    {{-- Export Data --}}
    <div class="row col-12 mt-2">
        <div class="col-auto">
            <label>Export Data:</label>
        </div>
        <div class="col-auto">
            <button
                class="btn btn-success btn-sm"
               x-data
    @click="$dispatch('export', { type: '{{ App\Helpers\ExportHelper::TYPE_EXCEL }}' })"
>
    Export Excel
            </button>
        </div>
        <div class="col-auto">
            <button class="btn btn-danger btn-sm"
                 x-data
    @click="$dispatch('export', { type: '{{ App\Helpers\ExportHelper::TYPE_EXCEL }}' })"
>
    Export Pdf
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
