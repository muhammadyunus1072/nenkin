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
                <td colspan="22" style="text-align: center; font-weight: bold;">
                    {{ $request['title'] }}
                </td>
            </tr>

            <tr>
                <td colspan="22" style="border: 0px; padding:8px">
            </tr>

            <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Pembayaran</th>
                <th colspan="2">Pembayaran 100%</th>
                <th colspan="2">Pembayaran 20%</th>
                <th colspan="2">Pembayaran 80%</th>
                <th colspan="2">Nomor Nenkin</th>
                <th colspan="2">Nama</th>
                <th colspan="2">Alamat</th>
            </tr>
        </thead>
        <tbody>

            @php
                $isNumberFormat = $request['type'] == App\Helpers\ExportHelper::TYPE_PDF;
            @endphp
            @foreach ($collection as $index => $data)
                @foreach ($data['detail'] as $jenis => $item)
                    
                <tr>
                    <td>{{Carbon\Carbon::parse($data['date'])->format('d/m/Y')}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['payment_top']) : $item['payment_top']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['payment']) : $item['payment']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['income']) : $item['income']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['net']) : $item['net']}}</td>
                    <td>{{$item->number}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->address}}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
