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
                <th >Tanggal</th>
                <th >Pembayaran</th>
                <th>Pembayaran 100%</th>
                <th>Pembayaran 20%</th>
                <th>Pembayaran 80%</th>
                <th>Nomor Nenkin</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>

            @php
                $isNumberFormat = $request['type'] == App\Helpers\ExportHelper::TYPE_PDF;
            @endphp
            @foreach ($collection as $index => $data)
                <tr>
                    <td>{{Carbon\Carbon::parse($data['date'])->format('d/m/Y')}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($data['payment_top']) : $data['payment_top']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($data['payment']) : $data['payment']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($data['income']) : $data['income']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($data['net']) : $data['net']}}</td>
                    <td>{{$data['number']}}</td>
                    <td>{{$data['name']}}</td>
                    <td>{{$data['address']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
