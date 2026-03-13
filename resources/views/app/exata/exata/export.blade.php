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
                @foreach (App\Models\Exata\Exata::EXATA_DATATABLE_CHOICE as $key => $access) 
                    @switch($access['name'])
                        @case('Estimasi Gaji Top')
                            
                            @break
                        @default
                            @can("exata_" . $key . ".read")
                                <th>{{$access['name']}}</th>
                            @endCan
                    @endswitch
                @endForeach
            </tr>
        </thead>
        <tbody>

            @php
                $isNumberFormat = $request['type'] == App\Helpers\ExportHelper::TYPE_PDF;
            @endphp
            @foreach ($collection as $index => $data)
                
                <tr>
                    @foreach (App\Models\Exata\Exata::EXATA_DATATABLE_CHOICE as $key => $access) 
                    @switch($access['name'])
                        @case('Estimasi Gaji')
                            @can("exata_" . $key . ".read")
                                <td>{{$data[str_replace('DATATABLE_','',$key)] . ($data[str_replace('DATATABLE_','',$key.'Top')] ? '-' . $data[str_replace('DATATABLE_','',$key.'Top')] : '');}}</td>
                            @endCan
                            @break
                        @default
                            @can("exata_" . $key . ".read")
                                <td>{{$data[str_replace('DATATABLE_','',$key)]}}</td>
                            @endCan
                    @endswitch
                    @endForeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
