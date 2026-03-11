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
                <td colspan="8" style="text-align: center; font-weight: bold;">
                    {{ $request['title'] }}
                </td>
            </tr>

            <tr>
                <td colspan="8" style="border: 0px; padding:8px">
            </tr>

            <tr>
                <th>#</th>
                @foreach (App\Models\Exata\Exata::EXATA_DATATABLE_CHOICE as $key => $access) 
                    @can("exata_" . $key . ".read")
                        <th>{{$access}}</th>
                    @endCan
                @endForeach
            </tr>
        </thead>
        <tbody>

            @php
                $isNumberFormat = $request['type'] == App\Helpers\ExportHelper::TYPE_PDF;
            @endphp
            @foreach ($collection as $index => $data)
                
                <tr>
                    <td>{{$loop->iteration}}</td>
                    @foreach (App\Models\Exata\Exata::EXATA_DATATABLE_CHOICE as $key => $access) 
                        @can("exata_" . $key . ".read")
                            <td>{{$data[str_replace('DATATABLE_','',$key)]}}</td>
                        @endCan
                    @endForeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
