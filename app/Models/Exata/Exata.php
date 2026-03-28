<?php

namespace App\Models\Exata;

use App\Helpers\NumberGenerator;
use App\Models\Exata\ExataCurriculumVitae;
use App\Models\Exata\ExataJapaneseLanguageCertificate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class Exata extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    const PERMISSION_KodeUnik = 'KodeUnik';
    const PERMISSION_Ref = 'Ref';
    const PERMISSION_TglInput = 'TglInput';
    const PERMISSION_TanggalPulang = 'TanggalPulang';
    const PERMISSION_Kategori = 'Kategori';
    const PERMISSION_Pipeline = 'Pipeline';
    const PERMISSION_NamaLengkap = 'NamaLengkap';
    const PERMISSION_TanggalLahir = 'TanggalLahir';
    const PERMISSION_Gender = 'Gender';
    const PERMISSION_Pendidikan = 'Pendidikan';
    const PERMISSION_TahunTerbit = 'TahunTerbit';
    const PERMISSION_LevelBahasa = 'LevelBahasa';
    const PERMISSION_LamaDiJepang = 'LamaDiJepang';
    const PERMISSION_Sensei = 'Sensei';
    const PERMISSION_Dokumen = 'Dokumen';
    const PERMISSION_Penerjemah = 'Penerjemah';
    const PERMISSION_BidangKerjadiJepang = 'BidangKerjadiJepang';
    const PERMISSION_BidangKerjaPilihan = 'BidangKerjaPilihan';
    const PERMISSION_EstimasiGaji = 'EstimasiGaji';
    const PERMISSION_EstimasiGajiTop = 'EstimasiGajiTop';
    const PERMISSION_Domisili = 'Domisili';
    const PERMISSION_Penempatankerja = 'Penempatankerja';
    const PERMISSION_TglSiapkerja = 'TglSiapkerja';
    const PERMISSION_Senmongkyu = 'Senmongkyu';
    const PERMISSION_BidangSenmongkyu = 'BidangSenmongkyu';
    const PERMISSION_JenisVisa = 'JenisVisa';
    const PERMISSION_Provinsi = 'Provinsi';
    const PERMISSION_Kota = 'Kota';
    const PERMISSION_NamaTikTok = 'NamaTikTok';
    const PERMISSION_NamaInstagram = 'NamaInstagram';
    const PERMISSION_NoTelpIndonesia = 'NoTelpIndonesia';
    const PERMISSION_NoTelpJepang = 'NoTelpJepang';
    const PERMISSION_Email = 'Email';
    const PERMISSION_PICSales = 'PICSales';
    const PERMISSION_NamaLPK = 'NamaLPK';
    const PERMISSION_Keterangan = 'Keterangan';
    const PERMISSION_FilterTanggal = 'FilterTanggal';
    const PERMISSION_FilterNoWa = 'FilterNoWa';
    const PERMISSION_Available = 'Available';
    const PERMISSION_Job = 'JOB';


    const PERMISSION_SertifikatBahasaJepang = 'SertifikatBahasaJepang';
    const PERMISSION_Cv = 'Cv';
    const PERMISSION_TinggiBadan = 'TinggiBadan';
    const PERMISSION_BeratBadan = 'BeratBadan';
    const PERMISSION_SkillBahasaLain = 'SkillBahasaLain';
    const PERMISSION_SkillKomputer = 'SkillKomputer';
    const PERMISSION_PencapaianTertinggi = 'PencapaianTertinggi';
    const PERMISSION_ValueSaatDiJepang = 'ValueSaatDiJepang';
    const PERMISSION_SoftSkill = 'SoftSkill';
    const PERMISSION_SkillLainnya = 'SkillLainnya';
    const PERMISSION_PengalamanKerja = 'PengalamanKerja';

    const PERMISSION_Attachment = 'Attachment';

    const EXATA_FILTER_CHOICE = [
        'FILTER_' . self::PERMISSION_NamaLengkap => 'Nama Lengkap',
        'FILTER_' . self::PERMISSION_FilterNoWa => 'No Whatsapp',
        // 'FILTER_' . self::PERMISSION_NoTelpJepang => 'No Telp Jepang',
        'FILTER_' . self::PERMISSION_EstimasiGaji => 'Estimasi Gaji',
        'FILTER_' . self::PERMISSION_Domisili => 'Domisili',
        'FILTER_' . self::PERMISSION_Penempatankerja => 'Penempatan Kerja',
        'FILTER_' . self::PERMISSION_NamaLPK => 'Nama LPK',
        'FILTER_' . self::PERMISSION_NamaInstagram => 'Nama Instagram',
        'FILTER_' . self::PERMISSION_NamaTikTok => 'Nama TikTok',
        'FILTER_' . self::PERMISSION_Keterangan => 'Keterangan',
        'FILTER_' . self::PERMISSION_FilterTanggal => 'Filter Tanggal',
        'FILTER_' . self::PERMISSION_TglInput => 'Tgl Input',
        'FILTER_' . self::PERMISSION_TanggalPulang => 'Tanggal Pulang',
        'FILTER_' . self::PERMISSION_TglSiapkerja => 'tgl Siap kerja',
        'FILTER_' . self::PERMISSION_Pipeline => 'Pipeline',
        'FILTER_' . self::PERMISSION_Gender => 'Gender',
        'FILTER_' . self::PERMISSION_Pendidikan => 'Pendidikan',
        'FILTER_' . self::PERMISSION_LevelBahasa => 'Level Bahasa',
        'FILTER_' . self::PERMISSION_Job => 'Job',
        'FILTER_' . self::PERMISSION_Sensei => 'Sensei',
        'FILTER_' . self::PERMISSION_Dokumen => 'Dokumen',
        'FILTER_' . self::PERMISSION_Penerjemah => 'Penerjemah',
        'FILTER_' . self::PERMISSION_BidangKerjadiJepang => 'Bidang Kerjadi Jepang',
        'FILTER_' . self::PERMISSION_BidangKerjaPilihan => 'Bidang Kerja Pilihan',
        'FILTER_' . self::PERMISSION_PICSales => 'PIC Sales',
        'FILTER_' . self::PERMISSION_JenisVisa => 'Jenis Visa',

        'FILTER_' . self::PERMISSION_Attachment => 'Attachment',
        // 'FILTER_' . self::PERMISSION_Ref => 'Ref',
        // 'FILTER_' . self::PERMISSION_EstimasiGajiTop => 'Estimasi Gaji Top',
        // 'FILTER_' . self::PERMISSION_Senmongkyu => 'Senmongkyu',
        // 'FILTER_' . self::PERMISSION_BidangSenmongkyu => 'Bidang Senmongkyu',
        // 'FILTER_' . self::PERMISSION_Provinsi => 'Provinsi',
        // 'FILTER_' . self::PERMISSION_Kota => 'Kota',
        // 'FILTER_' . self::PERMISSION_Email => 'Email',
        // 'FILTER_' . self::PERMISSION_Available => 'Available',
    ];

    public static function EXATA_IMPORT_CHOICE()
    {
        // EXATA_IMPORT_CHOICE =
        return [
            'DATATABLE_' . self::PERMISSION_Ref => [
                'column_name' => self::PERMISSION_Ref,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Ref',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'referensi_kerja'
            ],
            'DATATABLE_' . self::PERMISSION_TglInput => [
                'column_name' => self::PERMISSION_TglInput,
                'validator' => 'nullable|date',
                'validator_message' => [
                    'date' => 'Format Tanggal Input Tidak Sesuai'
                ],
                'name' => 'Tgl Input',
                'class' => 'text-center',
                'isDate' => true,
                'header_name' => 'tgl_input',
            ],
            // 'DATATABLE_' . self::PERMISSION_Pipeline => [
            // 'column_name' => self::PERMISSION_Pipeline,
            //     'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_PIPELINE_CHOICE)),
            //     'validator_message' => [
            //         'in' => 'Nilai Pipeline Tidak Sesuai'
            //     ],
            //     'name' => 'Pipeline',
            //     'class' => 'text-center',
            //     'isDate' => false,
            //     'header_name' => '',
            // ],
            // 'DATATABLE_' . self::PERMISSION_Available => [
            // 'column_name' => self::PERMISSION_Available,
            // 'validator' => '',
            // 'validator_message' => [],
            //     'name' => 'Available',
            //     'class' => 'text-center',
            //     'isDate' => false,
            // 'header_name' => '',
            //     'isNotImport' => false,
            // ],
            'DATATABLE_' . self::PERMISSION_NamaLengkap => [
                'column_name' => self::PERMISSION_NamaLengkap,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Nama Lengkap',
                'class' => '',
                'isDate' => false,
                'header_name' => 'nama_lengkap',
            ],
            'DATATABLE_' . self::PERMISSION_TanggalLahir => [
                'column_name' => self::PERMISSION_TanggalLahir,
                'validator' => 'nullable|date',
                'validator_message' => [
                    'date' => 'Format Tanggal Lahir Tidak Sesuai'
                ],
                'name' => 'Tanggal Lahir',
                'class' => 'text-center',
                'isDate' => true,
                'header_name' => 'tgl_lahir',
            ],
            'DATATABLE_' . self::PERMISSION_Gender => [
                'column_name' => self::PERMISSION_Gender,
                'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_GENDER_CHOICE)),
                'validator_message' => [
                    'in' => 'Nilai Gender Tidak Sesuai'
                ],
                'name' => 'Gender',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'l_p',
            ],
            'DATATABLE_' . self::PERMISSION_Pendidikan => [
                'column_name' => self::PERMISSION_Pendidikan,
                'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_PENDIDIKAN_CHOICE)),
                'validator_message' => [
                    'in' => 'Nilai Pendidikan Tidak Sesuai'
                ],
                'name' => 'Pendidikan',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'pendidikan',
            ],
            'DATATABLE_' . self::PERMISSION_LevelBahasa => [
                'column_name' => self::PERMISSION_LevelBahasa,
                'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_LEVEL_BAHASA_CHOICE)),
                'validator_message' => [
                    'in' => 'Nilai Level Bahasa Tidak Sesuai'
                ],
                'name' => 'Level Bahasa',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'level_bahasa',
            ],
            'DATATABLE_' . self::PERMISSION_TahunTerbit => [
                'column_name' => self::PERMISSION_TahunTerbit,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Tahun Terbit',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'tahun_lulus',
            ],
            'DATATABLE_' . self::PERMISSION_LamaDiJepang => [
                'column_name' => self::PERMISSION_LamaDiJepang,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Lama Di Jepang',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'lama_di_jepang',
            ],
            'DATATABLE_' . self::PERMISSION_TanggalPulang => [
                'column_name' => self::PERMISSION_TanggalPulang,
                'validator' => 'nullable|date',
                'validator_message' => [
                    'date' => 'Format Tanggal Pulang Tidak Sesuai'
                ],
                'name' => 'Tanggal Pulang',
                'class' => 'text-center',
                'isDate' => true,
                'header_name' => 'tanggal_pulang',
            ],
            'DATATABLE_' . self::PERMISSION_Sensei => [
                'column_name' => self::PERMISSION_Sensei,
                'validator' => 'nullable|in:' . implode(',', ['YA', 'TIDAK']),
                'validator_message' => [
                    'in' => 'Nilai Sensei Tidak Sesuai'
                ],
                'name' => 'Sensei',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'sensei',
            ],
            'DATATABLE_' . self::PERMISSION_Dokumen => [
                'column_name' => self::PERMISSION_Dokumen,
                'validator' => 'nullable|in:' . implode(',', ['YA', 'TIDAK']),
                'validator_message' => [
                    'in' => 'Nilai Dokumen Tidak Sesuai'
                ],
                'name' => 'Dokumen',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'dokumen',
            ],
            'DATATABLE_' . self::PERMISSION_Penerjemah => [
                'column_name' => self::PERMISSION_Penerjemah,
                'validator' => 'nullable|in:' . implode(',', ['YA', 'TIDAK']),
                'validator_message' => [
                    'in' => 'Nilai Penerjemah Tidak Sesuai'
                ],
                'name' => 'Penerjemah',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'penerjemah',
            ],
            'DATATABLE_' . self::PERMISSION_EstimasiGaji => [
                'column_name' => self::PERMISSION_EstimasiGaji,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Estimasi Gaji',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'estimasi_gaji',
            ],
            'DATATABLE_' . self::PERMISSION_Domisili => [
                'column_name' => self::PERMISSION_Domisili,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Domisili',
                'class' => '',
                'isDate' => false,
                'header_name' => 'domisili',
            ],
            'DATATABLE_' . self::PERMISSION_Penempatankerja => [
                'column_name' => self::PERMISSION_Penempatankerja,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Preferensi Lokasi',
                'class' => '',
                'isDate' => false,
                'header_name' => 'bersedia_di_kota',
            ],
            'DATATABLE_' . self::PERMISSION_TglSiapkerja => [
                'column_name' => self::PERMISSION_TglSiapkerja,
                'validator' => 'nullable|date',
                'validator_message' => [
                    'date' => 'Format Tanggal Siap Bekerja Tidak Sesuai'
                ],
                'name' => 'Siap Bekerja',
                'class' => 'text-center',
                'isDate' => true,
                'header_name' => 'siap_bekerja',
            ],
            'DATATABLE_' . self::PERMISSION_BidangKerjadiJepang => [
                'column_name' => self::PERMISSION_BidangKerjadiJepang,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Bidang Kerjadi Jepang',
                'class' => '',
                'isDate' => false,
                'header_name' => 'bidang_kerja_di_jepang',
            ],
            'DATATABLE_' . self::PERMISSION_BidangKerjaPilihan => [
                'column_name' => self::PERMISSION_BidangKerjaPilihan,
                // 'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_JOB_PILIHAN_INDO_CHOICE)),
                // 'validator_message' => [
                //     'in' => 'Nilai Bidang Kerja Pilihan Tidak Sesuai'
                // ],
                'name' => 'Bidang Kerja Pilihan',
                'class' => '',
                'isDate' => false,
                'header_name' => 'bidang_kerja_pilihan',
            ],
            'DATATABLE_' . self::PERMISSION_Senmongkyu => [
                'column_name' => self::PERMISSION_Senmongkyu,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Senmongkyu',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'senmongkyu',
            ],
            'DATATABLE_' . self::PERMISSION_BidangSenmongkyu => [
                'column_name' => self::PERMISSION_BidangSenmongkyu,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Bidang Senmongkyu',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'bidang_senmongkyu',
            ],
            'DATATABLE_' . self::PERMISSION_JenisVisa => [
                'column_name' => self::PERMISSION_JenisVisa,
                'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_JENIS_VISA_CHOICE)),
                'validator_message' => [
                    'in' => 'Nilai Jenis Visa Tidak Sesuai'
                ],
                'name' => 'Jenis Visa',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'jenis_visa',
            ],
            'DATATABLE_' . self::PERMISSION_Provinsi => [
                'column_name' => self::PERMISSION_Provinsi,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Provinsi',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'provinsi',
            ],
            'DATATABLE_' . self::PERMISSION_Kota => [
                'column_name' => self::PERMISSION_Kota,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Kota',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'kota',
            ],
            'DATATABLE_' . self::PERMISSION_NamaTikTok => [
                'column_name' => self::PERMISSION_NamaTikTok,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Nama TikTok',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'nama_tiktok',
            ],
            'DATATABLE_' . self::PERMISSION_NamaInstagram => [
                'column_name' => self::PERMISSION_NamaInstagram,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Nama Instagram',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'nama_instagram',
            ],
            'DATATABLE_' . self::PERMISSION_NoTelpIndonesia => [
                'column_name' => self::PERMISSION_NoTelpIndonesia,
                'validator' => '',
                'validator_message' => [],
                'name' => 'No Telp Indonesia',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'no_telp_indonesia',
            ],
            'DATATABLE_' . self::PERMISSION_NoTelpJepang => [
                'column_name' => self::PERMISSION_NoTelpJepang,
                'validator' => '',
                'validator_message' => [],
                'name' => 'No Telp Jepang',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'no_telp_jepang',
            ],
            'DATATABLE_' . self::PERMISSION_Email => [
                'column_name' => self::PERMISSION_Email,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Email',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'email',
            ],
            'DATATABLE_' . self::PERMISSION_PICSales => [
                'column_name' => self::PERMISSION_PICSales,
                // 'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_SALES_CHOICE)),
                // 'validator_message' => [
                //     'in' => 'Nilai PIC/Sales Tidak Sesuai'
                // ],
                'validator' => '',
                'validator_message' => [],
                'name' => 'PIC/Sales',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'pic_sales',
            ],
            'DATATABLE_' . self::PERMISSION_NamaLPK => [
                'column_name' => self::PERMISSION_NamaLPK,
                'validator' => '',
                'validator_message' => [],
                'name' => 'Nama LPK',
                'class' => 'text-center',
                'isDate' => false,
                'header_name' => 'nama_lpk',
            ],
            // 'DATATABLE_' . self::PERMISSION_EstimasiGajiTop => [
            // 'column_name' => self::PERMISSION_EstimasiGajiTop,
            // 'validator' => '',
            // 'validator_message' => [],
            //     'name' => 'Estimasi Gaji Top',
            //     'class' => 'text-center',
            //     'isNotImport' => true,
            //     'isDate' => false,
            // 'header_name' => '',
            // ],
            // 'DATATABLE_' . self::PERMISSION_Keterangan => [
            // 'column_name' => self::PERMISSION_Keterangan,
            // 'validator' => '',
            // 'validator_message' => [],
            //     'name' => 'Keterangan',
            //     'class' => 'text-center',
            //     'isNotImport' => true,
            //     'isDate' => false,
            // 'header_name' => '',
            // ],
        ];
    }
    public static function EXATA_IMPORT_PIPELINE_CHOICE()
    {
        // EXATA_IMPORT_PIPELINE_CHOICE =
        return [

            'DATATABLE_' . self::PERMISSION_KodeUnik => [
                'validator' => "required|exists:exatas," . self::PERMISSION_KodeUnik,
                'validator_message' => ['exists' => 'Kode Unik tidak terdaftar'],
                'name' => 'Kode Unik',
                'class' => '',
                'isDate' => false,
            ],

            'DATATABLE_' . self::PERMISSION_NamaLengkap => [
                'validator' => "required|exists:exatas," . self::PERMISSION_NamaLengkap,
                'validator_message' => ['exists' => 'Nama Lengkap tidak terdaftar'],
                'name' => 'Nama Lengkap',
                'class' => '',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Pipeline => [
                'validator' => 'nullable|in:' . implode(',', array_values(Exata::FILTER_PIPELINE_CHOICE)),
                'validator_message' => [
                    'in' => 'Nilai Pipeline Tidak Sesuai'
                ],
                'name' => 'Pipeline',
                'class' => 'text-center',
                'isDate' => false,
            ],
        ];
    }

    public static function EXATA_DATATABLE_PREVIEW_CHOICE()
    {
        return [

            'DATATABLE_' . self::PERMISSION_KodeUnik => [
                'name' => 'Kode unik',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_TanggalLahir => [
                'name' => 'Umur',
                'class' => 'text-center',
                'isDate' => true,
                'render' => function ($item) {
                    return Carbon::parse($item['TanggalLahir'])->age;
                }
            ],
            'DATATABLE_' . self::PERMISSION_Gender => [
                'name' => 'Gender',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Pendidikan => [
                'name' => 'Pendidikan terakhir',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_LevelBahasa => [
                'name' => 'Level bahasa',
                'class' => 'text-center',
                'isDate' => false,
                'render' => function ($item) {
                    return (!$item['LevelBahasa'] || $item['LevelBahasa'] == self::FILTER_LEVEL_BAHASA_CHOICE[self::FILTER_LEVEL_BAHASA_TIDAK_PUNYA]) ? '-' : $item['LevelBahasa'];
                }
            ],
            'DATATABLE_' . self::PERMISSION_LamaDiJepang => [
                'name' => 'Lama di Jepang',
                'class' => 'text-center',
                'isDate' => false,
                'render' => function ($item) {
                    $years = floor($item['LamaDiJepang'] / 12);
                    $remainingMonths = $item['LamaDiJepang'] % 12;

                    $result = '';

                    if ($years > 0) {
                        $result .= $years . ' tahun ';
                    }

                    if ($remainingMonths > 0) {
                        $result .= $remainingMonths . ' bulan';
                    }

                    return trim($result);
                }
            ],
            'DATATABLE_' . self::PERMISSION_EstimasiGaji => [
                'name' => 'Estimasi gaji',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
                'render' => function ($item) {
                    return "Rp " . $item['EstimasiGaji'] * 0.000001 . " Juta";
                }
            ],
            'DATATABLE_' . self::PERMISSION_Domisili => [
                'name' => 'Domisili',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_TglSiapkerja => [
                'name' => 'Siap kerja tanggal',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_BidangKerjadiJepang => [
                'name' => 'Bidang kerja di Jepang',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_BidangKerjaPilihan => [
                'name' => 'Bidang kerja pilihan',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Sensei => [
                'name' => 'Bersedia kerja LPK',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
                'render' => function ($item) {
                    $c = false;
                    $html = "";
                    if ($item['Sensei'] == 'YA') {
                        $html .= "Sensei";
                        $c = true;
                    }
                    if ($item['Penerjemah'] == 'YA') {
                        $html .= ($c ? ($item['Dokumen'] == 'YA' ? ", " : " dan ") : "") . "penerjemah";
                        $c = true;
                    }
                    if ($item['Dokumen'] == 'YA') {
                        $html .= ($c ? " dan " : "") . "admin";
                    }
                    return $html;
                }
            ],
            'DATATABLE_' . self::PERMISSION_SoftSkill => [
                'name' => 'Soft skill',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_SkillKomputer => [
                'name' => 'Skill komputer',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Keterangan => [
                'name' => 'Keterangan',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
        ];
    }
    public static function EXATA_DATATABLE_CHOICE()
    {
        return [

            'DATATABLE_' . self::PERMISSION_KodeUnik => [
                'name' => 'Kode unik',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_SertifikatBahasaJepang => [
                'name' => 'Sertifikat bahasa Jepang',
                'class' => 'text-center',
                'isDate' => false,
                'sortable' => false,
                'searchable' => false,
                'isExport' => false,
                'render' => function ($item) {
                    $id = Crypt::encrypt($item['id']);
                    $html = '';
                    if (!$item['exataJapaneseLanguageCertificates']->isEmpty()) {

                        $html = "<div class='col-auto mb-2'>
                            <button 
                                class='btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#showCandidateAttachmentModal'
                                x-data
                                @click=\"\$dispatch('showFileJapaneseLanguageCertificate', { id: '" . $id . "' })\"
                            >
                            <i class='ki-duotone ki-eye fs-3'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                            </button>
                        </div>";
                    }

                    return $html;
                },

            ],
            'DATATABLE_' . self::PERMISSION_Cv => [
                'name' => 'CV',
                'class' => 'text-center',
                'isDate' => false,
                'sortable' => false,
                'searchable' => false,
                'isExport' => false,
                'render' => function ($item) {
                    $id = Crypt::encrypt($item['id']);
                    $html = '';
                    if (!$item['exataCurriculumVitaes']->isEmpty()) {

                        $html = "<div class='col-auto mb-2'>
                            <button 
                                class='btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#showCandidateAttachmentModal'
                                x-data
                                @click=\"\$dispatch('showFileCurriculumVitae', { id: '" . $id . "' })\"
                            >
                            <i class='ki-duotone ki-eye fs-3'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                            </button>
                        </div>";
                    }

                    return $html;
                },
            ],
            'DATATABLE_' . self::PERMISSION_TglInput => [
                'name' => 'Tgl input',
                'class' => 'text-center',
                'isDate' => true,
            ],
            'DATATABLE_' . self::PERMISSION_Pipeline => [
                'name' => 'Pipeline',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Kategori => [
                'name' => 'Kategori',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Available => [
                'name' => 'Available',
                'class' => 'text-center',
                'isDate' => false,
                'isNotImport' => false,
            ],
            'DATATABLE_' . self::PERMISSION_NamaLengkap => [
                'name' => 'Nama lengkap',
                'class' => '',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_TanggalLahir => [
                'name' => 'Tanggal lahir',
                'class' => 'text-center',
                'isDate' => true,
            ],
            'DATATABLE_' . self::PERMISSION_Gender => [
                'name' => 'Gender',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Pendidikan => [
                'name' => 'Pendidikan',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_LevelBahasa => [
                'name' => 'Level bahasa',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_TahunTerbit => [
                'name' => 'Tahun terbit',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_LamaDiJepang => [
                'name' => 'Lama di Jepang',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_TanggalPulang => [
                'name' => 'Tanggal pulang',
                'class' => 'text-center',
                'isDate' => true,
            ],
            'DATATABLE_' . self::PERMISSION_Sensei => [
                'name' => 'Sensei',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Dokumen => [
                'name' => 'Dokumen',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Penerjemah => [
                'name' => 'Penerjemah',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_EstimasiGaji => [
                'name' => 'Estimasi gaji',
                'class' => 'text-center',
                'isDate' => false,
                'render' => function ($item) {
                    return "Rp " . $item['EstimasiGaji'] * 0.000001 . " Juta";
                }
            ],
            'DATATABLE_' . self::PERMISSION_Domisili => [
                'name' => 'Domisili',
                'class' => '',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Penempatankerja => [
                'name' => 'Preferensi lokasi',
                'class' => '',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_TglSiapkerja => [
                'name' => 'Siap bekerja',
                'class' => 'text-center',
                'isDate' => true,
            ],
            'DATATABLE_' . self::PERMISSION_BidangKerjadiJepang => [
                'name' => 'Bidang kerja di Jepang',
                'class' => '',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_BidangKerjaPilihan => [
                'name' => 'Bidang kerja pilihan',
                'class' => '',
                'isDate' => false,
                'isNotRender' => true,
                'render' => function ($item) {
                    $array = explode(',', $item['BidangKerjaPilihan']);

                    $chunks = array_chunk($array, 2);

                    $result = array_map(function ($chunk) {
                        return implode(', ', $chunk);
                    }, $chunks);

                    return implode(',<br>', $result);
                }
            ],
            'DATATABLE_' . self::PERMISSION_TinggiBadan => [
                'name' => 'Tinggi badan',
                'class' => 'text-center',
                'isDate' => false,
                'render' => function ($item) {
                    return $item['TinggiBadan'] ? $item['TinggiBadan'] . " Cm" : null;
                }
            ],
            'DATATABLE_' . self::PERMISSION_BeratBadan => [
                'name' => 'Berat badan',
                'class' => 'text-center',
                'isDate' => false,
                'render' => function ($item) {
                    return $item['BeratBadan'] ? $item['BeratBadan'] . " Kg" : null;
                }
            ],
            'DATATABLE_' . self::PERMISSION_SkillBahasaLain => [
                'name' => 'Skill bahasa lain',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_SkillKomputer => [
                'name' => 'Skill komputer',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_PencapaianTertinggi => [
                'name' => 'Pencapaian tertinggi',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_ValueSaatDiJepang => [
                'name' => 'Value saat di Jepang',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_SoftSkill => [
                'name' => 'Soft skill',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_SkillLainnya => [
                'name' => 'Skill lainnya',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_PengalamanKerja => [
                'name' => 'Pengalaman kerja',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Ref => [
                'name' => 'Ref',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Senmongkyu => [
                'name' => 'Senmongkyu',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_BidangSenmongkyu => [
                'name' => 'Bidang senmongkyu',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_JenisVisa => [
                'name' => 'Jenis visa',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Provinsi => [
                'name' => 'Provinsi',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Kota => [
                'name' => 'Kota',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_NamaTikTok => [
                'name' => 'Nama tikTok',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_NamaInstagram => [
                'name' => 'Nama instagram',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_NoTelpIndonesia => [
                'name' => 'No telp Indonesia',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_NoTelpJepang => [
                'name' => 'No telp Jepang',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Email => [
                'name' => 'Email',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_PICSales => [
                'name' => 'Sumber',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_NamaLPK => [
                'name' => 'Nama LPK',
                'class' => 'text-center',
                'isDate' => false,
            ],
            'DATATABLE_' . self::PERMISSION_Keterangan => [
                'name' => 'Keterangan',
                'class' => 'text-center',
                'isNotImport' => true,
                'isDate' => false,
            ],
        ];
    }


    const FILTER_TGL_CHOICE = [
        'FILTER_' . self::PERMISSION_TglInput => 'Tanggal Input',
        'FILTER_' . self::PERMISSION_TanggalPulang => 'Tanggal Pulang',
        'FILTER_' . self::PERMISSION_TglSiapkerja => 'Tanggal Siap Kerja',
    ];

    const FILTER_ATTACHMENT_CV = 'CV';
    const FILTER_ATTACHMENT_SERTIFIKAT_BAHASA_JEPANG = 'SERTIFIKAT_BAHASA_JEPANG';
    const FILTER_ATTACHMENT_CHOICE = [
        self::FILTER_ATTACHMENT_CV => 'CV',
        self::FILTER_ATTACHMENT_SERTIFIKAT_BAHASA_JEPANG => 'Sertifikat bahasa Jepang',
    ];

    const FILTER_KATEGORI_BLACKLIST = 'Blacklist';
    const FILTER_KATEGORI_PRIORITAS = 'Prioritas';
    const FILTER_KATEGORI_CHOICE = [
        self::FILTER_KATEGORI_BLACKLIST => 'BlackList',
        self::FILTER_KATEGORI_PRIORITAS => 'Prioritas',
    ];

    const FILTER_GENDER_L = 'L';
    const FILTER_GENDER_P = 'P';
    const FILTER_GENDER_CHOICE = [
        self::FILTER_GENDER_L => 'L',
        self::FILTER_GENDER_P => 'P',
    ];

    const FILTER_AVAILABLE_AVAILABLE = 'AVAILABEL';
    const FILTER_AVAILABLE_SUDAH_BEKERJA = 'SUDAH BEKERJA';
    const FILTER_AVAILABLE_CANCEL = 'CANCEL';
    const FILTER_AVAILABLE_CHOICE = [
        self::FILTER_AVAILABLE_AVAILABLE => 'Available',
        self::FILTER_AVAILABLE_SUDAH_BEKERJA => 'Sudah Bekerja',
        self::FILTER_AVAILABLE_CANCEL => 'Cancel',
    ];


    const FILTER_JENIS_VISA_Specified_Skilled_Worker_I = 'SPECIFIED SKILLED WORKER (I)';
    const FILTER_JENIS_VISA_Technical_Intern_Training_I_B = 'TECHNICAL INTERN TRAINING (I) (B)';
    const FILTER_JENIS_VISA_Technical_Intern_Training_II_B = 'TECHNICAL INTERN TRAINING (II) (B)';
    const FILTER_JENIS_VISA_Technical_Intern_Training_III_B = 'TECHNICAL INTERN TRAINING (III) (B)';
    const FILTER_JENIS_VISA_Designated_Activities = 'DESIGNATED ACTIVITIES';
    const FILTER_JENIS_VISA_Dependent = 'DEPENDENT';
    const FILTER_JENIS_VISA_Engineering = 'ENGINEERING';
    const FILTER_JENIS_VISA_Medical_Services = 'MEDICAL SERVICES';
    const FILTER_JENIS_VISA_Intra_Company_Transferee = 'INTRA COMPANY TRANSFEREE';
    const FILTER_JENIS_VISA_Skilled_Labor = 'SKILLED LABOR';
    const FILTER_JENIS_VISA_Nursing_Care = 'NURSING CARE';

    const FILTER_JENIS_VISA_CHOICE = [
        self::FILTER_JENIS_VISA_Specified_Skilled_Worker_I => 'SPECIFIED SKILLED WORKER (I)',
        self::FILTER_JENIS_VISA_Technical_Intern_Training_I_B => 'TECHNICAL INTERN TRAINING (I) (B)',
        self::FILTER_JENIS_VISA_Technical_Intern_Training_II_B => 'TECHNICAL INTERN TRAINING (II) (B)',
        self::FILTER_JENIS_VISA_Technical_Intern_Training_III_B => 'TECHNICAL INTERN TRAINING (III) (B)',
        self::FILTER_JENIS_VISA_Designated_Activities => 'DESIGNATED ACTIVITIES',
        self::FILTER_JENIS_VISA_Dependent => 'DEPENDENT',
        self::FILTER_JENIS_VISA_Engineering => 'ENGINEERING',
        self::FILTER_JENIS_VISA_Medical_Services => 'MEDICAL SERVICES',
        self::FILTER_JENIS_VISA_Intra_Company_Transferee => 'INTRA COMPANY TRANSFEREE',
        self::FILTER_JENIS_VISA_Skilled_Labor => 'SKILLED LABOR',
        self::FILTER_JENIS_VISA_Nursing_Care => 'NURSING CARE',
    ];

    const FILTER_SALES_AINUL = 'AINUL_EXATA';
    const FILTER_SALES_KIM = 'KIM_EXATA';
    const FILTER_SALES_SLAMET = 'SLAMET_EXATA';
    const FILTER_SALES_CHOICE = [
        self::FILTER_SALES_AINUL => 'AINUL EXATA - SALES 1',
        self::FILTER_SALES_KIM => 'KIM EXATA - SALES 2',
        self::FILTER_SALES_SLAMET => 'SELAMET EXATA - SALES 3',
    ];

    const FILTER_PENDIDIKAN_SMA_SMK = 'SMA_SMK';
    const FILTER_PENDIDIKAN_D1 = 'D1';
    const FILTER_PENDIDIKAN_D3 = 'D3';
    const FILTER_PENDIDIKAN_S1 = 'S1';
    const FILTER_PENDIDIKAN_S2 = 'S2';
    const FILTER_PENDIDIKAN_CHOICE = [
        self::FILTER_PENDIDIKAN_SMA_SMK => 'SMA / SMK',
        self::FILTER_PENDIDIKAN_D1 => 'D1',
        self::FILTER_PENDIDIKAN_D3 => 'D3',
        self::FILTER_PENDIDIKAN_S1 => 'S1',
        self::FILTER_PENDIDIKAN_S2 => 'S2',
    ];

    const FILTER_LEVEL_BAHASA_N1 = 'N1';
    const FILTER_LEVEL_BAHASA_N2 = 'N2';
    const FILTER_LEVEL_BAHASA_N3 = 'N3';
    const FILTER_LEVEL_BAHASA_N4 = 'N4';
    const FILTER_LEVEL_BAHASA_N5 = 'N5';
    const FILTER_LEVEL_BAHASA_TIDAK_PUNYA = 'TIDAK_PUNYA';
    const FILTER_LEVEL_BAHASA_CHOICE = [
        self::FILTER_LEVEL_BAHASA_N1 => 'N1',
        self::FILTER_LEVEL_BAHASA_N2 => 'N2',
        self::FILTER_LEVEL_BAHASA_N3 => 'N3',
        self::FILTER_LEVEL_BAHASA_N4 => 'N4',
        self::FILTER_LEVEL_BAHASA_N5 => 'N5',
        self::FILTER_LEVEL_BAHASA_TIDAK_PUNYA => 'TIDAK PUNYA',
    ];

    const FILTER_JOB_SENSEI = 'SENSEI';
    const FILTER_JOB_STAFF_DOKUMEN = 'STAFF_DOKUMEN';
    const FILTER_JOB_PENERJEMAH = 'PENERJEMAH';
    const FILTER_JOB_CHOICE = [
        self::FILTER_JOB_SENSEI => 'Sensei',
        self::FILTER_JOB_STAFF_DOKUMEN => 'Staff Dokumen',
        self::FILTER_JOB_PENERJEMAH => 'Penerjemah',
    ];

    const FILTER_JOB_PILIHAN_INDO_Administrasi_Dan_Sumber_Daya_Manusia_HR = 'Administrasi Dan Sumber Daya Manusia (HR)';
    const FILTER_JOB_PILIHAN_INDO_Administrasi_Perkantoran = 'Administrasi Perkantoran';
    const FILTER_JOB_PILIHAN_INDO_Hotel = 'Hotel';
    const FILTER_JOB_PILIHAN_INDO_Hukum_Dan_Legal = 'Hukum Dan Legal';
    const FILTER_JOB_PILIHAN_INDO_Industri_Kreatif_Seni_Dan_Media = 'Industri Kreatif, Seni, Dan Media';
    const FILTER_JOB_PILIHAN_INDO_Kesehatan_Dan_Medis_Perawat_Farmasi = 'Kesehatan Dan Medis (Perawat, Farmasi)';
    const FILTER_JOB_PILIHAN_INDO_Keuangan_Dan_Perbankan = 'Keuangan Dan Perbankan';
    const FILTER_JOB_PILIHAN_INDO_Logistik_Dan_Transportasi = 'Logistik Dan Transportasi';
    const FILTER_JOB_PILIHAN_INDO_Manufaktur_Pabrik = 'Manufaktur / Pabrik';
    const FILTER_JOB_PILIHAN_INDO_Otomotif_Bengkel = 'Otomotif/Bengkel';
    const FILTER_JOB_PILIHAN_INDO_Pariwisata_Dan_Agen_Perjalanan = 'Pariwisata Dan Agen Perjalanan';
    const FILTER_JOB_PILIHAN_INDO_Pembangunan_Konstruksi = 'Pembangunan (Konstruksi)';
    const FILTER_JOB_PILIHAN_INDO_Pendidikan_Dan_Akademis = 'Pendidikan Dan Akademis';
    const FILTER_JOB_PILIHAN_INDO_Pengelasan = 'Pengelasan';
    const FILTER_JOB_PILIHAN_INDO_Perikanan_Dan_Kelautan = 'Perikanan Dan Kelautan';
    const FILTER_JOB_PILIHAN_INDO_Pertanian_Dan_Perkebunan = 'Pertanian Dan Perkebunan';
    const FILTER_JOB_PILIHAN_INDO_Restoran = 'Restoran';
    const FILTER_JOB_PILIHAN_INDO_Ritel_Dan_Perdagangan_Grosir_Eceran = 'Ritel Dan Perdagangan (Grosir/Eceran)';
    const FILTER_JOB_PILIHAN_INDO_Sensei_Guru_Bahasa_Jepang = 'Sensei/Guru Bahasa Jepang';
    const FILTER_JOB_PILIHAN_INDO_Teknologi_Informasi_IT_Dan_Telekomunikasi = 'Teknologi Informasi (IT) Dan Telekomunikasi';
    const FILTER_JOB_PILIHAN_INDO_Tekstil_Dan_Garmen = 'Tekstil Dan Garmen';
    const FILTER_JOB_PILIHAN_INDO_Lainnya = 'Lainnya';

    const FILTER_JOB_PILIHAN_INDO_CHOICE = [
        self::FILTER_JOB_PILIHAN_INDO_Administrasi_Dan_Sumber_Daya_Manusia_HR => 'Administrasi Dan Sumber Daya Manusia (HR)',
        self::FILTER_JOB_PILIHAN_INDO_Administrasi_Perkantoran => 'Administrasi Perkantoran',
        self::FILTER_JOB_PILIHAN_INDO_Hotel => 'Hotel',
        self::FILTER_JOB_PILIHAN_INDO_Hukum_Dan_Legal => 'Hukum Dan Legal',
        self::FILTER_JOB_PILIHAN_INDO_Industri_Kreatif_Seni_Dan_Media => 'Industri Kreatif, Seni, Dan Media',
        self::FILTER_JOB_PILIHAN_INDO_Kesehatan_Dan_Medis_Perawat_Farmasi => 'Kesehatan Dan Medis (Perawat, Farmasi)',
        self::FILTER_JOB_PILIHAN_INDO_Keuangan_Dan_Perbankan => 'Keuangan Dan Perbankan',
        self::FILTER_JOB_PILIHAN_INDO_Logistik_Dan_Transportasi => 'Logistik Dan Transportasi',
        self::FILTER_JOB_PILIHAN_INDO_Manufaktur_Pabrik => 'Manufaktur / Pabrik',
        self::FILTER_JOB_PILIHAN_INDO_Otomotif_Bengkel => 'Otomotif/Bengkel',
        self::FILTER_JOB_PILIHAN_INDO_Pariwisata_Dan_Agen_Perjalanan => 'Pariwisata Dan Agen Perjalanan',
        self::FILTER_JOB_PILIHAN_INDO_Pembangunan_Konstruksi => 'Pembangunan (Konstruksi)',
        self::FILTER_JOB_PILIHAN_INDO_Pendidikan_Dan_Akademis => 'Pendidikan Dan Akademis',
        self::FILTER_JOB_PILIHAN_INDO_Pengelasan => 'Pengelasan',
        self::FILTER_JOB_PILIHAN_INDO_Perikanan_Dan_Kelautan => 'Perikanan Dan Kelautan',
        self::FILTER_JOB_PILIHAN_INDO_Pertanian_Dan_Perkebunan => 'Pertanian Dan Perkebunan',
        self::FILTER_JOB_PILIHAN_INDO_Restoran => 'Restoran',
        self::FILTER_JOB_PILIHAN_INDO_Ritel_Dan_Perdagangan_Grosir_Eceran => 'Ritel Dan Perdagangan (Grosir/Eceran)',
        self::FILTER_JOB_PILIHAN_INDO_Sensei_Guru_Bahasa_Jepang => 'Sensei/Guru Bahasa Jepang',
        self::FILTER_JOB_PILIHAN_INDO_Teknologi_Informasi_IT_Dan_Telekomunikasi => 'Teknologi Informasi (IT) Dan Telekomunikasi',
        self::FILTER_JOB_PILIHAN_INDO_Tekstil_Dan_Garmen => 'Tekstil Dan Garmen',
        self::FILTER_JOB_PILIHAN_INDO_Lainnya => 'Lainnya',
    ];

    const PIPELINE_NEW_LEAD = 'PIPELINE_NEW_LEAD';
    const PIPELINE_BLAST = 'PIPELINE_BLAST';
    const PIPELINE_WEBINAR = 'PIPELINE_WEBINAR';
    const PIPELINE_VERIFIED = 'PIPELINE_VERIFIED';
    const PIPELINE_INTERVIEW_INTERNAL = 'PIPELINE_INTERVIEW_INTERNAL';
    const PIPELINE_PROMOTION = 'PIPELINE_PROMOTION';
    const PIPELINE_DEPOSIT = 'PIPELINE_DEPOSIT';
    const PIPELINE_INTERVIEW_PERUSAHAAN = 'PIPELINE_INTERVIEW_PERUSAHAAN';
    const PIPELINE_REFUND_DEPOSIT = 'PIPELINE_REFUND_DEPOSIT';
    const PIPELINE_LOLOS_TIDAK = 'PIPELINE_LOLOS_TIDAK';
    const PIPELINE_MASA_PROBATION = 'PIPELINE_MASA_PROBATION';
    const PIPELINE_FEEDBACK = 'PIPELINE_FEEDBACK';
    const FILTER_PIPELINE_CHOICE = [
        self::PIPELINE_NEW_LEAD => 'NEW LEAD',
        self::PIPELINE_BLAST => 'BLAST',
        self::PIPELINE_WEBINAR => 'WEBINAR',
        self::PIPELINE_VERIFIED => 'VERIFIED',
        self::PIPELINE_INTERVIEW_INTERNAL => 'INTERVIEW INTERNAL',
        self::PIPELINE_PROMOTION => 'PROMOTION',
        self::PIPELINE_DEPOSIT => 'DEPOSIT',
        self::PIPELINE_INTERVIEW_PERUSAHAAN => 'INTERVIEW PERUSAHAAN',
        self::PIPELINE_REFUND_DEPOSIT => 'REFUND DEPOSIT',
        self::PIPELINE_LOLOS_TIDAK => 'LOLOS/TIDAK',
        self::PIPELINE_MASA_PROBATION => 'MASA PROBATION',
        self::PIPELINE_FEEDBACK => 'FEEDBACK',
    ];
    const COLOR_PIPELINE_CHOICE = [
        self::PIPELINE_NEW_LEAD => 'background-color: #ffffff;',
        self::PIPELINE_BLAST => 'background-color: #ea9999;',
        self::PIPELINE_WEBINAR => 'background-color: #dd7e6b;',
        self::PIPELINE_VERIFIED => 'background-color: #f9cb9c;',
        self::PIPELINE_INTERVIEW_INTERNAL => 'background-color: #9fc5e8;',
        self::PIPELINE_PROMOTION => 'background-color: #ffe599;',
        self::PIPELINE_DEPOSIT => 'background-color: #70e7f4;',
        self::PIPELINE_INTERVIEW_PERUSAHAAN => 'background-color: #b6d7a8;',
        self::PIPELINE_REFUND_DEPOSIT => 'background-color: #93c47d;',
        self::PIPELINE_LOLOS_TIDAK => 'background-color: #d5a6bd;',
        self::PIPELINE_MASA_PROBATION => 'background-color: #00ff00;',
        self::PIPELINE_FEEDBACK => 'background-color: #ffff00;',
    ];

    public function colorPipeline()
    {
        $color = '';
        switch ($this->Pipeline) {
            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_NEW_LEAD]:

                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_NEW_LEAD];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_BLAST]:

                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_BLAST];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_WEBINAR]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_WEBINAR];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_VERIFIED]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_VERIFIED];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_INTERVIEW_INTERNAL]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_INTERVIEW_INTERNAL];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_PROMOTION]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_PROMOTION];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_DEPOSIT]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_DEPOSIT];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_INTERVIEW_PERUSAHAAN]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_INTERVIEW_PERUSAHAAN];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_REFUND_DEPOSIT]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_REFUND_DEPOSIT];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_LOLOS_TIDAK]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_LOLOS_TIDAK];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_MASA_PROBATION]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_MASA_PROBATION];
                break;

            case self::FILTER_PIPELINE_CHOICE[self::PIPELINE_FEEDBACK]:
                return self::COLOR_PIPELINE_CHOICE[self::PIPELINE_FEEDBACK];
                break;
        }
        return $color;
    }

    protected $fillable = [
        'KodeUnik',
        'Ref',
        'TglInput',
        'Pipeline',
        'Kategori',
        'NamaLengkap',
        'TanggalLahir',
        'Gender',
        'Pendidikan',
        'LevelBahasa',
        'TahunTerbit',
        'LamaDiJepang',
        'TanggalPulang',
        'Sensei',
        'Dokumen',
        'Penerjemah',
        'EstimasiGaji',
        'EstimasiGajiTop',
        'Domisili',
        'Penempatankerja',
        'TglSiapkerja',
        'BidangKerjadiJepang',
        'BidangKerjaPilihan',
        'Senmongkyu',
        'BidangSenmongkyu',
        'JenisVisa',
        'Provinsi',
        'Kota',
        'NamaTikTok',
        'NamaInstagram',
        'NoTelpIndonesia',
        'NoTelpJepang',
        'Email',
        'PICSales',
        'NamaLPK',
        'Keterangan',
        'Available',

        // Form Kandidat
        'SertifikatBahasaJepang',
        'Cv',
        'TinggiBadan',
        'BeratBadan',
        'SkillBahasaLain',
        'SkillKomputer',
        'PencapaianTertinggi',
        'ValueSaatDiJepang',
        'SoftSkill',
        'SkillLainnya',
        'PengalamanKerja',
    ];

    protected $guarded = ['id'];

    public function isDeletable()
    {
        return true;
    }

    public function isEditable()
    {
        return true;
    }

    protected static function onBoot()
    {
        self::creating(function ($model) {
            $model->KodeUnik = NumberGenerator::generate(self::class, $model);
        });
    }

    public function exataCurriculumVitaes()
    {
        return $this->hasMany(ExataCurriculumVitae::class, 'exata_id', 'id');
    }

    public function exataJapaneseLanguageCertificates()
    {
        return $this->hasMany(ExataJapaneseLanguageCertificate::class, 'exata_id', 'id');
    }
}
