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
                
                $totalNilaiAwal = 0;
                $totalNilaiSisa = 0;
                $totalPiutang = 0;
                $totalPiutangRi = 0;
                $totalPiutangRj = 0;
                $totalKoreksi = 0;
                $totalKoreksiRi = 0;
                $totalKoreksiRj = 0;
                $totalPembayaran = 0;
                $totalPembayaranRi = 0;
                $totalPembayaranRj = 0;
            @endphp
            @foreach ($collection as $index => $data)
                @foreach ($data['detail'] as $jenis => $item)
                    
                <tr>
                    <td>{{Carbon\Carbon::parse($data['pengajuan_tanggal'])->format('d/m/Y')}}</td>
                    <td>{{ $index }}</td>

                    {{-- PENGAJUAN --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['cnt_pengajuan']) : $item['cnt_pengajuan']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_pengajuan']) : $item['nilai_pengajuan']}}</td>

                    {{-- PENGAJUAN PENDING --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['cnt_pengajuan_pending']) : $item['cnt_pengajuan_pending']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_pengajuan_pending']) : $item['nilai_pengajuan_pending']}}</td>

                    {{-- PENGAJUAN PENDING --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['cnt_pengajuan_dispute']) : $item['cnt_pengajuan_dispute']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_pengajuan_dispute']) : $item['nilai_pengajuan_dispute']}}</td>

                    {{-- LAYAK --}}
                    <td>{{Carbon\Carbon::parse($data['umbal_tanggal'])->format('d/m/Y')}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['cnt_layak']) : $item['cnt_layak']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_layak']) : $item['nilai_layak']}}</td>

                    {{-- TIDAK LAYAK --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['cnt_tidak_layak']) : $item['cnt_tidak_layak']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_tidak_layak']) : $item['nilai_tidak_layak']}}</td>

                    {{-- PENDING --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['cnt_pending']) : $item['cnt_pending']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_pending']) : $item['nilai_pending']}}</td>

                    {{-- DISPUTE --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['cnt_dispute']) : $item['cnt_dispute']}}</td>
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_dispute']) : $item['nilai_dispute']}}</td>

                    {{-- SELISIH JR --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['nilai_selisih_jr']) : $item['nilai_selisih_jr']}}</td>

                    {{-- KOREKSI KLAIM --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format(isset($item['nilai_koreksi']) ? $item['nilai_koreksi'] : 0) : (isset($item['nilai_koreksi']) ? $item['nilai_koreksi'] : 0)}}</td>

                    {{-- PEMBAYARAN --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format(isset($item['nilai_pembayaran']) ? $item['nilai_pembayaran'] : 0) : (isset($item['nilai_pembayaran']) ? $item['nilai_pembayaran'] : 0)}}</td>
                    @if (isset($item['tanggal_pembayaran']))
                        <td>{{Carbon\Carbon::parse($item['tanggal_pembayaran'])->format('d/m/Y')}}</td>
                    @else
                        <td></td>
                    @endif

                    {{-- SALDO AKHIR --}}
                    <td>{{$isNumberFormat ? App\Helpers\NumberFormatter::format($item['saldo']) : $item['saldo']}}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
