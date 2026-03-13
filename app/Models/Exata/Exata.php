<?php

namespace App\Models\Exata;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class Exata extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    const PERMISSION_Ref = 'Ref';
    const PERMISSION_TglInput = 'TglInput';
    const PERMISSION_TanggalPulang = 'TanggalPulang';
    const PERMISSION_Pipeline = 'pipeline';
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
    const PERMISSION_Available = 'Available';
    const PERMISSION_Job = 'JOB';

    const EXATA_FILTER_CHOICE = [
        'FILTER_' . self::PERMISSION_Ref => 'Ref',
        'FILTER_' . self::PERMISSION_TglInput => 'Tgl Input',
        'FILTER_' . self::PERMISSION_TanggalPulang => 'Tanggal Pulang',
        'FILTER_' . self::PERMISSION_Pipeline => 'Pipeline',
        'FILTER_' . self::PERMISSION_NamaLengkap => 'Nama Lengkap',
        'FILTER_' . self::PERMISSION_Gender => 'Gender',
        'FILTER_' . self::PERMISSION_Pendidikan => 'Pendidikan',
        'FILTER_' . self::PERMISSION_LevelBahasa => 'Level Bahasa',
        'FILTER_' . self::PERMISSION_Sensei => 'Sensei',
        'FILTER_' . self::PERMISSION_Dokumen => 'Dokumen',
        'FILTER_' . self::PERMISSION_Penerjemah => 'Penerjemah',
        'FILTER_' . self::PERMISSION_BidangKerjadiJepang => 'Bidang Kerjadi Jepang',
        'FILTER_' . self::PERMISSION_BidangKerjaPilihan => 'Bidang Kerja Pilihan',
        'FILTER_' . self::PERMISSION_EstimasiGaji => 'Estimasi Gaji',
        'FILTER_' . self::PERMISSION_EstimasiGajiTop => 'Estimasi Gaji Top',
        'FILTER_' . self::PERMISSION_Domisili => 'Domisili',
        'FILTER_' . self::PERMISSION_Penempatankerja => 'Penempatan Kerja',
        'FILTER_' . self::PERMISSION_TglSiapkerja => 'tgl Siap kerja',
        // 'FILTER_' . self::PERMISSION_Senmongkyu => 'Senmongkyu',
        // 'FILTER_' . self::PERMISSION_BidangSenmongkyu => 'Bidang Senmongkyu',
        'FILTER_' . self::PERMISSION_JenisVisa => 'Jenis Visa',
        // 'FILTER_' . self::PERMISSION_Provinsi => 'Provinsi',
        // 'FILTER_' . self::PERMISSION_Kota => 'Kota',
        'FILTER_' . self::PERMISSION_NamaTikTok => 'Nama TikTok',
        'FILTER_' . self::PERMISSION_NamaInstagram => 'Nama Instagram',
        'FILTER_' . self::PERMISSION_NoTelpIndonesia => 'No Telp Indonesia',
        'FILTER_' . self::PERMISSION_NoTelpJepang => 'No Telp Jepang',
        'FILTER_' . self::PERMISSION_Email => 'Email',
        'FILTER_' . self::PERMISSION_PICSales => 'PIC Sales',
        'FILTER_' . self::PERMISSION_NamaLPK => 'Nama LPK',
        'FILTER_' . self::PERMISSION_Keterangan => 'Keterangan',
        'FILTER_' . self::PERMISSION_Available => 'Available',
        'FILTER_' . self::PERMISSION_Job => 'Job',
    ];

    const EXATA_DATATABLE_CHOICE = [
        'DATATABLE_' . self::PERMISSION_Ref => [
            'name' => 'Ref',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_TglInput => [
            'name' => 'Tgl Input',
            'class' => 'text-center',
            'isDate' => true,
        ],
        'DATATABLE_' . self::PERMISSION_Pipeline => [
            'name' => 'Pipeline',
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
            'name' => 'Nama Lengkap',
            'class' => '',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_TanggalLahir => [
            'name' => 'Tanggal Lahir',
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
            'name' => 'Level Bahasa',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_TahunTerbit => [
            'name' => 'Tahun Terbit',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_LamaDiJepang => [
            'name' => 'Lama Di Jepang',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_TanggalPulang => [
            'name' => 'Tanggal Pulang',
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
            'name' => 'Estimasi Gaji',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_Domisili => [
            'name' => 'Domisili',
            'class' => '',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_Penempatankerja => [
            'name' => 'Bersedia di Kota',
            'class' => '',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_TglSiapkerja => [
            'name' => 'Siap Bekerja',
            'class' => 'text-center',
            'isDate' => true,
        ],
        'DATATABLE_' . self::PERMISSION_BidangKerjadiJepang => [
            'name' => 'Bidang Kerjadi Jepang',
            'class' => '',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_BidangKerjaPilihan => [
            'name' => 'Bidang Kerja Pilihan',
            'class' => '',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_Senmongkyu => [
            'name' => 'Senmongkyu',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_BidangSenmongkyu => [
            'name' => 'Bidang Senmongkyu',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_JenisVisa => [
            'name' => 'Jenis Visa',
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
            'name' => 'Nama TikTok',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_NamaInstagram => [
            'name' => 'Nama Instagram',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_NoTelpIndonesia => [
            'name' => 'No Telp Indonesia',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_NoTelpJepang => [
            'name' => 'No Telp Jepang',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_Email => [
            'name' => 'Email',
            'class' => 'text-center',
            'isDate' => false,
        ],
        'DATATABLE_' . self::PERMISSION_PICSales => [
            'name' => 'PIC/Sales',
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

    const FILTER_TGL_CHOICE = [
        'FILTER_' . self::PERMISSION_TglInput => 'Tanggal Input',
        'FILTER_' . self::PERMISSION_TanggalPulang => 'Tanggal Pulang',
        'FILTER_' . self::PERMISSION_TglSiapkerja => 'Tanggal Siap Kerja',
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


    const FILTER_JENIS_VISA_Specified_Skilled_Worker_I = 'Specified Skilled Worker (I)';
    const FILTER_JENIS_VISA_Technical_Intern_Training_I_B = 'Technical Intern Training (I) (B)';
    const FILTER_JENIS_VISA_Technical_Intern_Training_II_B = 'Technical Intern Training (II) (B)';
    const FILTER_JENIS_VISA_Technical_Intern_Training_III_B = 'Technical Intern Training (III) (B)';
    const FILTER_JENIS_VISA_Designated_Activities = 'Designated Activities';
    const FILTER_JENIS_VISA_Dependent = 'Dependent';
    const FILTER_JENIS_VISA_Engineering = 'Engineering';
    const FILTER_JENIS_VISA_Medical_Services = 'Medical Services';
    const FILTER_JENIS_VISA_Intra_Company_Transferee = 'Intra Company Transferee';
    const FILTER_JENIS_VISA_Skilled_Labor = 'Skilled Labor';
    const FILTER_JENIS_VISA_Nursing_Care = 'Nursing Care';

    const FILTER_JENIS_VISA_CHOICE = [
        self::FILTER_JENIS_VISA_Specified_Skilled_Worker_I => 'Specified Skilled Worker (I)',
        self::FILTER_JENIS_VISA_Technical_Intern_Training_I_B => 'Technical Intern Training (I) (B)',
        self::FILTER_JENIS_VISA_Technical_Intern_Training_II_B => 'Technical Intern Training (II) (B)',
        self::FILTER_JENIS_VISA_Technical_Intern_Training_III_B => 'Technical Intern Training (III) (B)',
        self::FILTER_JENIS_VISA_Designated_Activities => 'Designated Activities',
        self::FILTER_JENIS_VISA_Dependent => 'Dependent',
        self::FILTER_JENIS_VISA_Engineering => 'Engineering',
        self::FILTER_JENIS_VISA_Medical_Services => 'Medical Services',
        self::FILTER_JENIS_VISA_Intra_Company_Transferee => 'Intra Company Transferee',
        self::FILTER_JENIS_VISA_Skilled_Labor => 'Skilled Labor',
        self::FILTER_JENIS_VISA_Nursing_Care => 'Nursing Care',
    ];

    const FILTER_SALES_AINUL = 'AINUL_EXATA';
    const FILTER_SALES_KIM = 'KIM_EXATA';
    const FILTER_SALES_SLAMET = 'SLAMET_EXATA';
    const FILTER_SALES_CHOICE = [
        self::FILTER_SALES_AINUL => 'Ainul',
        self::FILTER_SALES_KIM => 'Kim',
        self::FILTER_SALES_SLAMET => 'Slamet',
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
        self::FILTER_LEVEL_BAHASA_TIDAK_PUNYA => 'Tidak Punya',
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

    const PIPELINE_NEW_LEADS = 'PIPELINE_NEW_LEADS';
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
        self::PIPELINE_NEW_LEADS => 'NEW LEADS',
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

    protected $fillable = [
        'Ref',
        'TglInput',
        'pipeline',
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

    protected static function onBoot() {}
}
