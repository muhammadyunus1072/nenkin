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
                @can('exata_no.read')
                    <th>
                        no
                    </th>
                @endCan
                @can('exata_tgl_input.read')
                    <th>
                        tgl_input
                    </th>
                @endCan
                @can('exata_habis_kontrak.read')
                    <th>
                        habis_kontrak
                    </th>
                @endCan
                @can('exata_kembali_ke_jepang.read')
                    <th>
                        kembali_ke_jepang
                    </th>
                @endCan
                @can('exata_nama_lengkap.read')
                    <th>
                        nama_lengkap
                    </th>
                @endCan
                @can('exata_tgl_pulang.read')
                    <th>
                        tgl_pulang
                    </th>
                @endCan
                @can('exata_pic.read')
                    <th>
                        pic
                    </th>
                @endCan
                @can('exata_nama_lpk.read')
                    <th>
                        nama_lpk
                    </th>
                @endCan
                @can('exata_lama_di_jepang.read')
                    <th>
                        lama_di_jepang
                    </th>
                @endCan
                @can('exata_referensi_kerja.read')
                    <th>
                        referensi_kerja
                    </th>
                @endCan
                @can('exata_jenis_kelamin.read')
                    <th>
                        jenis_kelamin
                    </th>
                @endCan
                @can('exata_pendidikan.read')
                    <th>
                        pendidikan
                    </th>
                @endCan
                @can('exata_tahun_terbit.read')
                    <th>
                        tahun_terbit
                    </th>
                @endCan
                @can('exata_level_bahasa.read')
                    <th>
                        level_bahasa
                    </th>
                @endCan
                @can('exata_sensei.read')
                    <th>
                        sensei
                    </th>
                @endCan
                @can('exata_dokumen.read')
                    <th>
                        dokumen
                    </th>
                @endCan
                @can('exata_penerjemah.read')
                    <th>
                        penerjemah
                    </th>
                @endCan
                @can('exata_bidang_kerja_di_jepang.read')
                    <th>
                        bidang_kerja_di_jepang
                    </th>
                @endCan
                @can('exata_bidang_kerja_pilihan.read')
                    <th>
                        bidang_kerja_pilihan
                    </th>
                @endCan
                @can('exata_senmongkyu.read')
                    <th>
                        senmongkyu
                    </th>
                @endCan
                @can('exata_bidang_senmongkyu.read')
                    <th>
                        bidang_senmongkyu
                    </th>
                @endCan
                @can('exata_jenis_visa.read')
                    <th>
                        jenis_visa
                    </th>
                @endCan
                @can('exata_nama_tiktok.read')
                    <th>
                        nama_tiktok
                    </th>
                @endCan
                @can('exata_nama_instagram.read')
                    <th>
                        nama_instagram
                    </th>
                @endCan
                @can('exata_no_telp_indonesia.read')
                    <th>
                        no_telp_indonesia
                    </th>
                @endCan
                @can('exata_no_telp_jepang.read')
                    <th>
                        no_telp_jepang
                    </th>
                @endCan
                @can('exata_email.read')
                    <th>
                        email
                    </th>
                @endCan
                @can('exata_provinsi.read')
                    <th>
                        provinsi
                    </th>
                @endCan
                @can('exata_kota.read')
                    <th>
                        kota
                    </th>
                @endCan
                @can('exata_available.read')
                    <th>
                        available
                    </th>
                @endCan
            </tr>
        </thead>
        <tbody>

            @php
                $isNumberFormat = $request['type'] == App\Helpers\ExportHelper::TYPE_PDF;
            @endphp
            @foreach ($collection as $index => $data)
                
                <tr>
                    <td>{{$loop->iteration}}</td>
                    @can('exata_no.read')
                        <td>{{$data['no']}}</td>
                    @endCan
                    @can('exata_tgl_input.read')
                        <td>{{$data['tgl_input']}}</td>
                    @endCan
                    @can('exata_habis_kontrak.read')
                        <td>{{$data['habis_kontrak']}}</td>
                    @endCan
                    @can('exata_kembali_ke_jepang.read')
                        <td>{{$data['kembali_ke_jepang']}}</td>
                    @endCan
                    @can('exata_nama_lengkap.read')
                        <td>{{$data['nama_lengkap']}}</td>
                    @endCan
                    @can('exata_tgl_pulang.read')
                        <td>{{$data['tgl_pulang']}}</td>
                    @endCan
                    @can('exata_pic.read')
                        <td>{{$data['pic']}}</td>
                    @endCan
                    @can('exata_nama_lpk.read')
                        <td>{{$data['nama_lpk']}}</td>
                    @endCan
                    @can('exata_lama_di_jepang.read')
                        <td>{{$data['lama_di_jepang']}}</td>
                    @endCan
                    @can('exata_referensi_kerja.read')
                        <td>{{$data['referensi_kerja']}}</td>
                    @endCan
                    @can('exata_jenis_kelamin.read')
                        <td>{{$data['jenis_kelamin']}}</td>
                    @endCan
                    @can('exata_pendidikan.read')
                        <td>{{$data['pendidikan']}}</td>
                    @endCan
                    @can('exata_tahun_terbit.read')
                        <td>{{$data['tahun_terbit']}}</td>
                    @endCan
                    @can('exata_level_bahasa.read')
                        <td>{{$data['level_bahasa']}}</td>
                    @endCan
                    @can('exata_sensei.read')
                        <td>{{$data['sensei']}}</td>
                    @endCan
                    @can('exata_dokumen.read')
                        <td>{{$data['dokumen']}}</td>
                    @endCan
                    @can('exata_penerjemah.read')
                        <td>{{$data['penerjemah']}}</td>
                    @endCan
                    @can('exata_bidang_kerja_di_jepang.read')
                        <td>{{$data['bidang_kerja_di_jepang']}}</td>
                    @endCan
                    @can('exata_bidang_kerja_pilihan.read')
                        <td>{{$data['bidang_kerja_pilihan']}}</td>
                    @endCan
                    @can('exata_senmongkyu.read')
                        <td>{{$data['senmongkyu']}}</td>
                    @endCan
                    @can('exata_bidang_senmongkyu.read')
                        <td>{{$data['bidang_senmongkyu']}}</td>
                    @endCan
                    @can('exata_jenis_visa.read')
                        <td>{{$data['jenis_visa']}}</td>
                    @endCan
                    @can('exata_nama_tiktok.read')
                        <td>{{$data['nama_tiktok']}}</td>
                    @endCan
                    @can('exata_nama_instagram.read')
                        <td>{{$data['nama_instagram']}}</td>
                    @endCan
                    @can('exata_no_telp_indonesia.read')
                        <td>{{$data['no_telp_indonesia']}}</td>
                    @endCan
                    @can('exata_no_telp_jepang.read')
                        <td>{{$data['no_telp_jepang']}}</td>
                    @endCan
                    @can('exata_email.read')
                        <td>{{$data['email']}}</td>
                    @endCan
                    @can('exata_provinsi.read')
                        <td>{{$data['provinsi']}}</td>
                    @endCan
                    @can('exata_kota.read')
                        <td>{{$data['kota']}}</td>
                    @endCan
                    @can('exata_available.read')
                        <td>{{$data['available'] ? 'Ya' : 'Tidak'}}</td>
                    @endCan
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
