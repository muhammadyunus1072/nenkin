<form wire:submit="store">
    <div class='row'>
        <div class="col-md-12 mb-4">
            <label>Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.blur="name" />

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <h3 class="row d-flex jusfity-content-start">
            Filter 
            <div class="form-check mb-2 ms-2 col-auto">
                <input class="form-check-input" type="checkbox" value="1"
                    id="permission_filter" wire:model.live="filter_all">
                <label class="" for="permission_filter">
                    Ijinkan Semua
                </label>
            </div>
        </h3>
        @foreach ($accesses as $keyAccess => $access)
            @if (str_starts_with($access['name'], 'exata_FILTER_'))
                <div class="col-md-3 mb-2" wire:key='access_{{ $keyAccess }}'>
                    <div class='col d-flex justify-content-start gap-2'>
                        @foreach ($access['permissions'] as $keyPermission => $permission)
                            <div class="form-check mb-2 col-auto">
                                <input class="form-check-input" type="checkbox" value="1"
                                    id="permission_{{ $keyAccess }}_{{ $keyPermission }}"
                                    wire:model='accesses.{{ $keyAccess }}.permissions.{{ $keyPermission }}.is_checked'>
                                <label class="form-check-label" for="permission_{{ $keyAccess }}_{{ $keyPermission }}">
                                    Ijinkan
                                </label>
                            </div>
                        @endforeach
                        <div class='fw-bold col-auto'>
                            {{App\Models\Exata\Exata::EXATA_FILTER_CHOICE[str_replace('exata_','',$access['name'])]}}
                        </div>
                        <hr>
                    </div>
                </div>
            @endif
        @endforeach
        <hr>
        <h3 class="row d-flex jusfity-content-start">
            Datatable 
            <div class="form-check mb-2 ms-2 col-auto">
                <input class="form-check-input" type="checkbox" value="1"
                    id="permission_datatable" wire:model.live="datatable_all">
                <label class="" for="permission_datatable">
                    Ijinkan Semua
                </label>
            </div>
        </h3>
        @foreach ($accesses as $keyAccess => $access)
            @if (str_starts_with($access['name'], 'exata_DATATABLE_'))
                <div class="col-md-3 mb-2" wire:key='access_{{ $keyAccess }}'>
                    <div class='col d-flex justify-content-start gap-2'>
                        @foreach ($access['permissions'] as $keyPermission => $permission)
                            <div class="form-check mb-2 col-auto">
                                <input class="form-check-input" type="checkbox" value="1"
                                    id="permission_{{ $keyAccess }}_{{ $keyPermission }}"
                                    wire:model='accesses.{{ $keyAccess }}.permissions.{{ $keyPermission }}.is_checked'>
                                <label class="form-check-label" for="permission_{{ $keyAccess }}_{{ $keyPermission }}">
                                    Ijinkan
                                </label>
                            </div>
                        @endforeach
                        <div class='fw-bold col-auto'>
                            {{App\Models\Exata\Exata::EXATA_DATATABLE_CHOICE[str_replace('exata_','',$access['name'])]['name']}}
                        </div>
                        <hr>
                    </div>
                </div>
            @endif
        @endforeach
        <hr>
        <h3 class="row d-flex jusfity-content-start">
            Pipeline 
            <div class="form-check mb-2 ms-2 col-auto">
                <input class="form-check-input" type="checkbox" value="1"
                    id="permission_pipeline" wire:model.live="pipeline_all">
                <label class="" for="permission_pipeline">
                    Ijinkan Semua
                </label>
            </div>
        </h3>
        @foreach ($accesses as $keyAccess => $access)
            @if (str_starts_with($access['name'], 'exata_PIPELINE_'))
                <div class="col-md-3 mb-2" wire:key='access_{{ $keyAccess }}'>
                    <div class='col d-flex justify-content-start gap-2'>
                        @foreach ($access['permissions'] as $keyPermission => $permission)
                            <div class="form-check mb-2 col-auto">
                                <input class="form-check-input" type="checkbox" value="1"
                                    id="permission_{{ $keyAccess }}_{{ $keyPermission }}"
                                    wire:model='accesses.{{ $keyAccess }}.permissions.{{ $keyPermission }}.is_checked'>
                                <label class="form-check-label" for="permission_{{ $keyAccess }}_{{ $keyPermission }}">
                                    Ijinkan
                                </label>
                            </div>
                        @endforeach
                        <div class='fw-bold col-auto'>
                            {{ str_replace('exata_PIPELINE_','',$access['name']) }}
                        </div>
                        <hr>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <button type="submit" class="btn btn-success mt-3">
        <i class='ki-duotone ki-check fs-1'></i>
        Save
    </button>
</form>
