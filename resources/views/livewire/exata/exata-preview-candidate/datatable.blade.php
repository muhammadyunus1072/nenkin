<div>
    <div class="row justify-content-between mb-3">
        <div class="col-auto mb-2 {{ !isset($show_filter) || $show_filter == true ? '' : 'd-none' }}">
            <label>Show</label>
            <select wire:model.change="length" class="form-select">
                @foreach ($lengthOptions as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6 mb-2 {{ !isset($keyword_filter) || $keyword_filter == true ? '' : 'd-none' }}">
            <label>Kata Kunci</label>
            <input wire:model.live="search" type="text" class="form-control">
        </div>
    </div>

    <div class="position-relative">
        <div wire:loading>
            <div class="position-absolute w-100 h-100">
                <div class="w-100 h-100" style="background-color: grey; opacity:0.2"></div>
            </div>
            <h5 class="position-absolute shadow bg-white p-2 rounded"
                style="top: 50%;left: 50%;transform: translate(-50%, -50%);">Loading...</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered text-nowrap w-100 h-100">
                <thead>
                    <tr>
                        @foreach ($columns as $index => $col)
                            <th wire:key='datatable_header_{{ $index }}'>
                                @if (!isset($col['sortable']) || $col['sortable'])
                                    @php $isSortAscending = $col['key'] == $sortBy && $sortDirection == 'asc'@endphp
                                    <button type="button" class='btn p-0 m-0'
                                        wire:click="datatableSort('{{ $col['key'] }}')">
                                        <div class="fw-bold align-items-center d-flex">
                                            <div class='pe-2'>
                                                {{ $col['name'] }}
                                            </div>
                                            <div class="d-flex flex-column">
                                                <i
                                                    class="ki-duotone ki-up fs-4 m-0 p-0
                                {{ $isSortAscending ? 'text-dark' : 'text-secondary' }}"></i>
                                                <i
                                                    class="ki-duotone ki-down fs-4 m-0 p-0
                                {{ $isSortAscending ? 'text-secondary' : 'text-dark' }}"></i>
                                            </div>
                                        </div>
                                    </button>
                                @else
                                    <div class="fs-6 p-2">
                                        {{ $col['name'] }}
                                    </div>
                                @endif
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr wire:key='datatable_row_{{ $index }}'>
                            @foreach ($columns as $col)
                                @if (isset($col['render']) && is_callable($col['render']))
                                    <td class="{{isset($col['class']) ? $col['class'] : '' }}">{!! call_user_func($col['render'], $item, $index) !!}</td>
                                @elseif (isset($col['key']))
                                    <td class="{{isset($col['class']) ? $col['class'] : '' }}">{{ $item->{$col['key']} }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-end mt-3">
        <div class="col">
            <em>Total Data: {{ $data->total() }}</em>
        </div>
        <div class="col-auto">
            {{ $data->links() }}
        </div>
    </div>
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-xl" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkModalLabel">Edit Point of Recommendation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body import_modal">
                        <div class="row">
                            {{-- Kode Unik --}}
                            <div class="col-md-6 mb-3">
                                <label>Kode Unik</label>
                                <p class="form-control">{{$KodeUnik}}</p>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control"
                                    wire:model="TanggalLahir">
                            </div>

                            {{-- Gender --}}
                            <div class="col-md-6 mb-3">
                                <label>Gender</label>
                                <select wire:model="Gender" class="form-select">
                                    @foreach (App\Models\Exata\Exata::FILTER_GENDER_CHOICE as $key => $name)    
                                        <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Pendidikan --}}
                            <div class="col-md-6 mb-3">
                                <label>Pendidikan</label>
                                <select Wire:model="Pendidikan" class="form-select">
                                    @foreach (App\Models\Exata\Exata::FILTER_PENDIDIKAN_CHOICE as $key => $name)    
                                        <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Level Bahasa --}}
                            <div class="col-md-6 mb-3">
                                <label>Level Bahasa</label>
                                <select wire:model="LevelBahasa" class="form-select">
                                    @foreach (App\Models\Exata\Exata::FILTER_LEVEL_BAHASA_CHOICE as $key => $name)    
                                        <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Lama di Jepang --}}
                            <div class="col-md-6 mb-3">
                                <label>Lama di Jepang (Bulan)</label>
                                <input type="number" class="form-control"
                                    wire:model="LamaDiJepang">
                            </div>

                            {{-- Estimasi Gaji --}}
                            <div class="col-md-6 mb-3">
                                <label>Estimasi Gaji</label>
                                <input type="number" class="form-control"
                                    wire:model="EstimasiGaji">
                            </div>

                            {{-- Domisili --}}
                            <div class="col-md-6 mb-3" wire:ignore>
                                <label>Domisili</label>
                                <input type="text" class="form-control" wire:model="Domisili">
                            </div>

                            {{-- Tanggal Siap Kerja --}}
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Siap Kerja</label>
                                <input type="date" class="form-control"
                                    wire:model="TglSiapkerja">
                            </div>

                            {{-- Bidang Kerja di Jepang --}}
                            <div class="col-md-6 mb-3">
                                <label>Bidang Kerja di Jepang</label>
                                <input type="text" class="form-control"
                                    wire:model="BidangKerjadiJepang">
                            </div>

                            {{-- Bidang Kerja Pilihan --}}
                            <div class="col-md-6 mb-3" wire:ignore>
                                <label>Bidang Kerja Pilihan</label>
                                <select id="select2-BidangKerjaPilihan" class="form-select" multiple>
                                    @foreach (App\Models\Exata\Exata::FILTER_JOB_PILIHAN_INDO_CHOICE as $key => $name)    
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="checkbox" wire:model="Sensei">
                                            <label class="form-label ms-2 mb-2">
                                                Sensei
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="checkbox" wire:model="Dokumen">
                                            <label class="form-label ms-2 mb-2">
                                                Dokumen
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="checkbox" wire:model="Penerjemah">
                                            <label class="form-label ms-2 mb-2">
                                                Penerjemah
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Soft Skill --}}
                            <div class="col-md-6 mb-3">
                                <label>Soft Skill</label>
                                <textarea class="form-control"
                                    wire:model="SoftSkill"></textarea>
                            </div>

                            {{-- Skill Komputer --}}
                            <div class="col-md-6 mb-3">
                                <label>Skill Komputer</label>
                                <textarea class="form-control"
                                    wire:model="SkillKomputer"></textarea>
                            </div>

                            {{-- Keterangan --}}
                            <div class="col-md-6 mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control"
                                    wire:model="Keterangan"></textarea>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Point of Recommendation</label>
                                <textarea placeholder="Point of Recommendation" class="form-control" cols="30" rows="4" wire:model="poin_rekomendasi"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target='save' wire:click="save">Simpan</button>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    
    <script>
        initSelect2();
        

        function initSelect2() {
            $('#select2-BidangKerjaPilihan').select2({
                placeholder: "-- Pilih --",
                dropdownParent: $('#editModal'),
                cache: true
            });
            $('#select2-BidangKerjaPilihan').on('select2:select', function(e) {
                @this.call('selectBidangKerjaPilihan', e.params.data)
            });
    
            $('#select2-BidangKerjaPilihan').on('select2:unselect', function(e) {
                @this.call('unSelectBidangKerjaPilihan', e.params.data)
            });
            window.addEventListener('set-select2-BidangKerjaPilihan', event => {
                
                let bidang = event.detail[0] ?? [];
                $('#select2-BidangKerjaPilihan').val(bidang).trigger('change');
            });
        }
    </script>
@endpush