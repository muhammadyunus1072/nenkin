<div>
    <div class="row justify-content-between mb-3">
        <div class="row col-auto d-flex flex-nowrap">
            <div class="col-auto mb-2 {{ !isset($show_filter) || $show_filter == true ? '' : 'd-none' }}">
                <label>Show</label>
                <select wire:model.change="length" class="form-select">
                    @foreach ($lengthOptions as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto d-flex align-items-end mb-2">
                <button class="btn btn-primary btn-sm" wire:click="showAllColumns">
        
                    <i class='ki-duotone ki-eye fs-3'>
                            <span class='path1'></span>
                            <span class='path2'></span>
                            <span class='path3'></span>
                            <span class='path4'></span>
                            <span class='path5'></span>
                        </i>
                        Show All
                </button>
            </div>
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
                        @if (!in_array($index,$hideColumns))
                            <th wire:key='datatable_header_{{ $index }}'>
                                @if (!isset($col['sortable']) || $col['sortable'])
                                    @php $isSortAscending = $col['key'] == $sortBy && $sortDirection == 'asc'@endphp
                                    <button type="button" class='btn p-0 m-0'
                                        wire:click="datatableSort('{{ $col['key'] }}')">
                                        <div class="fw-bold align-items-center d-flex">
                                            <div class='pe-2'>
                                                <p wire:click="hideColumn({{$index}})" class="">{{ $col['name'] }}</p>
                                            
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
                                        <p wire:click="hideColumn({{$index}})" class="">{{ $col['name'] }}</p>
                                        
                                    </div>
                                @endif
                            </th>
                        @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr wire:key='datatable_row_{{ $index }}' 
                        {{-- class="table-danger" > --}}
                        style="{{ $item->colorPipeline() }}">
                            @foreach ($columns as $indexCol => $col)
                                @if (!in_array($indexCol,$hideColumns))
                                    @if (isset($col['render']) && is_callable($col['render']))
                                        <td class="{{isset($col['class']) ? $col['class'] : '' }}">{!! call_user_func($col['render'], $item, $index) !!}</td>
                                    @elseif (isset($col['key']))
                                        <td class="{{isset($col['class']) ? $col['class'] : '' }}">{{ $item->{$col['key']} }}</td>
                                    @endif
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
</div>
