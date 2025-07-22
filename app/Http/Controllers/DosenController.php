<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use App\Models\User;

use App\Models\Settings;

use Illuminate\Support\Facades\Hash;
use App\Models\Criteria;
use App\Models\SubCriteria;
use App\Models\SubSubCriteria;
use App\Models\Credit;
use App\Models\Archives;
use App\Models\PublikasiKarya;
use App\Models\Pengabdian;
use App\Models\PengabdianDokumen;
use App\Models\PengabdianAnggotaDosen;
use App\Models\PengabdianAnggotaMahasiswa;
use App\Models\PengabdianAnggotaEksternal;
use App\Models\PublikasiKaryaAnggotaDosen;
use App\Models\PublikasiKaryaAnggotaMahasiswa;
use App\Models\PublikasiKaryaAnggotaEksternal;

use App\Models\PoinCreditJenis;
use App\Models\PoinCreditUmum;
use App\Models\PoinCreditCapaian;
use App\Models\PoinCreditKegiatan;

use App\Models\CreditPengajaran;
use App\Models\KreditMataKuliahPengajaran;
use App\Models\Jabatan;

use App\Models\ArchivePengajaran;

class DosenController extends BaseController
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
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }

        $criteria = Criteria::count();
        $sub_criteria = SubCriteria::count();
        $sub_sub_criteria = SubSubCriteria::count();
        $settings = Settings::find(1);

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
                            $criteria[$index]['point'] += $item['qty'] * $found_credit;
                        }
                    }else{
                        $criteria[$index]['point'] += $item['qty'] * $item['sub_sub_criteria']['credit'];
                    }
                }
            }
        }

        // working on total data penelitian dan pengabdian
        $penelitian_total = 0;
        
        $credit_umum_penelitian = PoinCreditUmum::where('type','penelitian')->first();
        if(!$credit_umum_penelitian){
            $credit_umum_penelitian = 0;
        }else{
            $credit_umum_penelitian = $credit_umum_penelitian->credit;
        }

        $publikasi_karya = PublikasiKarya::with(['anggotaDosen','anggotaMahasiswa'])->where('status','approved')
        ->whereHas('anggotaDosen', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get()->toArray();

        foreach($publikasi_karya as $index => $pk){
            // combine the anggota
            $publikasi_karya[$index]['anggota'] = array_merge($pk['anggota_dosen'],$pk['anggota_mahasiswa']);

            // sorting urutannya
            usort($publikasi_karya[$index]['anggota'],function($a,$b){
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
            foreach($publikasi_karya[$index]['anggota'] as $i => $a){
                if(isset($a['user_id']) and $a['user_id'] === $user->id){
                    $lIndex = $i;
                    break;
                }
            }

            if($lIndex === 0 and count($publikasi_karya[$index]['anggota']) === 1){
                // berikan 100% poin ke dosen ini
                $penelitian_total += $total_poin;
            }elseif($lIndex === 0 and count($publikasi_karya[$index]['anggota']) > 1){
                // berikan 60% poin ke dosen ini
                $penelitian_total += number_format(0.6 * $total_poin, 2);
            }elseif($lIndex > 0){
                // berikan nilai 40% / jumlah anggota selain ketua (60% fix) dari total poin
                $penelitian_total += number_format( 0.4 / (count($publikasi_karya[$index]['anggota']) - 1) * $total_poin, 2);
            }
        }

        $pengabdian_total = 0;

        $credit_umum_pengabdian = PoinCreditUmum::where('type','pengabdian')->first();
        if(!$credit_umum_pengabdian){
            $credit_umum_pengabdian = 0;
        }else{
            $credit_umum_pengabdian = $credit_umum_pengabdian->credit;
        }

        $pengabdian = Pengabdian::with(['anggotaDosen','anggotaMahasiswa'])->where('status','approved')
        ->whereHas('anggotaDosen', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get()->toArray();

        foreach($pengabdian as $index => $pk){
            // combine the anggota
            $pengabdian[$index]['anggota'] = array_merge($pk['anggota_dosen'],$pk['anggota_mahasiswa']);

            // sorting urutannya
            usort($pengabdian[$index]['anggota'],function($a,$b){
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
            foreach($pengabdian[$index]['anggota'] as $i => $a){
                if(isset($a['user_id']) and $a['user_id'] === $user->id){
                    $lIndex = $i;
                    break;
                }
            }

            if($lIndex === 0 and count($pengabdian[$index]['anggota']) === 1){
                // berikan 100% poin ke dosen ini
                $pengabdian_total += $total_poin;
            }elseif($lIndex === 0 and count($pengabdian[$index]['anggota']) > 1){
                // berikan 60% poin ke dosen ini
                $pengabdian_total += number_format(0.6 * $total_poin, 2);
            }elseif($lIndex > 0){
                // berikan nilai 40% / jumlah anggota selain ketua (60% fix) dari total poin
                $pengabdian_total += number_format( 0.4 / (count($pengabdian[$index]['anggota']) - 1) * $total_poin, 2);
            }
        }

        $pengajaran_total = 0;
        $pengajaran = CreditPengajaran::with('KreditPengajaranMataKuliah')->where('status','approved')
        ->where('user_id', $user->id)->get()->toArray();
        foreach($pengajaran as $p_ajaran){
            $pengajaran_total += $p_ajaran['kredit_pengajaran_mata_kuliah']['credit'] * $p_ajaran['sks'];
        }

        return view('layouts.app', [
            'title'=>'Dosen: Dashboard',
            'user'=>$user,
            'criteria'=>$criteria,
            'settings'=>$settings,
            'penelitian_total'=>$penelitian_total,
            'pengabdian_total'=>$pengabdian_total,
            'pengajaran_total'=>$pengajaran_total,
            'content'=>resource_path('views/dosen/home/index.blade.php')
        ]);
    }
    public function penilaian(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }
        
        $settings = Settings::find(1);
        $criteria = Criteria::with([
            'subCriteria.subSubCriteria.archives' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            },
            'subCriteria.subSubCriteria.creditOnPos.jabatan'
        ])->get()->toArray();

        $credit = Credit::with('subSubCriteria.creditOnPos.jabatan')->where('user_id',$user->id)->get()->toArray();
        foreach($criteria as $cindex => $c){
            if(isset($c['sub_criteria']) and count($c['sub_criteria'])){
                foreach($c['sub_criteria'] as $scindex => $sc){
                    if(isset($sc['sub_sub_criteria']) and count($sc['sub_sub_criteria'])){
                        foreach($sc['sub_sub_criteria'] as $sscindex => $ssc){
                            if(count($ssc['credit_on_pos']) > 0){
                                foreach($ssc['credit_on_pos'] as $cop_index => $credit_op){
                                    if($credit_op['jabatan']['name'] === $user->pangkat){
                                        $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['credit'] = $credit_op['credit'];
                                    }
                                }
                            }
                            $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['point'] = 0;
                            $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['qty'] = 0;
                            foreach($credit as $crindex => $cr){
                                if($cr['sub_sub_criteria']['id'] === $ssc['id']){
                                    $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['qty'] = $cr['qty'];
                                    if(count($cr['sub_sub_criteria']['credit_on_pos']) > 0){
                                        foreach($cr['sub_sub_criteria']['credit_on_pos'] as $cop_index => $credit_op){
                                            if($credit_op['jabatan']['name'] === $user->pangkat){
                                                $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['credit'] = $credit_op['credit'];
                                                $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['point'] += $cr['qty'] * $credit_op['credit'];
                                            }
                                        }
                                    }else{
                                        $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['point'] += $cr['qty'] * $ssc['credit'];
                                    }
                                }
                            }
                        }
                    }        
                }
            }
        }
        return view('layouts.app', [
            'title'=>'Dosen: Penilaian',
            'user'=>$user,
            'settings'=>$settings,
            'criteria'=>$criteria,
            'content'=>resource_path('views/dosen/penilaian/index.blade.php')
        ]);
    }
    public function upload_berkas(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }
        
        $id = $_GET['id'];

        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('archive')) {
                $file = $request->file('archive');
                $randomName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                if ($file->move(base_path('public/uploads'), $randomName)) {
                    $data['url'] = $randomName;
                }
            }

            Archives::create(['sub_sub_criteria_id'=>$id,'user_id'=>$user->id,'url'=>$data['url']]);
            return redirect('/dosen/penilaian');
        }else{
            $criteria = SubSubCriteria::with('subCriteria.criteria')->find($id)->toArray();
            $settings = Settings::find(1);
            return view('layouts.app', [
                'title'=>'Dosen: Upload Berkas',
                'user'=>$user,
                'criteria'=>$criteria,
                'settings'=>$settings,
                'content'=>resource_path('views/dosen/berkas/index.blade.php')
            ]);
        }
    }
    public function catatan_berkas(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }
        $id = $_GET['id'];
        $archive = Archives::with(['commentator','subSubCriteria.subCriteria.criteria'])->find($id)->toArray();
        $settings = Settings::find(1);
        return view('layouts.app', [
            'title'=>'Dosen: Catatan Berkas',
            'user'=>$user,
            'settings'=>$settings,
            'archive'=>$archive,
            'content'=>resource_path('views/dosen/catatan-berkas/index.blade.php')
        ]);
    }
    public function status_pengajuan(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }
        $settings = Settings::find(1);
        $archives = Archives::with(['subSubCriteria.subCriteria.criteria', 'user'])
        ->where('user_id',$user['id'])
        ->orderByDesc('id')
        ->get()
        ->values()->toArray();
        return view('layouts.app', [
            'title'=>'Dosen: Pengajuan',
            'user'=>$user,
            'settings'=>$settings,
            'archives'=>$archives,
            'content'=>resource_path('views/dosen/pengajuan/index.blade.php')
        ]);
    }
    public function publikasi_karya(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                for($i=1;$i<=13;$i++){
                    if(isset($data['pk_'.$i]) and $data['pk_'.$i] === 'on'){
                        $data['pk_'.$i] = true;
                    }
                }
                // seminar and prosiding handler
                if(isset($data['seminar']) and $data['seminar'] === 'on'){
                    $data['seminar'] = true;
                }
                if(isset($data['prosiding']) and $data['prosiding'] === 'on'){
                    $data['prosiding'] = true;
                }

                $data['user_id'] = $user->id;
                $publikasi_karya = PublikasiKarya::create($data);

                // getting the anggota dosen data
                foreach($data['nama_anggota_dosen'] as $index => $ad){
                    $dosen = User::find($ad);
                    $anggota_dosen = [
                        'publikasi_karya_id'=>$publikasi_karya->id,
                        'nama_dosen'=>$dosen->name.' | '.$dosen->username,
                        'user_id'=>$ad,
                        'peran'=>$data['peran_anggota_dosen'][$index]
                    ];
                    PublikasiKaryaAnggotaDosen::create($anggota_dosen);
                }
                // getting the anggota mahasiswa data
                foreach($data['nama_anggota_mahasiswa'] as $index => $am){
                    $anggota_mahasiswa = [
                        'publikasi_karya_id'=>$publikasi_karya->id,
                        'nama_mahasiswa'=>$am,
                        'peran'=>$data['peran_anggota_mahasiswa'][$index]
                    ];
                    PublikasiKaryaAnggotaMahasiswa::create($anggota_mahasiswa);
                }
                // getting the anggota eksternal data
                foreach($data['nama_anggota_eksternal'] as $index => $ae){
                    $anggota_eksternal = [
                        'publikasi_karya_id'=>$publikasi_karya->id,
                        'nama'=>$ae,
                        'institusi'=>$data['institusi_anggota_eksternal'][$index],
                        'peran'=>$data['peran_anggota_eksternal'][$index]
                    ];
                    PublikasiKaryaAnggotaEksternal::create($anggota_eksternal);
                }
                return redirect('/dosen/publikasi-karya');
            }else{
                $settings = Settings::find(1);
                $kredit_jenis = PoinCreditJenis::get()->toArray();
                $kredit_capaian = PoinCreditCapaian::get()->toArray();
                $dosen_avail = User::where('role','dosen')->get()->toArray();
                return view('layouts.app', [
                    'title'=>'Dosen: Publikasi Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'kredit_jenis'=>$kredit_jenis,
                    'kredit_capaian'=>$kredit_capaian,
                    'dosen_avail'=>$dosen_avail,
                    'content'=>resource_path('views/dosen/publikasi-karya/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    for($i=1;$i<=13;$i++){
                        if(isset($data['pk_'.$i]) and $data['pk_'.$i] === 'on'){
                            $data['pk_'.$i] = true;
                        }else{
                            $data['pk_'.$i] = false;
                        }
                    }
                    // seminar and prosiding handler
                    if(isset($data['seminar']) and $data['seminar'] === 'on'){
                        $data['seminar'] = true;
                    }else{
                        $data['seminar'] = false;
                    }
                    if(isset($data['prosiding']) and $data['prosiding'] === 'on'){
                        $data['prosiding'] = true;
                    }else{
                        $data['prosiding'] = false;
                    }
                    $data['user_id'] = $user->id;
                    $publikasi_karya = PublikasiKarya::find($id);
                    if($publikasi_karya){
                        $publikasi_karya->update($data);
                    }
                    return redirect('/dosen/publikasi-karya');
                }else{
                    $publikasi = PublikasiKarya::with(['anggotaDosen','anggotaMahasiswa','anggotaEksternal'])->find($id)->toArray();
                    $kredit_jenis = PoinCreditJenis::get()->toArray();
                    $kredit_capaian = PoinCreditCapaian::get()->toArray();
                    $settings = Settings::find(1);
                    return view('layouts.app', [
                        'title'=>'Dosen: Edit publikasi',
                        'user'=>$user,
                        'publikasi'=>$publikasi,
                        'settings'=>$settings,
                        'kredit_jenis'=>$kredit_jenis,
                        'kredit_capaian'=>$kredit_capaian,
                        'content'=>resource_path('views/dosen/publikasi-karya/edit.blade.php')
                    ]);
                }
            }
            return redirect('/dosen/publikasi-karya');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $publikasi = PublikasiKarya::find($id);
                if($publikasi){
                    $publikasi->delete();
                }
            }
            return redirect('/dosen/publikasi-karya');
        }else{
            $settings = Settings::find(1);
            $publikasi = PublikasiKarya::where('user_id',$user->id)->get()->toArray();
            foreach($publikasi as $index => $p){
                $publikasi[$index]['created_at'] = date('d-m-Y H:i:s', strtotime($p['created_at']));
                $publikasi[$index]['tanggal_terbit'] = date('d-m-Y', strtotime($p['tanggal_terbit']));
            }
            return view('layouts.app', [
                'title'=>'Dosen: Publikasi Karya',
                'user'=>$user,
                'settings'=>$settings,
                'publikasi'=>$publikasi,
                'content'=>resource_path('views/dosen/publikasi-karya/index.blade.php')
            ]);
        }
    }
    public function pengabdian(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();

                $data['user_id'] = $user->id;
                $pengabdian = Pengabdian::create($data);
                
                // getting the documents data
                foreach($data['nama_dokumen'] as $index => $d){
                    $document = [
                        'pengabdian_id'=>$pengabdian->id,
                        'nama_dokumen'=>$d,
                        'keterangan'=>$data['keterangan_dokumen'][$index],
                        'jenis_dokumen'=>$data['jenis_dokumen'][$index],
                        'tautan_dokumen'=>$data['tautan_dokumen'][$index],
                        'file_path'=>null
                    ];
                    if (isset($data['dokumen_file'][$index])) {
                        $file = $data['dokumen_file'][$index];
                        $randomName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                        if ($file->move(base_path('public/uploads'), $randomName)) {
                            $document['file_path'] = $randomName;
                        }
                    }
                    PengabdianDokumen::create($document);
                }
                // getting the anggota dosen data
                foreach($data['nama_anggota_dosen'] as $index => $ad){
                    $dosen = User::find($ad);
                    $anggota_dosen = [
                        'pengabdian_id'=>$pengabdian->id,
                        'nama_dosen'=>$dosen->name.' | '.$dosen->username,
                        'user_id'=>$ad,
                        'peran'=>$data['peran_anggota_dosen'][$index]
                    ];
                    PengabdianAnggotaDosen::create($anggota_dosen);
                }
                // getting the anggota mahasiswa data
                foreach($data['nama_anggota_mahasiswa'] as $index => $am){
                    $anggota_mahasiswa = [
                        'pengabdian_id'=>$pengabdian->id,
                        'nama_mahasiswa'=>$am,
                        'peran'=>$data['peran_anggota_mahasiswa'][$index]
                    ];
                    PengabdianAnggotaMahasiswa::create($anggota_mahasiswa);
                }
                // getting the anggota eksternal data
                foreach($data['nama_anggota_eksternal'] as $index => $ae){
                    $anggota_eksternal = [
                        'pengabdian_id'=>$pengabdian->id,
                        'nama'=>$ae,
                        'institusi'=>$data['institusi_anggota_eksternal'][$index],
                        'peran'=>$data['peran_anggota_eksternal'][$index]
                    ];
                    PengabdianAnggotaEksternal::create($anggota_eksternal);
                }
                return redirect('/dosen/pengabdian');
            }else{
                $settings = Settings::find(1);
                $kategori_kegiatan = PoinCreditKegiatan::get()->toArray();
                $dosen_avail = User::where('role','dosen')->get()->toArray();
                return view('layouts.app', [
                    'title'=>'Dosen: Pengabdian Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'kategori_kegiatan'=>$kategori_kegiatan,
                    'dosen_avail'=>$dosen_avail,
                    'content'=>resource_path('views/dosen/pengabdian/add.blade.php')
                ]);
            }
        }elseif($mode === 'detail'){
            $id = $request->input('id', null);
            if($id){
                $pengabdian = Pengabdian::with(['dokumen','anggotaDosen','anggotaMahasiswa','anggotaEksternal'])->find($id)->toArray();
                $settings = Settings::find(1);
                $kategori_kegiatan = PoinCreditKegiatan::get()->toArray();
                return view('layouts.app', [
                    'title'=>'Dosen: Detail Pengabdian',
                    'user'=>$user,
                    'pengabdian'=>$pengabdian,
                    'settings'=>$settings,
                    'kategori_kegiatan'=>$kategori_kegiatan,
                    'content'=>resource_path('views/dosen/pengabdian/edit.blade.php')
                ]);
            }
            return redirect('/dosen/publikasi-karya');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $pengabdian = Pengabdian::find($id);
                if($pengabdian){
                    $pengabdian->delete();
                }
            }
            return redirect('/dosen/pengabdian');
        }else{
            $settings = Settings::find(1);
            $pengabdian = Pengabdian::with(['dokumen','anggotaDosen','anggotaMahasiswa','anggotaEksternal','user'])->where('user_id',$user->id)->get()->toArray();
            foreach($pengabdian as $index => $p){
                $pengabdian[$index]['created_at'] = date('d-m-Y H:i:s', strtotime($p['created_at']));
                $pengabdian[$index]['updated_at'] = date('d-m-Y H:i:s', strtotime($p['updated_at']));
            }
            return view('layouts.app', [
                'title'=>'Dosen: Pengabdian',
                'user'=>$user,
                'settings'=>$settings,
                'pengabdian'=>$pengabdian,
                'content'=>resource_path('views/dosen/pengabdian/index.blade.php')
            ]);
        }
    }
    public function pengajaran(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'dosen'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                $data['user_id'] = $user->id;
                $data['jurusan_id'] = $user->jurusan;
                $pengajaran = CreditPengajaran::create($data);

                // upload the archive
                if ($request->hasFile('archive')) {
                    $file = $request->file('archive');
                    $randomName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                    if ($file->move(base_path('public/uploads'), $randomName)) {
                        ArchivePengajaran::create([
                            'path'=>$randomName,
                            'pengajaran_id'=>$pengajaran->id
                        ]);
                    }
                }

                return redirect('/dosen/pengajaran');
            }else{
                $settings = Settings::find(1);
                $jabatan = Jabatan::where('name',$user->pangkat)->first();
                $kredit_pengajaran_mata_kuliah = KreditMataKuliahPengajaran::where('jabatan_id',$jabatan->id)
                ->where('jurusan_id',$user->jurusan)->get()->toArray();
                return view('layouts.app', [
                    'title'=>'Dosen: Pengajaran Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'kredit_pengajaran_mata_kuliah'=>$kredit_pengajaran_mata_kuliah,
                    'content'=>resource_path('views/dosen/pengajaran/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($request->isMethod('post')){
                $data = $request->all();
                $data['user_id'] = $user->id;
                $data['jurusan_id'] = $user->jurusan;
                $pengajaran = CreditPengajaran::find($id);
                if($pengajaran){
                    $pengajaran->update($data);
                    // upload the archive
                    if ($request->hasFile('archive')) {
                        $file = $request->file('archive');
                        $randomName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                        if ($file->move(base_path('public/uploads'), $randomName)) {
                            ArchivePengajaran::where('pengajaran_id',$pengajaran->id)->delete();
                            ArchivePengajaran::create([
                                'path'=>$randomName,
                                'pengajaran_id'=>$pengajaran->id
                            ]);
                        }
                    }
                }
                return redirect('/dosen/pengajaran');
            }else{
                $settings = Settings::find(1);
                $jabatan = Jabatan::where('name',$user->pangkat)->first();
                $kredit_pengajaran_mata_kuliah = KreditMataKuliahPengajaran::where('jabatan_id',$jabatan->id)
                ->where('jurusan_id',$user->jurusan)->get()->toArray();
                $kredit = CreditPengajaran::with('archives')->find($id);
                return view('layouts.app', [
                    'title'=>'Dosen: Edit Pengajaran',
                    'user'=>$user,
                    'settings'=>$settings,
                    'kredit'=>$kredit,
                    'kredit_pengajaran_mata_kuliah'=>$kredit_pengajaran_mata_kuliah,
                    'content'=>resource_path('views/dosen/pengajaran/edit.blade.php')
                ]);
            }
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $kredit_pengajaran = CreditPengajaran::find($id);
                if($kredit_pengajaran){
                    $kredit_pengajaran->delete();
                }
            }
            return redirect('/dosen/pengajaran');
        }else{
            $settings = Settings::find(1);
            $kredit_pengajaran = CreditPengajaran::with(['Jurusan', 'KreditPengajaranMataKuliah'])
            ->where('user_id',$user->id)->get()->toArray();
            foreach($kredit_pengajaran as $index => $p){
                $kredit_pengajaran[$index]['created_at'] = date('d-m-Y H:i:s', strtotime($p['created_at']));
                $kredit_pengajaran[$index]['updated_at'] = date('d-m-Y H:i:s', strtotime($p['updated_at']));
            }
            return view('layouts.app', [
                'title'=>'Dosen: Pengabdian',
                'user'=>$user,
                'settings'=>$settings,
                'kredit_pengajaran'=>$kredit_pengajaran,
                'content'=>resource_path('views/dosen/pengajaran/index.blade.php')
            ]);
        }
    }
}
