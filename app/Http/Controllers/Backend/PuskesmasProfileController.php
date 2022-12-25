<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DataHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PuskesmasProfile;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PuskesmasProfileController extends BackendController
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        if (Auth::user()->role_name == 'Puskesmas')
            $puskesmas = PuskesmasProfile::where('user_id', Auth::id())
                ->orderBy('tahun', 'desc');
        else
            $puskesmas = PuskesmasProfile::orderBy('tahun', 'desc');

        if ($tahun && $tahun != 'semua_data')
            $puskesmas = $puskesmas->where('tahun', '=', $tahun);

        $puskesmas = $puskesmas->paginate(25)
            ->withQueryString();

        return view('backend.pages.puskesmas.index', [
            'tahun' => $tahun,
            'data' => $puskesmas
        ]);
    }

    public function show(PuskesmasProfile $puskesmas_profile)
    {
        if (Auth::user()->role_name == 'Puskesmas' && $puskesmas_profile->user_id != Auth::id())
            return redirect()->route('dashboard.puskesmas');

        return view('backend.pages.puskesmas.show', [
            'data' => $puskesmas_profile
        ]);
    }

    public function create()
    {
        return view('backend.pages.puskesmas.create', [
            'jenis_puskesmas' => DataHelper::JENIS_PUSKESMAS,
            'kriteria_puskesmas' => DataHelper::KRITERIA_PUSKESMAS,
            'keadaan_bangunan' => DataHelper::KEADAAN_BANGUNAN,
            'akreditasi' => DataHelper::AKREDITASI,
            'waktu_ketersediaan_listrik' => DataHelper::WAKTU_KETERSEDIAAN_LISTRIK,
            'telepon_kabel' => DataHelper::TELEPON_KABEL,
            'radio_komunikasi' => DataHelper::RADIO_KOMUNIKASI,
            'jaringan_internet' => DataHelper::JARINGAN_INTERNET,
            'sumber_air' => DataHelper::SUMBER_AIR,
            'sumber_listrik' => DataHelper::SUMBER_LISTRIK,
            'akses_jalan_depan' => DataHelper::AKSES_JALAN_DEPAN,
            'kendaraan_lewat' => DataHelper::KENDARAAN_LEWAT,
        ]);
    }

    public function store(Request $request)
    {
        $puskesmas_count = PuskesmasProfile::where('user_id', Auth::id())
            ->where('tahun', $request->tahun)
            ->count();

        if ($puskesmas_count > 0) {
            Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list Profil Tahunan atau masukkan kembali tahun yang baru.');
            return redirect()
                ->route('dashboard.puskesmas.create')
                ->withInput();
        }

        $request->validate(
            [
                'tahun' => 'required|numeric',
                'nama_puskesmas' => 'required|max:255',
                'jenis_puskesmas' => 'required',
                'id_provinsi' => 'required|numeric',
                'id_kabupaten' => 'required|numeric',
                'id_kecamatan' => 'required|numeric',
                'id_desa' => 'required|numeric',
                // 'nama_provinsi' => 'required',
                // 'nama_kabupaten' => 'required',
                // 'nama_kecamatan' => 'required',
                // 'nama_desa' => 'required',
                'alamat_puskesmas' => 'required|max:255',
                'kode_pos' => 'required',
                'nomor_telp' => 'required|numeric',
                'nomor_fax' => 'nullable|numeric',
                'email_puskesmas' => 'required|email:dns',
                'nama_kontak' => 'required|max:255',
                'telp_kontak' => 'required|numeric',
                'email_kontak' => 'required|email:dns',
                'luas_wilayah' => 'required|numeric',
                'jml_desa' => 'required|numeric',
                'jml_kk' => 'required|numeric',
                'jml_penduduk' => 'required|numeric',
                'latitude' => 'required',
                'longitude' => 'required',
                'kriteria_puskesmas' => 'required',
                'keadaan_bangunan' => 'required',
                'status_akreditasi' => 'required',
                'jml_dk' => 'required|numeric',
                'jml_dk_gigi' => 'required|numeric',
                'jml_perawat' => 'required|numeric',
                'jml_bidan' => 'required|numeric',
                'jml_tk_masyarakat' => 'required|numeric',
                'jml_tk_lingkungan' => 'required|numeric',
                'jml_tenaga_gizi' => 'required|numeric',
                'jml_ahli_tek_medik' => 'required|numeric',
                'jml_farmasi' => 'required|numeric',
                'jml_tenaga_kesehatan' => 'required|numeric',
                'jml_tenaga_penunjang' => 'required|numeric',
                'jml_tenaga_puskesmas' => 'required|numeric',
                'ambulance_baik' => 'required|numeric',
                'ambulance_rusak_ringan' => 'required|numeric',
                'ambulance_rusak_berat' => 'required|numeric',
                'jml_ambulance' => 'required|numeric',
                'motor_baik' => 'required|numeric',
                'motor_rusak_ringan' => 'required|numeric',
                'motor_rusak_berat' => 'required|numeric',
                'jml_motor' => 'required|numeric',
                'pusling_baik' => 'required|numeric',
                'pusling_rusak_ringan' => 'required|numeric',
                'pusling_rusak_berat' => 'required|numeric',
                'jml_pusling' => 'required|numeric',
                'pusling_perairan_baik' => 'required|numeric',
                'pusling_perairan_rusak_ringan' => 'required|numeric',
                'pusling_perairan_rusak_berat' => 'required|numeric',
                'jml_pusling_perairan' => 'required|numeric',
                'pustu_baik' => 'required|numeric',
                'pustu_rusak_ringan' => 'required|numeric',
                'pustu_rusak_sedang' => 'required|numeric',
                'pustu_rusak_berat' => 'required|numeric',
                'jml_pustu' => 'required|numeric',
                'rumdis_nakes_baik' => 'required|numeric',
                'rumdis_nakes_rusak_ringan' => 'required|numeric',
                'rumdis_nakes_rusak_sedang' => 'required|numeric',
                'rumdis_nakes_rusak_berat' => 'required|numeric',
                'jml_rumdis_nakes' => 'required|numeric',
                'jml_poskesdes' => 'required|numeric',
                'jml_poskestren' => 'required|numeric',
                'jml_posyandu_lansia' => 'required|numeric',
                'jml_posbindu_ptm_aktif' => 'required|numeric',
                'jml_ukbm' => 'required|numeric',
                'jml_posyandu_pratama' => 'required|numeric',
                'jml_posyandu_madya' => 'required|numeric',
                'jml_posyandu_purnama' => 'required|numeric',
                'jml_posyandu_mandiri' => 'required|numeric',
                'jml_posyandu' => 'required|numeric',
                'jml_ukbm_posyandu' => 'required|numeric',
                'jml_tt_perawatan_umum' => 'required|numeric',
                'jml_tt_perawatan_persalinan' => 'required|numeric',
                'nama_aplikasi_pencatatan' => 'required|max:255',
                'waktu_ketersediaan_listrik' => 'required',
                'telepon_kabel' => 'required',
                'radio_komunikasi' => 'required',
                'jaringan_internet' => 'required',
                'sumber_air' => 'required',
                'sumber_listrik' => 'required',
                'akses_jalan_depan' => 'required',
                'kendaraan_lewat' => 'required',
                'waktu_tempuh' => 'required|numeric',
                'komputer_berfungsi' => 'required|numeric',
                'komputer_tidak_berfungsi' => 'required|numeric',
                'jml_komputer' => 'required|numeric',
                'laptop_berfungsi' => 'required|numeric',
                'laptop_tidak_berfungsi' => 'required|numeric',
                'jml_laptop' => 'required|numeric',
            ],
            [],
            [
                'id_provinsi' => 'Provinsi',
                'id_kabupaten' => 'Kota/Kabupaten',
                'id_kecamatan' => 'Kecamatan',
                'id_desa' => 'Kelurahan/Desa',
                'nomor_telp' => 'Nomor telpon',
                'telp_kotan' => 'Telpon kontak',
                'jml_desa' => 'Jumlah desa',
                'jml_kk' => 'Jumlah KK',
                'jml_penduduk' => 'Jumlah penduduk',
                'jml_dk' => 'Jumlah dokter',
                'jml_dk_gigi' => 'Jumlah dokter gigi',
                'jml_perawat' => 'Jumlah perawat',
                'jml_bidan' => 'Jumlah bidan',
                'jml_tk_masyarakat' => 'Jumlah tenaga kesehatan masyarakat',
                'jml_tk_lingkungan' => 'Jumlah tenaga kesehatan lingkungan',
                'jml_tenaga_gizi' => 'Jumlah tenaga gizi',
                'jml_ahli_tek_medik' => 'Jumlah ahli teknologi medik',
                'jml_farmasi' => 'Jumlah farmasi',
                'jml_tenaga_kesehatan' => 'Jumlah tenaga kesehatan',
                'jml_tenaga_penunjang' => 'Jumlah tenaga penunjang',
                'jml_tenaga_puskesmas' => 'Jumlah tenaga di puskesmas',
                'ambulance_baik' => 'Jumlah ambulance kondisi baik',
                'ambulance_rusak_ringan' => 'Jumlah ambulance kondisi rusak ringan',
                'ambulance_rusak_berat' => 'Jumlah ambulance kondisi rusak berat',
                'jml_ambulance' => 'Jumlah ambulance',
                'motor_baik' => 'Jumlah sepeda motor kondisi baik',
                'motor_rusak_ringan' => 'Jumlah sepeda motor kondisi rusak ringan',
                'motor_rusak_berat' => 'Jumlah sepeda motor kondisi rusak berat',
                'jml_motor' => 'Jumlah sepeda motor',
                'pusling_baik' => 'Jumlah pusling kondisi baik',
                'pusling_rusak_ringan' => 'Jumlah pusling kondisi rusak ringan',
                'pusling_rusak_berat' => 'Jumlah pusling kondisi rusak berat',
                'jml_pusling' => 'Jumlah pusling',
                'pusling_perairan_baik' => 'Jumlah pusling perairan kondisi baik',
                'pusling_perairan_rusak_ringan' => 'Jumlah pusling perairan kondisi rusak ringan',
                'pusling_perairan_rusak_berat' => 'Jumlah pusling perairan kondisi rusak berat',
                'jml_pusling_perairan' => 'Jumlah pusling perairan',
                'pustu_baik' => 'Jumlah pustu kondisi baik',
                'pustu_rusak_ringan' => 'Jumlah pustu kondisi rusak ringan',
                'pustu_rusak_sedang' => 'Jumlah pustu kondisi rusak sedang',
                'pustu_rusak_berat' => 'Jumlah pustu kondisi rusak berat',
                'jml_pustu' => 'Jumlah pustu',
                'rumdis_nakes_baik' => 'Jumlah rumdis nakes kondisi baik',
                'rumdis_nakes_rusak_ringan' => 'Jumlah rumdis nakes kondisi rusak ringan',
                'rumdis_nakes_rusak_sedang' => 'Jumlah rumdis nakes kondisi rusak sedang',
                'rumdis_nakes_rusak_berat' => 'Jumlah rumdis nakes kondisi rusak berat',
                'jml_rumdis_nakes' => 'Jumlah rumdis nakes',
                'jml_poskesdes' => 'Jumlah poskesdes',
                'jml_poskestren' => 'Jumlah poskestren',
                'jml_posyandu_lansia' => 'Jumlah posyandu lansia',
                'jml_posbindu_ptm_aktif' => 'Jumlah posbindu PTM aktif',
                'jml_ukbm' => 'Jumlah UKBM',
                'jml_posyandu_pratama' => 'Jumlah posyandu pratama',
                'jml_posyandu_madya' => 'Jumlah posyandu madya',
                'jml_posyandu_purnama' => 'Jumlah posyandu purnama',
                'jml_posyandu_mandiri' => 'Jumlah posyandu mandiri',
                'jml_posyandu' => 'Jumlah posyandu',
                'jml_ukbm_posyandu' => 'Jumlah ukbm dan posyandu',
                'jml_tt_perawatan_umum' => 'Jumlah tempat tidur perawatan umum',
                'jml_tt_perawatan_persalinan' => 'Jumlah tempat tidur perawatan persalinan',
                'waktu_ketersediaan_listrik' => 'Status waktu ketersediaan listrik',
                'telepon_kabel' => 'Status telepon kabel',
                'radio_komunikasi' => 'Status :attribute',
                'jaringan_internet' => 'Status :attribute',
                'sumber_air' => 'Status :attribute',
                'sumber_listrik' => 'Status :attribute',
                'akses_jalan_depan' => 'Akses jalan depan gedung puskemas',
                'kendaraan_lewat' => 'Kendaraan yang dapat lewat',
                'waktu_tempuh' => 'Waktu tempuh terlama',
                'komputer_berfungsi' => 'Jumlah komputer berfungsi',
                'komputer_tidak_berfungsi' => 'Jumlah komputer tidak berfungsi',
                'jml_komputer' => 'Jumlah komputer',
                'laptop_berfungsi' => 'Jumlah laptop berfungsi',
                'laptop_tidak_berfungsi' => 'Jumlah laptop tidak berfungsi',
                'jml_laptop' => 'Jumlah laptop',
            ]
        );

        $slug = Str::random(32);

        $data = [
            'user_id' => Auth::id(),
            'slug' => $slug,
            'tahun' => $request->tahun,
            'nama_puskesmas' => $request->nama_puskesmas,
            'jenis_puskesmas' => $request->jenis_puskesmas,
            'id_provinsi' => $request->id_provinsi,
            'id_kabupaten' => $request->id_kabupaten,
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
            'alamat_puskesmas' => $request->alamat_puskesmas,
            'kode_pos' => $request->kode_pos,
            'nomor_telp' => $request->nomor_telp,
            'nomor_fax' => $request->nomor_fax,
            'email_puskesmas' => $request->email_puskesmas,
            'nama_kontak' => $request->nama_kontak,
            'telp_kontak' => $request->telp_kontak,
            'email_kontak' => $request->email_kontak,
            'luas_wilayah' => $request->luas_wilayah,
            'jml_desa' => $request->jml_desa,
            'jml_kk' => $request->jml_kk,
            'jml_penduduk' => $request->jml_penduduk,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'kriteria_puskesmas' => $request->kriteria_puskesmas,
            'keadaan_bangunan' => $request->keadaan_bangunan,
            'status_akreditasi' => $request->status_akreditasi,
            'jml_dk' => $request->jml_dk,
            'jml_dk_gigi' => $request->jml_dk_gigi,
            'jml_perawat' => $request->jml_perawat,
            'jml_bidan' => $request->jml_bidan,
            'jml_tk_masyarakat' => $request->jml_tk_masyarakat,
            'jml_tk_lingkungan' => $request->jml_tk_lingkungan,
            'jml_tenaga_gizi' => $request->jml_tenaga_gizi,
            'jml_ahli_tek_medik' => $request->jml_ahli_tek_medik,
            'jml_farmasi' => $request->jml_farmasi,
            'jml_tenaga_kesehatan' => $request->jml_tenaga_kesehatan,
            'jml_tenaga_penunjang' => $request->jml_tenaga_penunjang,
            'jml_tenaga_puskesmas' => $request->jml_tenaga_puskesmas,
            'ambulance_baik' => $request->ambulance_baik,
            'ambulance_rusak_ringan' => $request->ambulance_rusak_ringan,
            'ambulance_rusak_berat' => $request->ambulance_rusak_berat,
            'jml_ambulance' => $request->jml_ambulance,
            'motor_baik' => $request->motor_baik,
            'motor_rusak_ringan' => $request->motor_rusak_ringan,
            'motor_rusak_berat' => $request->motor_rusak_berat,
            'jml_motor' => $request->jml_motor,
            'pusling_baik' => $request->pusling_baik,
            'pusling_rusak_ringan' => $request->pusling_rusak_ringan,
            'pusling_rusak_berat' => $request->pusling_rusak_berat,
            'jml_pusling' => $request->jml_pusling,
            'pusling_perairan_baik' => $request->pusling_perairan_baik,
            'pusling_perairan_rusak_ringan' => $request->pusling_perairan_rusak_ringan,
            'pusling_perairan_rusak_berat' => $request->pusling_perairan_rusak_berat,
            'jml_pusling_perairan' => $request->jml_pusling_perairan,
            'pustu_baik' => $request->pustu_baik,
            'pustu_rusak_ringan' => $request->pustu_rusak_ringan,
            'pustu_rusak_sedang' => $request->pustu_rusak_sedang,
            'pustu_rusak_berat' => $request->pustu_rusak_berat,
            'jml_pustu' => $request->jml_pustu,
            'rumdis_nakes_baik' => $request->rumdis_nakes_baik,
            'rumdis_nakes_rusak_ringan' => $request->rumdis_nakes_rusak_ringan,
            'rumdis_nakes_rusak_sedang' => $request->rumdis_nakes_rusak_sedang,
            'rumdis_nakes_rusak_berat' => $request->rumdis_nakes_rusak_berat,
            'jml_rumdis_nakes' => $request->jml_rumdis_nakes,
            'jml_poskesdes' => $request->jml_poskesdes,
            'jml_poskestren' => $request->jml_poskestren,
            'jml_posyandu_lansia' => $request->jml_posyandu_lansia,
            'jml_posbindu_ptm_aktif' => $request->jml_posbindu_ptm_aktif,
            'jml_ukbm' => $request->jml_ukbm,
            'jml_posyandu_pratama' => $request->jml_posyandu_pratama,
            'jml_posyandu_madya' => $request->jml_posyandu_madya,
            'jml_posyandu_purnama' => $request->jml_posyandu_purnama,
            'jml_posyandu_mandiri' => $request->jml_posyandu_mandiri,
            'jml_posyandu' => $request->jml_posyandu,
            'jml_ukbm_posyandu' => $request->jml_ukbm_posyandu,
            'jml_tt_perawatan_umum' => $request->jml_tt_perawatan_umum,
            'jml_tt_perawatan_persalinan' => $request->jml_tt_perawatan_persalinan,
            'nama_aplikasi_pencatatan' => $request->nama_aplikasi_pencatatan,
            'waktu_ketersediaan_listrik' => $request->waktu_ketersediaan_listrik,
            'telepon_kabel' => $request->telepon_kabel,
            'radio_komunikasi' => $request->radio_komunikasi,
            'jaringan_internet' => $request->jaringan_internet,
            'sumber_air' => $request->sumber_air,
            'sumber_listrik' => $request->sumber_listrik,
            'akses_jalan_depan' => $request->akses_jalan_depan,
            'kendaraan_lewat' => $request->kendaraan_lewat,
            'waktu_tempuh' => $request->waktu_tempuh,
            'komputer_berfungsi' => $request->komputer_berfungsi,
            'komputer_tidak_berfungsi' => $request->komputer_tidak_berfungsi,
            'jml_komputer' => $request->jml_komputer,
            'laptop_berfungsi' => $request->laptop_berfungsi,
            'laptop_tidak_berfungsi' => $request->laptop_tidak_berfungsi,
            'jml_laptop' => $request->jml_laptop
        ];

        PuskesmasProfile::create($data);

        Alert::success('Sukses!', 'Berhasil menambahkan data profil puskesmas tahun ' . $request->tahun . '.');
        return redirect()
            ->route('dashboard.puskesmas.show', $slug);
    }

    public function edit(PuskesmasProfile $puskesmas_profile)
    {
        if ($puskesmas_profile->user_id != Auth::id())
            return redirect()->route('dashboard.puskesmas');

        return view('backend.pages.puskesmas.edit', [
            'data' => $puskesmas_profile,
            'jenis_puskesmas' => DataHelper::JENIS_PUSKESMAS,
            'kriteria_puskesmas' => DataHelper::KRITERIA_PUSKESMAS,
            'keadaan_bangunan' => DataHelper::KEADAAN_BANGUNAN,
            'akreditasi' => DataHelper::AKREDITASI,
            'waktu_ketersediaan_listrik' => DataHelper::WAKTU_KETERSEDIAAN_LISTRIK,
            'telepon_kabel' => DataHelper::TELEPON_KABEL,
            'radio_komunikasi' => DataHelper::RADIO_KOMUNIKASI,
            'jaringan_internet' => DataHelper::JARINGAN_INTERNET,
            'sumber_air' => DataHelper::SUMBER_AIR,
            'sumber_listrik' => DataHelper::SUMBER_LISTRIK,
            'akses_jalan_depan' => DataHelper::AKSES_JALAN_DEPAN,
            'kendaraan_lewat' => DataHelper::KENDARAAN_LEWAT,
        ]);
    }

    public function update(Request $request, PuskesmasProfile $puskesmas_profile)
    {
        if ($request->tahun != $puskesmas_profile->tahun) {
            $puskesmas = PuskesmasProfile::where('user_id', Auth::id())
                ->where('tahun', $request->tahun)
                ->count();

            if ($puskesmas > 0) {
                Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list Profil Puskesmas atau masukkan kembali tahun yang baru.');
                return redirect()
                    ->route('dashboard.puskesmas.edit', $puskesmas_profile->slug)
                    ->withInput();
            }
        }

        $validatedData = Validator::make(
            $request->all(),
            [
                'tahun' => 'required|numeric',
                'nama_puskesmas' => 'required|max:255',
                'jenis_puskesmas' => 'required',
                'id_provinsi' => 'required|numeric',
                'id_kabupaten' => 'required|numeric',
                'id_kecamatan' => 'required|numeric',
                'id_desa' => 'required|numeric',
                'email_puskesmas' => [
                    'required',
                    'email:dns',
                    // Rule::unique('profil_puskesmas')->ignore($puskesmas_profile->email_puskesmas, 'email_puskesmas'),
                ],
                'email_kontak' => [
                    'required',
                    'email:dns',
                    // Rule::unique('profil_puskesmas')->ignore($puskesmas_profile->email_kontak, 'email_kontak'),
                ],
                // 'nama_provinsi' => 'required',
                // 'nama_kabupaten' => 'required',
                // 'nama_kecamatan' => 'required',
                // 'nama_desa' => 'required',
                'alamat_puskesmas' => 'required|max:255',
                'kode_pos' => 'required',
                'nomor_telp' => 'required|numeric',
                'nomor_fax' => 'nullable|numeric',
                'nama_kontak' => 'required|max:255',
                'telp_kontak' => 'required|numeric',
                'luas_wilayah' => 'required|numeric',
                'jml_desa' => 'required|numeric',
                'jml_kk' => 'required|numeric',
                'jml_penduduk' => 'required|numeric',
                'latitude' => 'required',
                'longitude' => 'required',
                'kriteria_puskesmas' => 'required',
                'keadaan_bangunan' => 'required',
                'status_akreditasi' => 'required',
                'jml_dk' => 'required|numeric',
                'jml_dk_gigi' => 'required|numeric',
                'jml_perawat' => 'required|numeric',
                'jml_bidan' => 'required|numeric',
                'jml_tk_masyarakat' => 'required|numeric',
                'jml_tk_lingkungan' => 'required|numeric',
                'jml_tenaga_gizi' => 'required|numeric',
                'jml_ahli_tek_medik' => 'required|numeric',
                'jml_farmasi' => 'required|numeric',
                'jml_tenaga_kesehatan' => 'required|numeric',
                'jml_tenaga_penunjang' => 'required|numeric',
                'jml_tenaga_puskesmas' => 'required|numeric',
                'ambulance_baik' => 'required|numeric',
                'ambulance_rusak_ringan' => 'required|numeric',
                'ambulance_rusak_berat' => 'required|numeric',
                'jml_ambulance' => 'required|numeric',
                'motor_baik' => 'required|numeric',
                'motor_rusak_ringan' => 'required|numeric',
                'motor_rusak_berat' => 'required|numeric',
                'jml_motor' => 'required|numeric',
                'pusling_baik' => 'required|numeric',
                'pusling_rusak_ringan' => 'required|numeric',
                'pusling_rusak_berat' => 'required|numeric',
                'jml_pusling' => 'required|numeric',
                'pusling_perairan_baik' => 'required|numeric',
                'pusling_perairan_rusak_ringan' => 'required|numeric',
                'pusling_perairan_rusak_berat' => 'required|numeric',
                'jml_pusling_perairan' => 'required|numeric',
                'pustu_baik' => 'required|numeric',
                'pustu_rusak_ringan' => 'required|numeric',
                'pustu_rusak_sedang' => 'required|numeric',
                'pustu_rusak_berat' => 'required|numeric',
                'jml_pustu' => 'required|numeric',
                'rumdis_nakes_baik' => 'required|numeric',
                'rumdis_nakes_rusak_ringan' => 'required|numeric',
                'rumdis_nakes_rusak_sedang' => 'required|numeric',
                'rumdis_nakes_rusak_berat' => 'required|numeric',
                'jml_rumdis_nakes' => 'required|numeric',
                'jml_poskesdes' => 'required|numeric',
                'jml_poskestren' => 'required|numeric',
                'jml_posyandu_lansia' => 'required|numeric',
                'jml_posbindu_ptm_aktif' => 'required|numeric',
                'jml_ukbm' => 'required|numeric',
                'jml_posyandu_pratama' => 'required|numeric',
                'jml_posyandu_madya' => 'required|numeric',
                'jml_posyandu_purnama' => 'required|numeric',
                'jml_posyandu_mandiri' => 'required|numeric',
                'jml_posyandu' => 'required|numeric',
                'jml_ukbm_posyandu' => 'required|numeric',
                'jml_tt_perawatan_umum' => 'required|numeric',
                'jml_tt_perawatan_persalinan' => 'required|numeric',
                'nama_aplikasi_pencatatan' => 'required|max:255',
                'waktu_ketersediaan_listrik' => 'required',
                'telepon_kabel' => 'required',
                'radio_komunikasi' => 'required',
                'jaringan_internet' => 'required',
                'sumber_air' => 'required',
                'sumber_listrik' => 'required',
                'akses_jalan_depan' => 'required',
                'kendaraan_lewat' => 'required',
                'waktu_tempuh' => 'required|numeric',
                'komputer_berfungsi' => 'required|numeric',
                'komputer_tidak_berfungsi' => 'required|numeric',
                'jml_komputer' => 'required|numeric',
                'laptop_berfungsi' => 'required|numeric',
                'laptop_tidak_berfungsi' => 'required|numeric',
                'jml_laptop' => 'required|numeric',
            ],
            [],
            [
                'id_provinsi' => 'Provinsi',
                'id_kabupaten' => 'Kota/Kabupaten',
                'id_kecamatan' => 'Kecamatan',
                'id_desa' => 'Kelurahan/Desa',
                'nomor_telp' => 'Nomor telpon',
                'telp_kotan' => 'Telpon kontak',
                'jml_desa' => 'Jumlah desa',
                'jml_kk' => 'Jumlah KK',
                'jml_penduduk' => 'Jumlah penduduk',
                'jml_dk' => 'Jumlah dokter',
                'jml_dk_gigi' => 'Jumlah dokter gigi',
                'jml_perawat' => 'Jumlah perawat',
                'jml_bidan' => 'Jumlah bidan',
                'jml_tk_masyarakat' => 'Jumlah tenaga kesehatan masyarakat',
                'jml_tk_lingkungan' => 'Jumlah tenaga kesehatan lingkungan',
                'jml_tenaga_gizi' => 'Jumlah tenaga gizi',
                'jml_ahli_tek_medik' => 'Jumlah ahli teknologi medik',
                'jml_farmasi' => 'Jumlah farmasi',
                'jml_tenaga_kesehatan' => 'Jumlah tenaga kesehatan',
                'jml_tenaga_penunjang' => 'Jumlah tenaga penunjang',
                'jml_tenaga_puskesmas' => 'Jumlah tenaga di puskesmas',
                'ambulance_baik' => 'Jumlah ambulance kondisi baik',
                'ambulance_rusak_ringan' => 'Jumlah ambulance kondisi rusak ringan',
                'ambulance_rusak_berat' => 'Jumlah ambulance kondisi rusak berat',
                'jml_ambulance' => 'Jumlah ambulance',
                'motor_baik' => 'Jumlah sepeda motor kondisi baik',
                'motor_rusak_ringan' => 'Jumlah sepeda motor kondisi rusak ringan',
                'motor_rusak_berat' => 'Jumlah sepeda motor kondisi rusak berat',
                'jml_motor' => 'Jumlah sepeda motor',
                'pusling_baik' => 'Jumlah pusling kondisi baik',
                'pusling_rusak_ringan' => 'Jumlah pusling kondisi rusak ringan',
                'pusling_rusak_berat' => 'Jumlah pusling kondisi rusak berat',
                'jml_pusling' => 'Jumlah pusling',
                'pusling_perairan_baik' => 'Jumlah pusling perairan kondisi baik',
                'pusling_perairan_rusak_ringan' => 'Jumlah pusling perairan kondisi rusak ringan',
                'pusling_perairan_rusak_berat' => 'Jumlah pusling perairan kondisi rusak berat',
                'jml_pusling_perairan' => 'Jumlah pusling perairan',
                'pustu_baik' => 'Jumlah pustu kondisi baik',
                'pustu_rusak_ringan' => 'Jumlah pustu kondisi rusak ringan',
                'pustu_rusak_sedang' => 'Jumlah pustu kondisi rusak sedang',
                'pustu_rusak_berat' => 'Jumlah pustu kondisi rusak berat',
                'jml_pustu' => 'Jumlah pustu',
                'rumdis_nakes_baik' => 'Jumlah rumdis nakes kondisi baik',
                'rumdis_nakes_rusak_ringan' => 'Jumlah rumdis nakes kondisi rusak ringan',
                'rumdis_nakes_rusak_sedang' => 'Jumlah rumdis nakes kondisi rusak sedang',
                'rumdis_nakes_rusak_berat' => 'Jumlah rumdis nakes kondisi rusak berat',
                'jml_rumdis_nakes' => 'Jumlah rumdis nakes',
                'jml_poskesdes' => 'Jumlah poskesdes',
                'jml_poskestren' => 'Jumlah poskestren',
                'jml_posyandu_lansia' => 'Jumlah posyandu lansia',
                'jml_posbindu_ptm_aktif' => 'Jumlah posbindu PTM aktif',
                'jml_ukbm' => 'Jumlah UKBM',
                'jml_posyandu_pratama' => 'Jumlah posyandu pratama',
                'jml_posyandu_madya' => 'Jumlah posyandu madya',
                'jml_posyandu_purnama' => 'Jumlah posyandu purnama',
                'jml_posyandu_mandiri' => 'Jumlah posyandu mandiri',
                'jml_posyandu' => 'Jumlah posyandu',
                'jml_ukbm_posyandu' => 'Jumlah ukbm dan posyandu',
                'jml_tt_perawatan_umum' => 'Jumlah tempat tidur perawatan umum',
                'jml_tt_perawatan_persalinan' => 'Jumlah tempat tidur perawatan persalinan',
                'waktu_ketersediaan_listrik' => 'Status waktu ketersediaan listrik',
                'telepon_kabel' => 'Status telepon kabel',
                'radio_komunikasi' => 'Status :attribute',
                'jaringan_internet' => 'Status :attribute',
                'sumber_air' => 'Status :attribute',
                'sumber_listrik' => 'Status :attribute',
                'akses_jalan_depan' => 'Akses jalan depan gedung puskemas',
                'kendaraan_lewat' => 'Kendaraan yang dapat lewat',
                'waktu_tempuh' => 'Waktu tempuh terlama',
                'komputer_berfungsi' => 'Jumlah komputer berfungsi',
                'komputer_tidak_berfungsi' => 'Jumlah komputer tidak berfungsi',
                'jml_komputer' => 'Jumlah komputer',
                'laptop_berfungsi' => 'Jumlah laptop berfungsi',
                'laptop_tidak_berfungsi' => 'Jumlah laptop tidak berfungsi',
                'jml_laptop' => 'Jumlah laptop',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()
                ->route('dashboard.puskesmas.edit', $puskesmas_profile->slug)
                ->withErrors($validatedData)
                ->withInput();
        }

        $update_data = [
            'tahun' => $request->tahun,
            'nama_puskesmas' => $request->nama_puskesmas,
            'jenis_puskesmas' => $request->jenis_puskesmas,
            'id_provinsi' => $request->id_provinsi,
            'id_kabupaten' => $request->id_kabupaten,
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
            'alamat_puskesmas' => $request->alamat_puskesmas,
            'kode_pos' => $request->kode_pos,
            'nomor_telp' => $request->nomor_telp,
            'nomor_fax' => $request->nomor_fax,
            'email_puskesmas' => $request->email_puskesmas,
            'nama_kontak' => $request->nama_kontak,
            'telp_kontak' => $request->telp_kontak,
            'email_kontak' => $request->email_kontak,
            'luas_wilayah' => $request->luas_wilayah,
            'jml_desa' => $request->jml_desa,
            'jml_kk' => $request->jml_kk,
            'jml_penduduk' => $request->jml_penduduk,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'kriteria_puskesmas' => $request->kriteria_puskesmas,
            'keadaan_bangunan' => $request->keadaan_bangunan,
            'status_akreditasi' => $request->status_akreditasi,
            'jml_dk' => $request->jml_dk,
            'jml_dk_gigi' => $request->jml_dk_gigi,
            'jml_perawat' => $request->jml_perawat,
            'jml_bidan' => $request->jml_bidan,
            'jml_tk_masyarakat' => $request->jml_tk_masyarakat,
            'jml_tk_lingkungan' => $request->jml_tk_lingkungan,
            'jml_tenaga_gizi' => $request->jml_tenaga_gizi,
            'jml_ahli_tek_medik' => $request->jml_ahli_tek_medik,
            'jml_farmasi' => $request->jml_farmasi,
            'jml_tenaga_kesehatan' => $request->jml_tenaga_kesehatan,
            'jml_tenaga_penunjang' => $request->jml_tenaga_penunjang,
            'jml_tenaga_puskesmas' => $request->jml_tenaga_puskesmas,
            'ambulance_baik' => $request->ambulance_baik,
            'ambulance_rusak_ringan' => $request->ambulance_rusak_ringan,
            'ambulance_rusak_berat' => $request->ambulance_rusak_berat,
            'jml_ambulance' => $request->jml_ambulance,
            'motor_baik' => $request->motor_baik,
            'motor_rusak_ringan' => $request->motor_rusak_ringan,
            'motor_rusak_berat' => $request->motor_rusak_berat,
            'jml_motor' => $request->jml_motor,
            'pusling_baik' => $request->pusling_baik,
            'pusling_rusak_ringan' => $request->pusling_rusak_ringan,
            'pusling_rusak_berat' => $request->pusling_rusak_berat,
            'jml_pusling' => $request->jml_pusling,
            'pusling_perairan_baik' => $request->pusling_perairan_baik,
            'pusling_perairan_rusak_ringan' => $request->pusling_perairan_rusak_ringan,
            'pusling_perairan_rusak_berat' => $request->pusling_perairan_rusak_berat,
            'jml_pusling_perairan' => $request->jml_pusling_perairan,
            'pustu_baik' => $request->pustu_baik,
            'pustu_rusak_ringan' => $request->pustu_rusak_ringan,
            'pustu_rusak_sedang' => $request->pustu_rusak_sedang,
            'pustu_rusak_berat' => $request->pustu_rusak_berat,
            'jml_pustu' => $request->jml_pustu,
            'rumdis_nakes_baik' => $request->rumdis_nakes_baik,
            'rumdis_nakes_rusak_ringan' => $request->rumdis_nakes_rusak_ringan,
            'rumdis_nakes_rusak_sedang' => $request->rumdis_nakes_rusak_sedang,
            'rumdis_nakes_rusak_berat' => $request->rumdis_nakes_rusak_berat,
            'jml_rumdis_nakes' => $request->jml_rumdis_nakes,
            'jml_poskesdes' => $request->jml_poskesdes,
            'jml_poskestren' => $request->jml_poskestren,
            'jml_posyandu_lansia' => $request->jml_posyandu_lansia,
            'jml_posbindu_ptm_aktif' => $request->jml_posbindu_ptm_aktif,
            'jml_ukbm' => $request->jml_ukbm,
            'jml_posyandu_pratama' => $request->jml_posyandu_pratama,
            'jml_posyandu_madya' => $request->jml_posyandu_madya,
            'jml_posyandu_purnama' => $request->jml_posyandu_purnama,
            'jml_posyandu_mandiri' => $request->jml_posyandu_mandiri,
            'jml_posyandu' => $request->jml_posyandu,
            'jml_ukbm_posyandu' => $request->jml_ukbm_posyandu,
            'jml_tt_perawatan_umum' => $request->jml_tt_perawatan_umum,
            'jml_tt_perawatan_persalinan' => $request->jml_tt_perawatan_persalinan,
            'nama_aplikasi_pencatatan' => $request->nama_aplikasi_pencatatan,
            'waktu_ketersediaan_listrik' => $request->waktu_ketersediaan_listrik,
            'telepon_kabel' => $request->telepon_kabel,
            'radio_komunikasi' => $request->radio_komunikasi,
            'jaringan_internet' => $request->jaringan_internet,
            'sumber_air' => $request->sumber_air,
            'sumber_listrik' => $request->sumber_listrik,
            'akses_jalan_depan' => $request->akses_jalan_depan,
            'kendaraan_lewat' => $request->kendaraan_lewat,
            'waktu_tempuh' => $request->waktu_tempuh,
            'komputer_berfungsi' => $request->komputer_berfungsi,
            'komputer_tidak_berfungsi' => $request->komputer_tidak_berfungsi,
            'jml_komputer' => $request->jml_komputer,
            'laptop_berfungsi' => $request->laptop_berfungsi,
            'laptop_tidak_berfungsi' => $request->laptop_tidak_berfungsi,
            'jml_laptop' => $request->jml_laptop
        ];

        $puskesmas_profile->update($update_data);

        Alert::success('Sukses!', 'Berhasil mengubah Profil Puskesmas.');
        return redirect()
            ->route('dashboard.puskesmas.edit', $puskesmas_profile->slug);
    }

    public function destroy(Request $request)
    {
        $slug = $request->v;
        $data = PuskesmasProfile::where('user_id', Auth::id())
            ->where('slug', $slug);

        if ($data->count() == 0) {
            Alert::warning('Perhatian!', 'Data tidak sesuai dengan permintaan.');
            return redirect()
                ->route('dashboard.puskesmas');
        } else {
            $data = $data->first();
            PuskesmasProfile::where('slug', $slug)
                ->delete();

            Alert::success('Sukses!', 'Profil Puskesmas berhasil dihapus.');
            return redirect()
                ->route('dashboard.puskesmas');
        }
    }
}
