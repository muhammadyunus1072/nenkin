<div>

    {{-- Export Data --}}
    <div class="row mt-4 d-flex gap-4">
        <div class="col-auto">
            <button class="btn btn-warning btn-sm"
                 x-data
                @click="$dispatch('export', { type: '{{ App\Helpers\ExportHelper::TYPE_PDF }}' })"
                >
                <i class="fa fa-file-pdf"></i>
                    Export Pdf
            </button>
        </div>
        <div class="col-auto">
            <button class="btn btn-danger btn-sm"
                 wire:click="truncateTable"
                >
                <i class="fa fa-trash"></i>
                    Hapus Semua Data
            </button>
        </div>
</div>
