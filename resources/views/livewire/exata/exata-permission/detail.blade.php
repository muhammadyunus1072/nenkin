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

        <h3>
            Filter
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
                            {{ str_replace('exata_FILTER_','',$access['name']) }}
                        </div>
                        <hr>
                    </div>
                </div>
            @endif
        @endforeach

        <h3>
            Datatable
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
                            {{ str_replace('exata_DATATABLE_','',$access['name']) }}
                        </div>
                        <hr>
                    </div>
                </div>
            @endif
        @endforeach

        <h3>
            Pipeline
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
