<!DOCTYPE html>
<html>

<head>
    <title>{{ $request['title'] }}</title>
    <style>
        .table-border {
            border-collapse: collapse;
            font-size: 7px;
        }

        .table-border td {
            border: 1px solid;
            padding: 3px;
        }

        .table-border th {
            border: 1px solid;
            font-weight: bold;
            padding: 3px;
        }
    </style>
</head>

<body>

    <table class="table-border" style="width: 100%">
        <thead>
            <tr>
                @foreach (App\Models\Exata\Exata::EXATA_DATATABLE_CHOICE() as $key => $access) 
                    @if (!isset($access['isExport']) || $access['isExport'])
                        @can("exata_" . $key . ".read")
                            <th>{{$access['name']}}</th>
                        @endCan
                    @endif
                @endForeach
            </tr>
        </thead>
        <tbody>

            @php
                $isNumberFormat = $request['type'] == App\Helpers\ExportHelper::TYPE_PDF;
            @endphp
            @foreach ($collection as $index => $data)
                <tr>
                    @foreach (App\Models\Exata\Exata::EXATA_DATATABLE_CHOICE() as $key => $access) 
                    @if (!isset($access['isExport']) || $access['isExport'])
                         @can("exata_" . $key . ".read")
                            @if (!isset($access['isNotRender']) && isset($access['render']) && is_callable($access['render']))
                                <td>{!! call_user_func($access['render'], $data, $index) !!}</td>
                            @else
                                <td>{{ $data[str_replace('DATATABLE_','',$key)] }}</td>
                            @endif
                        @endCan
                    @endif
                    @endForeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
