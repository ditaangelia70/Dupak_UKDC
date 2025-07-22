<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

use App\Models\Criteria;
use App\Models\Credit;
use App\Models\User;

use App\Models\Settings;
use Illuminate\Support\Facades\Hash;

use App\Models\PublikasiKarya;
use App\Models\Pengabdian;
use App\Models\PoinCreditUmum;
use App\Models\PoinCreditJenis;
use App\Models\PoinCreditCapaian;
use App\Models\PoinCreditKegiatan;

use App\Models\ProgramStudi;
use App\Models\CreditPengajaran;

use Illuminate\Support\Carbon;

class Controller extends BaseController
{
    public function get_user(Request $request){
        try {
            $token = $request->cookie('token');

            if (!$token) {
                return null;
            }

            $user = JWTAuth::setToken($token)->authenticate();

            if (!isset($user->role)) {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }

        return $user;
    }
    public function home(Request $request){
        $user = $this->get_user($request);

        if($user && isset($user->role)){
            $role =  $user->role;
            if($role === 'admin'){
                return redirect('/admin');
            }else if($role === 'staf'){
                return redirect('/staf');
            }
            return redirect('/dosen');
        }

        // auto redirect to login page
        return redirect('/login');
    }
    public function profile(Request $request){
        $user = $this->get_user($request);

        if(!$user){
            return redirect('/login');
        }

        $criteria = Criteria::all()->toArray();

        $credit = Credit::with(['subSubCriteria.subCriteria.criteria','subSubCriteria.creditOnPos.jabatan'])->where('user_id',$user->id)->get()->toArray();

        foreach($criteria as $index => $jtem){
            if(!isset($criteria[$index]['point'])){
                $criteria[$index]['point'] = 0;
            }
            foreach($credit as $item){
                if($item['sub_sub_criteria']['sub_criteria']['criteria_id'] === $jtem['id']){
                    if(count($item['sub_sub_criteria']['credit_on_pos']) > 0){
                        $found_credit = null;
                        foreach($item['sub_sub_criteria']['credit_on_pos'] as $cop_index => $credit_op){
                            if($credit_op['jabatan']['name'] === $user->pangkat){
                                $found_credit = $credit_op['credit'];
                            }
                        }
                        if($found_credit){
                            $criteria[$index]['point'] += round($item['qty'] * $found_credit);
                        }
                    }else{
                        $criteria[$index]['point'] += round($item['qty'] * $item['sub_sub_criteria']['credit']);
                    }
                }
            }
        }
        
        $id = $user->id;

        if($request->isMethod('post')){
            $data = $request->all();

            if(!empty($data['new_password'])){
                $data['password'] = Hash::make($data['new_password']);
            }
            // creating the billboard data
            $user = User::find($id);
            if($user){
                $user->update($data);
            }
            return redirect('/profile');
        }else{
            $akun = User::with('jurusan')->find($id)->toArray();
            $jurusan = ProgramStudi::all()->toArray();
            $settings = Settings::find(1);
            return view('layouts.app', [
                'title'=>'Edit Akun',
                'user'=>$user,
                'akun'=>$akun,
                'settings'=>$settings,
                'criteria'=>$criteria,
                'jurusan'=>$jurusan,
                'content'=>resource_path('views/profile.blade.php')
            ]);
        }
    }
    public function laporan_penilaian(Request $request){
        $user = $this->get_user($request);

        if(!$user){
            return redirect('/login');
        }
        $criteria = Criteria::all();
        if($user->role === 'admin'){
            $data_laporan = User::with(['credit.subSubCriteria.subCriteria.criteria','credit.subSubCriteria.creditOnPos.jabatan','credit.subSubCriteria.archives', 'jurusan'])
            ->where('role','dosen')
            ->get()->toArray();
        }elseif($user->role === 'staf'){
            $data_laporan = User::with(['credit.subSubCriteria.subCriteria.criteria','credit.subSubCriteria.creditOnPos.jabatan','credit.subSubCriteria.archives', 'jurusan'])
            ->where('role','dosen')
            ->where('jurusan', $user->jurusan)
            ->get()->toArray();
        }else{
            $data_laporan = User::with(['credit.subSubCriteria.subCriteria.criteria','credit.subSubCriteria.creditOnPos.jabatan','credit.subSubCriteria.archives', 'jurusan'])
            ->where('role','dosen')->where('id',$user->id)
            ->get()->toArray();
        }

        foreach($data_laporan as $index => $dl){
            // getting the init point for all data lecturer
            foreach($criteria as $cr){
                $data_laporan[$index][$cr['name']] = 0;
            }
            if(count($dl['credit']) > 0){
                foreach($dl['credit'] as $crindex => $cr){
                    $credit = $cr['sub_sub_criteria']['credit'];
                    if(count($cr['sub_sub_criteria']['credit_on_pos']) > 0){
                        foreach($cr['sub_sub_criteria']['credit_on_pos'] as $cos){
                            if($cos['jabatan']['name'] === $dl['pangkat']){
                                $credit = $cos['credit'];
                            }
                        }
                    }
                    $data_laporan[$index][$cr['sub_sub_criteria']['sub_criteria']['criteria']['name']] += $cr['qty'] * $credit;
                    $data_laporan[$index]['credit'][$crindex]['sub_sub_criteria']['credit'] = $credit;
                }
            }

            // menginjeksi perhitungan data penelitian dan pengabdian
            // working on total data penelitian dan pengabdian
            $penelitian_total = 0;
            
            $credit_umum_penelitian = PoinCreditUmum::where('type','penelitian')->first();
            if(!$credit_umum_penelitian){
                $credit_umum_penelitian = 0;
            }else{
                $credit_umum_penelitian = $credit_umum_penelitian->credit;
            }

            $publikasi_karya = PublikasiKarya::with(['anggotaDosen','anggotaMahasiswa'])->where('status','approved')
            ->whereHas('anggotaDosen', function ($query) use ($dl) {
                $query->where('user_id', $dl['id']);
            })->get()->toArray();

            foreach($publikasi_karya as $pk_index => $pk){
                // combine the anggota
                $publikasi_karya[$pk_index]['anggota'] = array_merge($pk['anggota_dosen'],$pk['anggota_mahasiswa']);

                // sorting urutannya
                usort($publikasi_karya[$pk_index]['anggota'],function($a,$b){
                    if($a['peran'] === 'ketua'){
                        return -1;
                    }elseif($b['peran'] === 'ketua'){
                        return 1;
                    }
                    return 0;
                });

                $credit_jenis_publikasi = PoinCreditJenis::find($pk['jenis_publikasi']);
                $credit_capaian_publikasi = PoinCreditCapaian::find($pk['kategori_capaian']);
                $total_poin = $credit_umum_penelitian + $credit_jenis_publikasi->credit + $credit_capaian_publikasi->credit;

                // algoritma bagi hasil
                $lIndex = 0;
                foreach($publikasi_karya[$pk_index]['anggota'] as $i => $a){
                    if(isset($a['user_id']) and $a['user_id'] === $dl['id']){
                        $lIndex = $i;
                        break;
                    }
                }

                if($lIndex === 0 and count($publikasi_karya[$pk_index]['anggota']) === 1){
                    // berikan 100% poin ke dosen ini
                    $penelitian_total += $total_poin;
                    $publikasi_karya[$pk_index]['kredit'] = $total_poin;
                }elseif($lIndex === 0 and count($publikasi_karya[$pk_index]['anggota']) > 1){
                    // berikan 60% poin ke dosen ini
                    $poin  = number_format(0.6 * $total_poin, 2);
                    $penelitian_total += $poin;
                    $publikasi_karya[$pk_index]['kredit'] = $poin;
                }elseif($lIndex > 0){
                    // berikan nilai 40% / jumlah anggota selain ketua (60% fix) dari total poin
                    $poin  = number_format( 0.4 / (count($publikasi_karya[$pk_index]['anggota']) - 1) * $total_poin, 2);
                    $penelitian_total += $poin;
                    $publikasi_karya[$pk_index]['kredit'] = $poin;
                }

                $publikasi_karya[$pk_index]['created_at'] = date('d-m-Y H:i:s', strtotime($publikasi_karya[$pk_index]['created_at']));
                $publikasi_karya[$pk_index]['updated_at'] = date('d-m-Y H:i:s', strtotime($publikasi_karya[$pk_index]['updated_at']));
                $publikasi_karya[$pk_index]['tanggal_terbit'] = date('d-m-Y H:i:s', strtotime($publikasi_karya[$pk_index]['tanggal_terbit']));
            }

            $pengabdian_total = 0;

            $credit_umum_pengabdian = PoinCreditUmum::where('type','pengabdian')->first();
            if(!$credit_umum_pengabdian){
                $credit_umum_pengabdian = 0;
            }else{
                $credit_umum_pengabdian = $credit_umum_pengabdian->credit;
            }

            $pengabdian = Pengabdian::with(['anggotaDosen','anggotaMahasiswa'])->where('status','approved')
            ->whereHas('anggotaDosen', function ($query) use ($dl) {
                $query->where('user_id', $dl['id']);
            })->get()->toArray();

            foreach($pengabdian as $p_index => $pk){
                // combine the anggota
                $pengabdian[$p_index]['anggota'] = array_merge($pk['anggota_dosen'],$pk['anggota_mahasiswa']);

                // sorting urutannya
                usort($pengabdian[$p_index]['anggota'],function($a,$b){
                    if($a['peran'] === 'ketua'){
                        return -1;
                    }elseif($b['peran'] === 'ketua'){
                        return 1;
                    }
                    return 0;
                });

                $credit_kategori_kegiatan = PoinCreditKegiatan::find($pk['kategori_kegiatan']);
                $total_poin = $credit_umum_pengabdian + $credit_kategori_kegiatan->credit;

                // algoritma bagi hasil
                $lIndex = 0;
                foreach($pengabdian[$p_index]['anggota'] as $i => $a){
                    if(isset($a['user_id']) and $a['user_id'] === $dl['id']){
                        $lIndex = $i;
                        break;
                    }
                }

                if($lIndex === 0 and count($pengabdian[$p_index]['anggota']) === 1){
                    // berikan 100% poin ke dosen ini
                    $pengabdian_total += $total_poin;
                    $pengabdian[$p_index]['kredit'] = $total_poin;
                }elseif($lIndex === 0 and count($pengabdian[$p_index]['anggota']) > 1){
                    // berikan 60% poin ke dosen ini
                    $poin = number_format(0.6 * $total_poin, 2);
                    $pengabdian_total += $poin;
                    $pengabdian[$p_index]['kredit'] = $poin;
                }elseif($lIndex > 0){
                    // berikan nilai 40% / jumlah anggota selain ketua (60% fix) dari total poin
                    $poin = number_format( 0.4 / (count($pengabdian[$p_index]['anggota']) - 1) * $total_poin, 2);
                    $pengabdian_total += $poin;
                    $pengabdian[$p_index]['kredit'] = $poin;
                }
            }

            // working on pengajaran
            $pengajaran_total = 0;
            $pengajaran = CreditPengajaran::with(['User.jurusan','KreditPengajaranMataKuliah'])->where('status','approved')
            ->where('user_id', $dl['id'])
            ->get()->toArray();

            foreach($pengajaran as $p_ajaran){
                $pengajaran_total += $p_ajaran['sks'] * $p_ajaran['kredit_pengajaran_mata_kuliah']['credit'];
            }

            $data_laporan[$index]['pengajaran_total'] = $pengajaran_total;
            $data_laporan[$index]['penelitian_total'] = $penelitian_total;
            $data_laporan[$index]['pengabdian_total'] = $pengabdian_total;
            $data_laporan[$index]['publikasi_karya'] = $publikasi_karya;
            $data_laporan[$index]['pengabdian'] = $pengabdian;
            $data_laporan[$index]['pengajaran'] = $pengajaran;
        }
        $settings = Settings::find(1);
        return view('layouts.app', [
            'title'=>'Data Laporan Penilaian',
            'user'=>$user,
            'settings'=>$settings,
            'data_laporan'=>$data_laporan,
            'criteria'=>$criteria,
            'content'=>resource_path('views/laporan-penilaian.blade.php')
        ]);

    }
}
