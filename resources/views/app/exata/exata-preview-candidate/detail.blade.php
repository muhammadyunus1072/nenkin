@extends('app.layouts.print')

@section('content')
<!-- Table Section -->
<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-primary-container text-on-primary">
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Kodeunik</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Usia</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Gender</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Pendidikan</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase" style="width: 100px;">Domisili</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase" style="width: 100px;">Penempatan</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Level Bahasa</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Lama di Jepang</th>
                {{-- <th class="px-0 py-4 font-headline text-[8px] font-bold uppercase">Bidang kerja Jepang</th>
                <th class="px-0 py-4 font-headline text-[8px] font-bold uppercase">Bidang kerja Pilihan</th> --}}
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Sensei</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Admin</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Penerjemah</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Available Start</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Salary</th>
                <th class="px-0 py-4 font-headline text-center text-[8px] font-bold uppercase">Points of Recommendation</th>
            </tr>
        </thead>
        <tbody class="text-[11px]">
            @foreach ($data as $index => $item)
            {{-- {{dd($item)}} --}}
                <!-- Row 1 -->
                <tr class="border-b border-outline-variant/10" style="border: 3px dashed #cfe1fd;">
                    <td class="px-0 py-8 text-center">{{$item['KodeUnik']}}</td>
                    <td class="px-0 py-8 text-center">{{    Carbon\Carbon::parse($item['TanggalLahir'])->age}}</td>
                    <td class="px-0 py-8 text-center">{{$item['Gender'] == 'L' ? 'Pria' : 'Wanita'}}</td>
                    <td class="px-0 py-8 text-center">{{$item['Pendidikan']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['Domisili']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['Penempatankerja']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['LevelBahasa']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['LamaDiJepang']}}</td>
                    {{-- <td class="px-0 py-8">{{$item['BidangKerjadiJepang']}}</td>
                    <td class="px-0 py-8">{{$item['BidangKerjaPilihan']}}</td> --}}
                    <td class="px-0 py-8 text-center">{{$item['Sensei']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['StaffDokumen']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['Penerjemah']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['TglSiapkerja']}}</td>
                    <td class="px-0 py-8 text-center">{{$item['EstimasiGaji']}}</td>
                    <td class="px-0 py-8 text-center"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('footer')
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

@push('css')
<style>
    tr:nth-child(5n) {
        page-break-after: always;
    }
</style>
    
@endpush
@push('js')
<script>
    $(document).ready(function() {
        $('#select-penandatangan').change(function() {

            var selectedOption = $(this).val();
            var parts = selectedOption.split('#');
            var nama = parts[0];
            var jabatan = parts[1];
            var nip = parts[2];
            $('#nama').html(nama);
            $('#jabatan').html(jabatan);
            $('#nip').html("NIP " + nip);
        });
    });
</script>
@endpush