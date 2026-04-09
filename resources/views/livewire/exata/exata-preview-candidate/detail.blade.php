<div class="content-layer mx-auto st shadow-sm rounded-lg overflow-hidden border border-outline-variant/15">

        {{-- HEADER --}}
        <div class="header">
            
            <div class="p-0 border-b border-outline-variant/10" id="header"
                style="display:flex; justify-content: space-evenly; align-items: center;"
                >
                <img src="{{asset(config('template.logo_panel'))}}"
                    style="width:200px; height:80px; object-fit:contain;">
                <div>
                    <h1 style="font-weight:800; font-size:20px;">
                        {!! $nama_lpk !!}
                    </h1>
                    <div style="margin-top:5px;">
                        <p class="text-[13px]">{!! nl2br(e($alamat_lpk)) !!}</p>
                        <p class="text-[13px] mt-1">{!! nl2br(e($telp_lpk)) !!}</p>
                    </div>
                </div>
            </div>
            <div class="row flex items-center flex-col mt-[60px]" id="input">
                <div class="">
                    <button class="bg-green-600  mb-2 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200" onclick="printPDF()">
                        Save PDF
                    </button>
                </div>
                <div class="w-5/12">
                    <input type="text" placeholder="Nama LPK" wire:model.live="nama_lpk" class="w-full px-3 mb-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="w-5/12">
                    <textarea placeholder="Nama LPK" wire:model.live="alamat_lpk" cols="30" rows="3" class="w-full px-3 mb-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="w-5/12">
                    <input type="text" placeholder="Nama LPK" wire:model.live="telp_lpk" class="w-full px-3 mb-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
        {{-- CONTENT --}}
        <table class="report-container">
            <thead class="report-header">
                <tr>
                    <th class="report-header-cell">
                    </th>
                </tr>
            </thead>
            <tbody class="report-content">
                <tr>
                    <td class="report-content-cell">
                        <div class="main">
                            <!-- Table Section -->
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <table class="w-full table-fixed">
                                        <thead>
                                            <tr class="bg-primary-container text-on-primary">
                                                <th class="w-[80px] px-0 text-[10px] py-4 text-center break-words">Kode</th>
                                                <th class="w-[60px] px-0 text-[10px] py-4 text-center break-words">Usia</th>
                                                <th class="w-[80px] px-0 text-[10px] py-4 text-center break-words">Gender</th>
                                                <th class="w-[100px] px-0 text-[10px] py-4 text-center break-words">Pendidikan</th>
                                                <th class="w-[120px] px-0 text-[10px] py-4 text-center break-words">Domisili</th>
                                                <th class="w-[130px] px-0 text-[10px] py-4 text-center break-words">Penempatan</th>
                                                <th class="w-[120px] px-0 text-[10px] py-4 text-center break-words">Level Bahasa</th>
                                                <th class="w-[120px] px-0 text-[10px] py-4 text-center break-words">Lama di Jepang</th>
                                                <th class="w-[180px] px-0 text-[10px] py-4 text-start break-words">Bidang Kerja Jepang</th>
                                                <th class="w-[80px] px-0 text-[10px] py-4 text-center break-words">Sensei</th>
                                                <th class="w-[80px] px-0 text-[10px] py-4 text-center break-words">Admin</th>
                                                <th class="w-[100px] px-0 text-[10px] py-4 text-center break-words">Penerjemah</th>
                                                <th class="w-[140px] px-0 text-[10px] py-4 text-center break-words">Available Start</th>
                                                <th class="w-[100px] px-0 text-[10px] py-4 text-center break-words">Salary</th>
                                                <th class="w-[200px] px-0 text-[10px] py-4 text-start break-words">Points of Recommendation</th>
                                            </tr>
                                        </thead>
                                    <tbody class="text-[11px]">
                                        @foreach ($data as $index => $item)
                                            <!-- Row 1 -->
                                            <tr class="border-b border-outline-variant/10" style="border: 3px dashed #cfe1fd;">
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['KodeUnik']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{    Carbon\Carbon::parse($item['TanggalLahir'])->age }}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['Gender'] == 'L' ? 'Pria' : 'Wanita'}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['Pendidikan']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['Domisili']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['Penempatankerja']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['LevelBahasa']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['LamaDiJepang']}}</td>
                                                <td class="px-0 py-1 text-[8px]">{{$item['BidangKerjadiJepang']}}</td>
                                                {{-- <td class="px-0 py-1 text-[8px]">{{$item['BidangKerjaPilihan']}}</td> --}}
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['Sensei']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['Dokumen']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['Penerjemah']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['TglSiapkerja']}}</td>
                                                <td class="px-0 py-1 text-[8px] text-center">{{$item['EstimasiGaji']}}</td>
                                                <td class="px-0 py-1 text-[8px]">{!! nl2br(e($item['poin_rekomendasi'])) !!}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="report-footer-cell">
                    </th>
                </tr>
            </tfoot>
        </table>

        <p class="text-center mb-0 pb-0 page-number"></p>
        {{-- FOOTER --}}
        <div class="footer">        
            <div class="mt-12 px-12 pb-0 w-full">
                <div class="flex flex-col w-full gap-0">
                    <p class="font-bold text-lg text-center mb-0 pb-0">Contact Person:</p>
                    <p class="font-extrabold text-xl text-center text-primary tracking-tight mt-0 pt-0">Tanjung - 0812 2000 4752</p>
                    <p class="font-extrabold text-[14px] tracking-tight text-end m-0">* Data updated as of {{Carbon\Carbon::now()->format('F d, Y');}}</p>
                </div>
            </div>
        </div>
    </div>

@push('js')
    <script>
        function printPDF(){
            $('#input').hide()
            $(() => {
                window.print();
                const afterPrint = setTimeout(() => {
                    window.close()
                }, 500);
            });
        }
    </script>
@endpush