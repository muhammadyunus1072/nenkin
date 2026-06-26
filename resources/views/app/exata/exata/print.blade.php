@extends('app.layout.print')

@section('content')

    <!-- Title Bar -->
    <div class="bg-primary-container py-3 px-8">
        <h2 class="text-white font-headline font-bold text-center uppercase tracking-[0.2em] text-sm">REFERENSI SENSEI LPK HADETAMA</h2>
    </div>
    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-container text-on-primary border-b border-primary/20">
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Unique Code</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Usia</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Jenis Kelamin</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Pendidikan</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Domisili</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Lokasi Penempatan</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Level Bahasa</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Pengalaman Jepang</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Bidang Kerja</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Sensei</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Staff Dokumen</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Penerjemah</th>
                <th class="px-2 py-4 font-headline text-[8px] font-bold uppercase tracking-wider whitespace-nowrap">Available Start</th>
                </tr>
            </thead>
            <tbody class="text-[11px]">
                <!-- Row 1 -->
                <tr class="border-b border-outline-variant/10 hover:bg-surface-container-high transition-colors" style="border: 3px dashed #cfe1fd;">
                <td class="px-2 py-4 font-bold text-primary">ASB-BEK-004</td>
                <td class="px-2 py-4">26 Thn</td>
                <td class="px-2 py-4">Laki-laki</td>
                <td class="px-2 py-4">SMK Teknik</td>
                <td class="px-2 py-4">Bekasi</td>
                <td class="px-2 py-4">Chiba, JP</td>
                <td class="px-2 py-4">
                    JLPT N3
                </td>
                <td class="px-2 py-4">3 Tahun (TITP)</td>
                <td class="px-2 py-4">Konstruksi</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4 font-medium">01 Sep 2024</td>
                </tr>
                <tr class="border-b border-outline-variant/10 hover:bg-surface-container-high transition-colors" style="border: 3px dashed #cfe1fd;">
                <td class="px-2 py-4 font-bold text-primary">ASB-BEK-004</td>
                <td class="px-2 py-4">26 Thn</td>
                <td class="px-2 py-4">Laki-laki</td>
                <td class="px-2 py-4">SMK Teknik</td>
                <td class="px-2 py-4">Bekasi</td>
                <td class="px-2 py-4">Chiba, JP</td>
                <td class="px-2 py-4">
                    JLPT N3
                </td>
                <td class="px-2 py-4">3 Tahun (TITP)</td>
                <td class="px-2 py-4">Konstruksi</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4 font-medium">01 Sep 2024</td>
                </tr>
                <tr class="border-b border-outline-variant/10 hover:bg-surface-container-high transition-colors" style="border: 3px dashed #cfe1fd;">
                <td class="px-2 py-4 font-bold text-primary">ASB-BEK-004</td>
                <td class="px-2 py-4">26 Thn</td>
                <td class="px-2 py-4">Laki-laki</td>
                <td class="px-2 py-4">SMK Teknik</td>
                <td class="px-2 py-4">Bekasi</td>
                <td class="px-2 py-4">Chiba, JP</td>
                <td class="px-2 py-4">
                    JLPT N3
                </td>
                <td class="px-2 py-4">3 Tahun (TITP)</td>
                <td class="px-2 py-4">Konstruksi</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4 font-medium">01 Sep 2024</td>
                </tr>
                <tr class="border-b border-outline-variant/10 hover:bg-surface-container-high transition-colors" style="border: 3px dashed #cfe1fd;">
                <td class="px-2 py-4 font-bold text-primary">ASB-BEK-004</td>
                <td class="px-2 py-4">26 Thn</td>
                <td class="px-2 py-4">Laki-laki</td>
                <td class="px-2 py-4">SMK Teknik</td>
                <td class="px-2 py-4">Bekasi</td>
                <td class="px-2 py-4">Chiba, JP</td>
                <td class="px-2 py-4">
                    JLPT N3
                </td>
                <td class="px-2 py-4">3 Tahun (TITP)</td>
                <td class="px-2 py-4">Konstruksi</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4 font-medium">01 Sep 2024</td>
                </tr>
                <tr class="border-b border-outline-variant/10 hover:bg-surface-container-high transition-colors" style="border: 3px dashed #cfe1fd;">
                <td class="px-2 py-4 font-bold text-primary">ASB-BEK-004</td>
                <td class="px-2 py-4">26 Thn</td>
                <td class="px-2 py-4">Laki-laki</td>
                <td class="px-2 py-4">SMK Teknik</td>
                <td class="px-2 py-4">Bekasi</td>
                <td class="px-2 py-4">Chiba, JP</td>
                <td class="px-2 py-4">
                    JLPT N3
                </td>
                <td class="px-2 py-4">3 Tahun (TITP)</td>
                <td class="px-2 py-4">Konstruksi</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4">YA</td>
                <td class="px-2 py-4 font-medium">01 Sep 2024</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Table Footer/Summary -->
    <div class="px-8 py-4 bg-surface-container flex justify-between items-center text-[10px] text-on-surface-variant font-medium">
        <div class="flex">
            <span>Total Candidates: 5</span>
        </div>
        <div class="italic">
            * Data updated as of August 24, 2024
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#select-penandatangan').change(function(){
                
                var selectedOption = $(this).val();
                var parts = selectedOption.split('#');
                var nama = parts[0];
                var jabatan = parts[1];
                var nip = parts[2];
                $('#nama').html(nama);
                $('#jabatan').html(jabatan);
                $('#nip').html("NIP " +nip);
            });
        });
    </script>
@endpush