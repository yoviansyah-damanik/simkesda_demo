<?php

namespace App\Helpers;

use App\Models\GeneralConfig;
use Illuminate\Support\Facades\Auth;

class DataHelper
{
    //Field Data Sasaran
    public const INPUT_SASARAN = [
        ['title' => 'Jumlah Penduduk', 'attribute' => 'jml_penduduk', 'satuan' => 'satuan_jml_penduduk', 'select' => ['orang'], 'symbol' => 'Σ'],
        ['title' => 'Jumlah Bayi Lahir Hidup', 'attribute' => 'jml_bayi_lahir_hidup', 'satuan' => 'satuan_jml_bayi_lahir_hidup', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Jumlah Bayi', 'attribute' => 'jml_bayi', 'satuan' => 'satuan_jml_bayi', 'select' => ['bayi'], 'symbol' => 'Σ'],
        ['title' => 'Jumlah Balita', 'attribute' => 'jml_balita', 'satuan' => 'satuan_jml_balita', 'select' => ['balita'], 'symbol' => '@'],
        ['title' => 'Jumlah Anak SD/sederajat Kelas 1', 'attribute' => 'jml_anak_sd_1', 'satuan' => 'satuan_jml_anak_sd_1', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Jumlah Anak SD/sederajat Kelas 2 dan 3', 'attribute' => 'jml_anak_sd_2_3', 'satuan' => 'satuan_jml_anak_sd_2_3', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Jumlah Anak Usia < 15 Tahun', 'attribute' => 'jml_anak_b_15_th', 'satuan' => 'satuan_jml_anak_b_15_th', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Jumlah Wanita Usia Subur (15-39 Tahun)', 'attribute' => 'jml_wanita_subur', 'satuan' => 'satuan_jml_wanita_subur', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Jumlah Ibu Hamil', 'attribute' => 'jml_ibu_hamil', 'satuan' => 'satuan_jml_ibu_hamil', 'select' => ['bumil'], 'symbol' => '@'],
        ['title' => 'Jumlah Ibu Bersalin', 'attribute' => 'jml_ibu_bersalin', 'satuan' => 'satuan_jml_ibu_bersalin', 'select' => ['bulin'], 'symbol' => '@'],
        ['title' => 'Jumlah Kelurahan/Desa', 'attribute' => 'jml_desa', 'satuan' => 'satuan_jml_desa', 'select' => ['kelurahan', 'desa'], 'symbol' => '@'],
    ];

    //Field Data Bulanan

    //Label Data Bulanan
    //Jumlah label sama dengan jumlah data pendukung di bawahnya
    //Contoh, label ada 2 data, berarti ada 2 data bulanan (bulanan_1, bulanan_2, dst)
    public const LABEL_BULANAN = [
        'Kesehatan Ibu dan Anak', 'Gizi', 'Imunisasi', 'Penyakit'
    ];

    //Kesehatan Ibu dan Anak
    public const BULANAN_1 = [
        ['title' => 'Kunjungan Pertama Ibu Hamil (K1)', 'attribute' => 'jml_k1', 'satuan' => 'satuan_jml_k1', 'select' => ['bumil'], 'symbol' => '@'],
        ['title' => 'Kunjungan Keempat Ibu Hamil (K4)', 'attribute' => 'jml_k4', 'satuan' => 'satuan_jml_k4', 'select' => ['bumil'], 'symbol' => '@'],
        ['title' => 'Persalinan ditolong Tenaga Kesehatan (PN)', 'attribute' => 'jml_pn', 'satuan' => 'satuan_jml_pn', 'select' => ['bulin'], 'symbol' => '@'],
        ['title' => 'Pertolongan Persalinan di Fasilitas Pelayanan Kesehatan', 'attribute' => 'jml_ps', 'satuan' => 'satuan_jml_ps', 'select' => ['bulin'], 'symbol' => '@'],
        ['title' => 'Kunjungan Nifas (KF)', 'attribute' => 'jml_kf', 'satuan' => 'satuan_jml_kf', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kunjungan Neonatus Pertama (KN1)', 'attribute' => 'jml_kn1', 'satuan' => 'satuan_jml_kn1', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kunjungan Neonatus Lengkap (KN Lengkap)', 'attribute' => 'jml_kn_lengkap', 'satuan' => 'satuan_jml_kn_lengkap', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Jumlah Bayi Lahir Hidup', 'attribute' => 'jml_bayi_lahir_hidup', 'satuan' => 'satuan_jml_bayi_lahir_hidup', 'select' => ['bayi'], 'symbol' => '@'],
    ];

    //Gizi
    public const BULANAN_2 = [
        ['title' => 'Balita ditimbang', 'attribute' => 'jml_balita_ditimbang', 'satuan' => 'satuan_jml_balita_ditimbang', 'select' => ['balita'], 'symbol' => '@'],
        ['title' => 'Balita Gizi Buruk Mendapat Perawatan', 'attribute' => 'jml_balita_gb_perawatan', 'satuan' => 'satuan_jml_balita_gb_perawatan', 'select' => ['balita'], 'symbol' => '@'],
        ['title' => 'Balita Gizi Buruk yang ditemukan', 'attribute' => 'jml_balita_gb_ditemukan', 'satuan' => 'satuan_jml_balita_gb_ditemukan', 'select' => ['balita'], 'symbol' => '@'],
    ];

    //Imunisasi
    public const BULANAN_3 = [
        ['title' => 'Imunisasi BCG pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_bcg', 'satuan' => 'satuan_jml_imun_bcg', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi Hepatitis B pada bayi kurang dari 7 hari', 'attribute' => 'jml_imun_hepatitis_b', 'satuan' => 'satuan_jml_imun_hepatitis_b', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi DPT/HB (1) pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_dpt_1', 'satuan' => 'satuan_jml_imun_dpt_1', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi DPT/HB (2) pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_dpt_2', 'satuan' => 'satuan_jml_imun_dpt_2', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi DPT/HB (3) pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_dpt_3', 'satuan' => 'satuan_jml_imun_dpt_3', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi Polio 1 pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_folio_1', 'satuan' => 'satuan_jml_imun_folio_1', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi Polio 2 pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_folio_2', 'satuan' => 'satuan_jml_imun_folio_2', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi Polio 3 pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_folio_3', 'satuan' => 'satuan_jml_imun_folio_3', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi Polio 4 pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_folio_4', 'satuan' => 'satuan_jml_imun_folio_4', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi campak pada bayi usia 0-11 bulan', 'attribute' => 'jml_imun_campak', 'satuan' => 'satuan_jml_imun_campak', 'select' => ['bayi'], 'symbol' => '@'],
        ['title' => 'Imunisasi dasar lengkap pada anak usia 0-11 bulan', 'attribute' => 'jml_imun_dasar_lengkap', 'satuan' => 'satuan_jml_imun_dasar_lengkap', 'select' => ['orang'], 'symbol' => '@'],
    ];

    //Penyakit
    public const BULANAN_4 = [
        ['title' => 'Kasus pneumonia balita', 'attribute' => 'jml_pneumonia', 'satuan' => 'satuan_jml_pneumonia', 'select' => ['balita'], 'symbol' => '@'],
        ['title' => 'Kasus Diare', 'attribute' => 'jml_diare', 'satuan' => 'satuan_jml_diare', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus AFP yang ditemukan pada penduduk usia < 15 tahun', 'attribute' => 'jml_afp', 'satuan' => 'satuan_jml_afp', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus Malaria yang dikonfirmasi Lab (Mikroskop dan RDT)', 'attribute' => 'jml_malaria_konfirmasi', 'satuan' => 'satuan_jml_malaria_konfirmasi', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus Positif Malaria', 'attribute' => 'jml_malaria_positif', 'satuan' => 'satuan_jml_malaria_positif', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus Positif Malaria yang Mendapat Pengobatan ACT', 'attribute' => 'jml_malaria_pengobatan', 'satuan' => 'satuan_jml_malaria_pengobatan', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Penderita Demam Berdarah Dengue (DBD)', 'attribute' => 'jml_dbd', 'satuan' => 'satuan_jml_dbd', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kematian akibat DBD', 'attribute' => 'jml_kematian_dbd', 'satuan' => 'satuan_jml_kematian_dbd', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Jumlah Kejadian KLB', 'attribute' => 'jml_klb', 'satuan' => 'satuan_jml_klb', 'select' => ['orang'], 'symbol' => '@'],
    ];

    //Label Data Tahunan
    //Jumlah label sama dengan jumlah data pendukung di bawahnya
    //Contoh, label ada 2 data, berarti ada 2 data tahunan (tahunan_1, tahunan_2, dst)
    public const LABEL_TAHUNAN = [
        'Penyakit', 'Promosi Kesehatan'
    ];

    // Penyakit
    public const TAHUNAN_1 = [
        ['title' => 'Kasus baru kusta PB pada anak', 'attribute' => 'jml_kusta_pb_anak', 'satuan' => 'satuan_jml_kusta_pb_anak', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus baru kusta PB dewasa', 'attribute' => 'jml_kusta_pb_dewasa', 'satuan' => 'satuan_jml_kusta_pb_dewasa', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus baru kusta MB pada anak', 'attribute' => 'jml_kusta_mb_anak', 'satuan' => 'satuan_jml_kusta_mb_anak', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus baru kusta MB dewasa', 'attribute' => 'jml_kusta_mb_dewasa', 'satuan' => 'satuan_jml_kusta_mb_dewasa', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Kasus cacat tingkat 2', 'attribute' => 'jml_cacat_tk_2', 'satuan' => 'satuan_jml_cacat_tk_2', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Penduduk Yang Minum Obat Filariasis di Kecamatan Endemis Filariasis yang melakukan POMP Filariasis', 'attribute' => 'jml_filariasis', 'satuan' => 'satuan_jml_filariasis', 'select' => ['orang'], 'symbol' => '@'],
        ['title' => 'Anak SD dan MI dan Balita yang minum Obat Cacing', 'attribute' => 'jml_obat_cacing', 'satuan' => 'satuan_jml_obat_cacing', 'select' => ['orang'], 'symbol' => '@'],
    ];

    // Promosi Kesehatan
    public const TAHUNAN_2 = [
        ['title' => 'Jumlah Posyandu', 'attribute' => 'jml_posyandu', 'satuan' => 'satuan_jml_posyandu', 'select' => ['unit'], 'symbol' => '@'],
        ['title' => 'Jumlah Desa Siaga', 'attribute' => 'jml_desa_siaga', 'satuan' => 'satuan_jml_desa_siaga', 'select' => ['unit'], 'symbol' => '@'],
        ['title' => 'Jumlah Rumah Tanggan yang ber-PHBS', 'attribute' => 'jml_rt_phbs', 'satuan' => 'satuan_jml_rt_phbs', 'select' => ['unit'], 'symbol' => '@'],
    ];

    // Field SPM

    // SPM BULANAN
    public const SPM_BULANAN = [
        ['label' => 'SPM - Pelayanan Kesehatan Ibu Hamil', 'title' => 'Jumlah semua ibu hamil di wilayah Kecamatan tersebut dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_ibu_hamil', 'satuan' => 'satuan_jml_ibu_hamil', 'select' => ['bumil'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Ibu Bersalin', 'title' => 'Jumlah semua ibu bersalin yang ada di wilayah Kecamatan tersebut dalam kurun waktu satu tahun', 'attribute' => 'jml_ibu_bersalin', 'satuan' => 'satuan_jml_ibu_bersalin', 'select' => ['bulin'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Bayi Baru Lahir', 'title' => 'Jumlah semua bayi baru lahir di wilayah Kecamatan tersebut dalam kurun waktu satu tahun', 'attribute' => 'jml_bayi_baru_lahir', 'satuan' => 'satuan_jml_bayi_baru_lahir', 'select' => ['bayi'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Balita', 'title' => 'Jumlah balita 0-59 bulan yang ada di wilayah kerja dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_balita', 'satuan' => 'satuan_jml_balita', 'select' => ['balita'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Pada Usia Pendidikan Dasar', 'title' => 'Jumlah semua anak usia pendidikan dasar kelas 1 dan 7 yang ada di wilayah kerja di wilayah Kecamatan tersebut dalam kurun waktu satu tahun ajaran', 'attribute' => 'jml_anak_kelas_1_7', 'satuan' => 'satuan_jml_anak_kelas_1_7', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Pada Usia Produktif', 'title' => 'Jumlah warga negara usia 15-59 tahun yang ada wi wilayah kerja dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_usia_15_59', 'satuan' => 'satuan_jml_usia_15_59', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Usia Lanjut', 'title' => 'Jumlah semua penduduk berusia usia 60 tahun ke atas yang ada di wilayah Kecamatan tersebut dalam kurun waktu satu tahun perhitungan', 'attribute' => 'jml_lansia', 'satuan' => 'satuan_jml_lansia', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Penderita Hipertensi', 'title' => 'Jumlah estimasi penderita hipertensi berdasarkan angka prevalensi Kecamatan dalam kurun waktu satu tahun pada tahun yang sama', 'attribute' => 'jml_penderita_hipertensi', 'satuan' => 'satuan_jml_penderita_hipertensi', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Penderita Diabetes Melitus (DM)', 'title' => 'Jumlah penyandang DM berdasarkan angka prevalensi DM nasional di wilayah kerja dalam kurun waktu satu tahun pada tahun yang sama', 'attribute' => 'jml_penyandang_dm', 'satuan' => 'satuan_jml_penyandang_dm', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Orang Dengan Gangguan Jiwa (ODGJ) Berat', 'title' => 'Jumlah ODGJ berat (psikotik) yang ada di wilayah kerja Kecamatan dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_odgj_berat', 'satuan' => 'satuan_jml_odgj_berat', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Orang Dengan Tuberkulosis (TB)', 'title' => 'Jumlah orang dengan TB yang ada di wilayah kerja pada kurun waktu satu tahun yang sama', 'attribute' => 'jml_penyandang_tb', 'satuan' => 'satuan_jml_penyandang_tb', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Orang Dengan Risiko Terinfeksi HIV', 'title' => 'Jumlah orang berisiko terinfeksi HIV yang ada di satu wilayah kerja pada kurun waktu satu tahun yang sama', 'attribute' => 'jml_risiko_infeksi_hiv', 'satuan' => 'satuan_jml_risiko_infeksi_hiv', 'select' => ['orang'], 'symbol' => '@'],
    ];

    // SPM TAHUNAN
    public const SPM_TAHUNAN = [
        ['label' => 'SPM - Pelayanan Kesehatan Ibu Hamil', 'title' => 'Jumlah semua ibu hamil di wilayah Kecamatan tersebut dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_ibu_hamil', 'satuan' => 'satuan_jml_ibu_hamil', 'select' => ['bumil'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Ibu Bersalin', 'title' => 'Jumlah semua ibu bersalin yang ada di wilayah Kecamatan tersebut dalam kurun waktu satu tahun', 'attribute' => 'jml_ibu_bersalin', 'satuan' => 'satuan_jml_ibu_bersalin', 'select' => ['bulin'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Bayi Baru Lahir', 'title' => 'Jumlah semua bayi baru lahir di wilayah Kecamatan tersebut dalam kurun waktu satu tahun', 'attribute' => 'jml_bayi_baru_lahir', 'satuan' => 'satuan_jml_bayi_baru_lahir', 'select' => ['bayi'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Balita', 'title' => 'Jumlah balita 0-59 bulan yang ada di wilayah kerja dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_balita', 'satuan' => 'satuan_jml_balita', 'select' => ['balita'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Pada Usia Pendidikan Dasar', 'title' => 'Jumlah semua anak usia pendidikan dasar kelas 1 dan 7 yang ada di wilayah kerja di wilayah Kecamatan tersebut dalam kurun waktu satu tahun ajaran', 'attribute' => 'jml_anak_kelas_1_7', 'satuan' => 'satuan_jml_anak_kelas_1_7', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Pada Usia Produktif', 'title' => 'Jumlah warga negara usia 15-59 tahun yang ada wi wilayah kerja dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_usia_15_59', 'satuan' => 'satuan_jml_usia_15_59', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Usia Lanjut', 'title' => 'Jumlah semua penduduk berusia usia 60 tahun ke atas yang ada di wilayah Kecamatan tersebut dalam kurun waktu satu tahun perhitungan', 'attribute' => 'jml_lansia', 'satuan' => 'satuan_jml_lansia', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Penderita Hipertensi', 'title' => 'Jumlah estimasi penderita hipertensi berdasarkan angka prevalensi Kecamatan dalam kurun waktu satu tahun pada tahun yang sama', 'attribute' => 'jml_penderita_hipertensi', 'satuan' => 'satuan_jml_penderita_hipertensi', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Penderita Diabetes Melitus (DM)', 'title' => 'Jumlah penyandang DM berdasarkan angka prevalensi DM nasional di wilayah kerja dalam kurun waktu satu tahun pada tahun yang sama', 'attribute' => 'jml_penyandang_dm', 'satuan' => 'satuan_jml_penyandang_dm', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Orang Dengan Gangguan Jiwa (ODGJ) Berat', 'title' => 'Jumlah ODGJ berat (psikotik) yang ada di wilayah kerja Kecamatan dalam kurun waktu satu tahun yang sama', 'attribute' => 'jml_odgj_berat', 'satuan' => 'satuan_jml_odgj_berat', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Orang Dengan Tuberkulosis (TB)', 'title' => 'Jumlah orang dengan TB yang ada di wilayah kerja pada kurun waktu satu tahun yang sama', 'attribute' => 'jml_penyandang_tb', 'satuan' => 'satuan_jml_penyandang_tb', 'select' => ['orang'], 'symbol' => '@'],
        ['label' => 'SPM - Pelayanan Kesehatan Orang Dengan Risiko Terinfeksi HIV', 'title' => 'Jumlah orang berisiko terinfeksi HIV yang ada di satu wilayah kerja pada kurun waktu satu tahun yang sama', 'attribute' => 'jml_risiko_infeksi_hiv', 'satuan' => 'satuan_jml_risiko_infeksi_hiv', 'select' => ['orang'], 'symbol' => '@'],
    ];

    public const JENIS_PUSKESMAS = ['Puskesmas Perawatan (Rawat Inap)', 'Puskesmas Non Perawatan'];
    public const KRITERIA_PUSKESMAS = ['Perkotaan', 'Perdesaan', 'Terpencil', 'Sangat Terpencil'];
    public const KEADAAN_BANGUNAN = ['Baik', 'Rusak Ringan', 'Rusak Berat'];
    public const AKREDITASI = ['A', 'B', 'C'];
    public const WAKTU_KETERSEDIAAN_LISTRIK = ['24 jam/hari', '< 24 jam/hari', 'Tidak ada'];
    public const TELEPON_KABEL = ['Ada/berfungsi', 'Ada/tidak berfungsi', 'Tidak ada'];
    public const RADIO_KOMUNIKASI = ['Very high frequency', 'High Frequency', 'Single side band', 'Tidak ada'];
    public const JARINGAN_INTERNET = ['Ada dan baik', 'Ada tetapi tidak lancar', 'Tidak ada'];
    public const SUMBER_AIR = ['PAM', 'Air Tanah', 'Mata Air', 'Air Hujan', 'Air Permukaan', 'Sumber Lainnya'];
    public const SUMBER_LISTRIK = ['PLN', 'Diesel', 'Generator', 'Tenaga Surya', 'Lainnya'];
    public const AKSES_JALAN_DEPAN = ['Aspal/Beton', 'Tanah', 'Air', 'Lainnya'];
    public const KENDARAAN_LEWAT = ['Kendaraan roda 4', 'Kendaraan bermotor roda 2', 'Perahu'];

    public static function get_frontend_menus()
    {
        return [
            [
                'title' => 'Beranda',
                'icon' => 'fas fa-home',
                'route' => 'homepage',
                'href' => route('homepage'),
            ],
            [
                'title' => 'Berita',
                'icon' => 'fas fa-newspaper',
                'route' => 'post*',
                'href' => route('post'),
            ],
            [
                'title' => 'Pengumuman',
                'icon' => 'fas fa-bullhorn',
                'route' => 'announcement*',
                'href' => route('announcement'),
            ],
            [
                'title' => 'Profil Puskesmas',
                'icon' => 'fas fa-hospital',
                'route' => 'puskesmas*',
                'href' => route('puskesmas'),
            ],
            [
                'title' => 'Grafik Data',
                'icon' => 'fas fa-chart-simple',
                'route' => 'chart*',
                'href' => route('chart'),
            ],
            [
                'title' => 'Tentang',
                'icon' => 'fas fa-house-chimney-medical',
                'route' => 'about',
                'href' => route('about'),
            ],
        ];
    }
    public static function get_backend_sidebar_menus()
    {
        $sidebars = collect([
            // DATA PUSKESMAS
            "puskesmas" => [
                'title' => 'Data Puskesmas',
                'menus' => []
            ],
            // TEMPLATE PRIORITAS
            "priority_template" => [
                'title' => 'Template Prioritas',
                'menus' => []
            ],
            //SPM
            "spm" => [
                'title' => 'SPM',
                'menus' => []
            ],
            // LAPORAN
            "report" => [
                'title' => 'Laporan',
                'menus' => [
                    [
                        'icon' => 'icon printer',
                        'title' => 'Template Prioritas',
                        'route' => 'dashboard.priority.report',
                        'link' => route('dashboard.priority.report'),
                        'childs' => []
                    ],
                    [
                        'icon' => 'icon printer',
                        'title' => 'SPM',
                        'route' => 'dashboard.spm.report',
                        'link' => route('dashboard.spm.report'),
                        'childs' => []
                    ]
                ]
            ],
            // AKUN
            "account" => [
                'title' => 'Akun',
                'menus' => [
                    [
                        'icon' => 'icon user',
                        'title' => 'Informasi Akun',
                        'route' => 'dashboard.account',
                        'link' => route('dashboard.account'),
                        'childs' => []
                    ],
                    [
                        'icon' => 'icon key',
                        'title' => 'Kata Sandi',
                        'route' => 'dashboard.account.password',
                        'link' => route('dashboard.account.password'),
                        'childs' => []
                    ],
                ]
            ],
        ]);

        if (in_array(Auth::user()->role_name, ['Superadmin', 'Administrator', 'Peninjau'])) {
            $sidebars = $sidebars->map(function ($item, $key) {
                if ($key == 'puskesmas')
                    return [
                        'title' => $item['title'],
                        'menus' => [
                            [
                                'icon' => 'icon document',
                                'title' => 'Profil Puskesmas',
                                'route' => 'dashboard.puskesmas*',
                                'link' => route('dashboard.puskesmas'),
                                'childs' => []
                            ]
                        ]
                    ];

                if ($key == 'priority_template')
                    return [
                        'title' => $item['title'],
                        'menus' => [
                            [
                                'icon' => 'icon database',
                                'title' => 'Gambaran',
                                'route' => 'dashboard.priority',
                                'link' => route('dashboard.priority'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon document',
                                'title' => 'Data Sasaran',
                                'route' => 'dashboard.priority.target*',
                                'link' => route('dashboard.priority.target'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon document',
                                'title' => 'Data Bulanan',
                                'route' => 'dashboard.priority.monthly*',
                                'link' => route('dashboard.priority.monthly'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon document',
                                'title' => 'Data Tahunan',
                                'route' => 'dashboard.priority.yearly*',
                                'link' => route('dashboard.priority.yearly'),
                                'childs' => []
                            ]
                        ]
                    ];

                if ($key == 'spm')
                    return [
                        'title' => $item['title'],
                        'menus' => [
                            [
                                'icon' => 'icon database',
                                'title' => 'Gambaran',
                                'route' => 'dashboard.spm',
                                'link' => route('dashboard.spm'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon document',
                                'title' => 'SPM Sasaran',
                                'route' => 'dashboard.spm.target*',
                                'link' => route('dashboard.spm.target'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon document',
                                'title' => 'SPM Tahunan',
                                'route' => 'dashboard.spm.yearly*',
                                'link' => route('dashboard.spm.yearly'),
                                'childs' => []
                            ]
                        ]
                    ];

                return $item;
            });

            if (Auth::user()->role_name != 'Peninjau') {
                $sidebars->prepend(
                    // MENU INFORMASI
                    [
                        'title' => 'Informasi',
                        'menus' => [
                            [
                                'icon' => 'icon book',
                                'title' => 'Berita',
                                'route' => 'dashboard.post*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Berita',
                                        'route' => 'dashboard.post',
                                        'link' => route('dashboard.post'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Berita',
                                        'route' => 'dashboard.post.create',
                                        'link' => route('dashboard.post.create'),
                                    ]
                                ]
                            ],
                            [
                                'icon' => 'icon clipboard',
                                'title' => 'Pengumuman',
                                'route' => 'dashboard.announcement*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Pengumuman',
                                        'route' => 'dashboard.announcement',
                                        'link' => route('dashboard.announcement'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Pengumuman',
                                        'route' => 'dashboard.announcement.create',
                                        'link' => route('dashboard.announcement.create'),
                                    ]
                                ]
                            ],
                            [
                                'icon' => 'icon notification',
                                'title' => 'Notifikasi Dashboard',
                                'route' => 'dashboard.notification*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Notifikasi',
                                        'route' => 'dashboard.notification',
                                        'link' => route('dashboard.notification'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Notifikasi',
                                        'route' => 'dashboard.notification.create',
                                        'link' => route('dashboard.notification.create'),
                                    ]
                                ]
                            ],
                        ],
                    ],
                    "information"
                );

                if (Auth::user()->role_name == 'Superadmin') {
                    $sidebars->put("administrator", [
                        'title' => 'Administrator',
                        'menus' => [
                            [
                                'icon' => 'icon monitor',
                                'title' => 'Dinas',
                                'route' => 'dashboard.dinas*',
                                'link' => route('dashboard.dinas'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon user-3',
                                'title' => 'Manajemen Pengguna',
                                'route' => 'dashboard.user*',
                                'link' => route('dashboard.user'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon airplay',
                                'title' => 'Slider',
                                'route' => 'dashboard.slider*',
                                'link' => '#',
                                'childs' =>
                                [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Slider',
                                        'route' => 'dashboard.slider',
                                        'link' => route('dashboard.slider'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Slider',
                                        'route' => 'dashboard.slider.create',
                                        'link' => route('dashboard.slider.create'),
                                    ]
                                ]
                            ],
                        ]
                    ]);
                } else {
                    $sidebars->put("administrator", [
                        'title' => 'Administrator',
                        'menus' => [
                            [
                                'icon' => 'icon monitor',
                                'title' => 'Dinas',
                                'route' => 'dashboard.dinas*',
                                'link' => route('dashboard.dinas'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon airplay',
                                'title' => 'Slider',
                                'route' => 'dashboard.slider*',
                                'link' => '#',
                                'childs' =>
                                [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Slider',
                                        'route' => 'dashboard.slider',
                                        'link' => route('dashboard.slider'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Slider',
                                        'route' => 'dashboard.slider.create',
                                        'link' => route('dashboard.slider.create'),
                                    ]
                                ]
                            ],
                        ]
                    ]);
                }
            }
        } else {
            $sidebars = $sidebars->map(function ($item, $key) {
                if ($key == 'puskesmas')
                    return [
                        'title' => $item['title'],
                        'menus' => [
                            [
                                'icon' => 'icon list',
                                'title' => 'List Profil Puskesmas',
                                'route' => 'dashboard.puskesmas',
                                'link' => route('dashboard.puskesmas'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon plus',
                                'title' => 'Tambah Profil Puskesmas',
                                'route' => 'dashboard.puskesmas.create',
                                'link' => route('dashboard.puskesmas.create'),
                                'childs' => []
                            ]
                        ]
                    ];

                if ($key == 'priority_template')
                    return [
                        'title' => $item['title'],
                        'menus' => [
                            [
                                'icon' => 'icon database',
                                'title' => 'Gambaran',
                                'route' => 'dashboard.priority',
                                'link' => route('dashboard.priority'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon folder',
                                'title' => 'Data Sasaran',
                                'route' => 'dashboard.priority.target*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Data Sasaran',
                                        'route' => 'dashboard.priority.target',
                                        'link' => route('dashboard.priority.target'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Data Sasaran',
                                        'route' => 'dashboard.priority.target.create',
                                        'link' => route('dashboard.priority.target.create'),
                                    ]
                                ]
                            ],
                            [
                                'icon' => 'icon folder',
                                'title' => 'Data Bulanan',
                                'route' => 'dashboard.priority.monthly*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Data Bulanan',
                                        'route' => 'dashboard.priority.monthly',
                                        'link' => route('dashboard.priority.monthly'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Data Bulanan',
                                        'route' => 'dashboard.priority.monthly.create',
                                        'link' => route('dashboard.priority.monthly.create'),
                                    ]
                                ]
                            ],
                            [
                                'icon' => 'icon folder',
                                'title' => 'Data Tahunan',
                                'route' => 'dashboard.priority.yearly*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List Data Tahunan',
                                        'route' => 'dashboard.priority.yearly',
                                        'link' => route('dashboard.priority.yearly'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah Data Tahunan',
                                        'route' => 'dashboard.priority.yearly.create',
                                        'link' => route('dashboard.priority.yearly.create'),
                                    ]
                                ]
                            ],
                        ]
                    ];

                if ($key == 'spm')
                    return [
                        'title' => $item['title'],
                        'menus' => [
                            [
                                'icon' => 'icon database',
                                'title' => 'Gambaran',
                                'route' => 'dashboard.spm',
                                'link' => route('dashboard.spm'),
                                'childs' => []
                            ],
                            [
                                'icon' => 'icon folder',
                                'title' => 'SPM Sasaran',
                                'route' => 'dashboard.spm.target*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List SPM Sasaran',
                                        'route' => 'dashboard.spm.target',
                                        'link' => route('dashboard.spm.target'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah SPM Sasaran',
                                        'route' => 'dashboard.spm.target.create',
                                        'link' => route('dashboard.spm.target.create'),
                                    ]
                                ]
                            ],
                            [
                                'icon' => 'icon folder',
                                'title' => 'SPM Tahunan',
                                'route' => 'dashboard.spm.yearly*',
                                'link' => '#',
                                'childs' => [
                                    [
                                        'icon' => 'icon list',
                                        'title' => 'List SPM Tahunan',
                                        'route' => 'dashboard.spm.yearly',
                                        'link' => route('dashboard.spm.yearly'),
                                    ],
                                    [
                                        'icon' => 'icon plus',
                                        'title' => 'Tambah SPM Tahunan',
                                        'route' => 'dashboard.spm.yearly.create',
                                        'link' => route('dashboard.spm.yearly.create'),
                                    ]
                                ]
                            ],
                        ]
                    ];

                return $item;
            });
        }

        return $sidebars;
    }

    public static function verification_message($status)
    {
        if ($status == 0)
            $msg = 'Data sasaran masih dalam bentuk draft.';
        elseif ($status == 1)
            $msg = 'Data dalam proses pemeriksaan untuk diverifikasi.';
        elseif ($status == 2)
            $msg = 'Data telah diverifikasi.';
        elseif ($status == 3)
            $msg = 'Data tidak terverifikasi. Silahkan periksa kembali data anda.';

        return $msg;
    }
    public static function get_kadis()
    {
        return GeneralConfig::where('slug', 'kepala-dinas')->first()->value ?? 'Kepala Dinas';
    }
}
