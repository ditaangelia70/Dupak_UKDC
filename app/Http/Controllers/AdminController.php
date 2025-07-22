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
use App\Models\Criteria;
use App\Models\SubCriteria;
use App\Models\SubSubCriteria;
use App\Models\Credit;
use App\Models\Archives;
use App\Models\Jabatan;
use App\Models\CreditOnPos;
use App\Models\PoinCreditUmum;
use App\Models\PoinCreditJenis;
use App\Models\PoinCreditCapaian;
use App\Models\PoinCreditKegiatan;

use App\Models\PublikasiKarya;
use App\Models\Pengabdian;

use App\Models\ProgramStudi;
use App\Models\CreditPengajaran;


use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
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
    public function home(Request $request)
    {
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }

        $criteria_ = Criteria::count();
        $sub_criteria = SubCriteria::count();
        $sub_sub_criteria = SubSubCriteria::count();
        $jabatan = Jabatan::count();
        $settings = Settings::find(1);

        $criteria = Criteria::all()->toArray();

        $credit = Credit::with(['user','subSubCriteria.subCriteria.criteria','subSubCriteria.creditOnPos.jabatan'])->get()->toArray();

        foreach($criteria as $index => $jtem){
            if(!isset($criteria[$index]['point'])){
                $criteria[$index]['point'] = 0;
            }
            foreach($credit as $item){
                if($item['sub_sub_criteria']['sub_criteria']['criteria_id'] === $jtem['id']){
                    if(count($item['sub_sub_criteria']['credit_on_pos']) > 0){
                        $found_credit = null;
                        foreach($item['sub_sub_criteria']['credit_on_pos'] as $cop_index => $credit_op){
                            if($credit_op['jabatan']['name'] === $item['user']['pangkat']){
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
        ->get()->toArray();

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
            $penelitian_total += $total_poin;
        }

        $pengabdian_total = 0;

        $credit_umum_pengabdian = PoinCreditUmum::where('type','pengabdian')->first();
        if(!$credit_umum_pengabdian){
            $credit_umum_pengabdian = 0;
        }else{
            $credit_umum_pengabdian = $credit_umum_pengabdian->credit;
        }

        $pengabdian = Pengabdian::with(['anggotaDosen','anggotaMahasiswa'])->where('status','approved')
        ->get()->toArray();

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
            $pengabdian_total += $total_poin;
        }

        $pengajaran_total = 0;
        $pengajaran = CreditPengajaran::with('KreditPengajaranMataKuliah')->where('status','approved')
        ->get()->toArray();
        foreach($pengajaran as $p_ajaran){
            $pengajaran_total += $p_ajaran['kredit_pengajaran_mata_kuliah']['credit'] * $p_ajaran['sks'];
        }

        return view('layouts.app', [
            'title'=>'Admin: Dashboard',
            'user'=>$user,
            'criteria_'=>$criteria_,
            'criteria'=>$criteria,
            'sub_criteria'=>$sub_criteria,
            'sub_sub_criteria'=>$sub_sub_criteria,
            'settings'=>$settings,
            'jabatan'=>$jabatan,
            'penelitian_total'=>$penelitian_total,
            'pengabdian_total'=>$pengabdian_total,
            'pengajaran_total'=>$pengajaran_total,
            'content'=>resource_path('views/admin/home/index.blade.php')
        ]);
    }
    public function users(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }

        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                $data['password'] = Hash::make($data['username']);
                $user = User::create($data);
                return redirect('/admin/users');
            }else{
                $settings = Settings::find(1);
                $jabatan = Jabatan::all();
                $jurusan = ProgramStudi::all()->toArray();
                return view('layouts.app', [
                    'title'=>'Admin: Akun Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'jabatan'=>$jabatan,
                    'jurusan'=>$jurusan,
                    'content'=>resource_path('views/admin/master-akun/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            $akun = User::with(['archives','jurusan'])->find($id)->toArray();
            $criteria = Criteria::all()->toArray();

            $credit = Credit::with(['subSubCriteria.subCriteria.criteria','subSubCriteria.creditOnPos.jabatan'])->where('user_id',$id)->get()->toArray();

            foreach($criteria as $index => $jtem){
                if(!isset($criteria[$index]['point'])){
                    $criteria[$index]['point'] = 0;
                }
                foreach($credit as $item){
                    if($item['sub_sub_criteria']['sub_criteria']['criteria_id'] === $jtem['id']){
                        if(count($item['sub_sub_criteria']['credit_on_pos']) > 0){
                            $found_credit = null;
                            foreach($item['sub_sub_criteria']['credit_on_pos'] as $cop_index => $credit_op){
                                if($credit_op['jabatan']['name'] === $akun['pangkat']){
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

            // return response()->json($criteria);

            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();

                    if(!empty($data['new_password'])){
                        $data['password'] = $data['password'] = Hash::make($data['new_password']);
                    }
                    $user = User::find($id);
                    if($user){
                        $user->update($data);
                    }
                    return redirect('/admin/users?t=edit&id='.$id);
                }else{
                    $jabatan = Jabatan::all();
                    $settings = Settings::find(1);
                    $jurusan = ProgramStudi::all()->toArray();
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Akun',
                        'user'=>$user,
                        'akun'=>$akun,
                        'settings'=>$settings,
                        'criteria'=>$criteria,
                        'jabatan'=>$jabatan,
                        'jurusan'=>$jurusan,
                        'content'=>resource_path('views/admin/master-akun/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/users');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $user = User::find($id);
                if($user){
                    $user->delete();
                }
            }
            return redirect('/admin/users');
        }else{
            $settings = Settings::find(1);
            $users = User::all();
            return view('layouts.app', [
                'title'=>'Admin: Master Akun',
                'user'=>$user,
                'settings'=>$settings,
                'users'=>$users,
                'content'=>resource_path('views/admin/master-akun/index.blade.php')
            ]);
        }
    }
    public function settings(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $settings = Settings::find(1);
            if($settings){
                if ($request->hasFile('web_icon')) {
                    $file = $request->file('web_icon');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    if (!empty($settings->web_icon)) {
                        $oldFile = base_path('public/uploads/' . $settings->web_icon);
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                    if ($file->move(base_path('public/uploads'), $filename)) {
                        $data['web_icon'] = $filename;
                    }
                }
                $settings->update($data);
                return redirect('/admin/settings');
            }
            echo json_encode(['status'=>false,'message'=>'Error! the data settings is not found!']);
        }else{
            $settings = Settings::find(1);
            return view('layouts.app', [
                'title'=>'Admin: Pengaturan Web',
                'user'=>$user,
                'settings'=>$settings,
                'content'=>resource_path('views/admin/settings/index.blade.php')
            ]);
        }
    }
    public function criteria(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                // creating the billboard data
                $criteria = Criteria::create($data);
                return redirect('/admin/criteria');
            }else{
                $settings = Settings::find(1);
                return view('layouts.app', [
                    'title'=>'Admin: Kriteria Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'content'=>resource_path('views/admin/criteria/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $criteria = Criteria::find($id);
                    if($criteria){
                        $criteria->update($data);
                    }
                    return redirect('/admin/criteria?t=edit&id='.$id);
                }else{
                    $criteria = Criteria::find($id);
                    $settings = Settings::find(1);
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Kriteria',
                        'user'=>$user,
                        'criteria'=>$criteria,
                        'settings'=>$settings,
                        'content'=>resource_path('views/admin/criteria/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/criteria');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $criteria = Criteria::find($id);
                if($criteria){
                    $criteria->delete();
                }
            }
            return redirect('/admin/criteria');
        }else{
            $settings = Settings::find(1);
            $criteria = Criteria::with('subCriteria')->get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Master Akun',
                'user'=>$user,
                'settings'=>$settings,
                'criteria'=>$criteria,
                'content'=>resource_path('views/admin/criteria/index.blade.php')
            ]);
        }
    }
    public function sub_criteria(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                // creating the billboard data
                $sub_criteria = SubCriteria::create($data);
                return redirect('/admin/sub-criteria');
            }else{
                $settings = Settings::find(1);
                $criteria = Criteria::all();
                return view('layouts.app', [
                    'title'=>'Admin: Sub Kriteria Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'criteria'=>$criteria,
                    'content'=>resource_path('views/admin/sub-criteria/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $sub_criteria = SubCriteria::find($id);
                    if($sub_criteria){
                        $sub_criteria->update($data);
                    }
                    return redirect('/admin/sub-criteria?t=edit&id='.$id);
                }else{
                    $criteria = Criteria::all();
                    $settings = Settings::find(1);
                    $this_criteria = SubCriteria::find($id);
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Sub Kriteria',
                        'user'=>$user,
                        'criteria'=>$criteria,
                        'this_criteria'=>$this_criteria,
                        'settings'=>$settings,
                        'content'=>resource_path('views/admin/sub-criteria/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/sub-criteria');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $sub_criteria = SubCriteria::find($id);
                if($sub_criteria){
                    $sub_criteria->delete();
                }
            }
            return redirect('/admin/sub-criteria');
        }else{
            $settings = Settings::find(1);
            $sub_criteria = SubCriteria::with(['criteria','subSubCriteria'])->get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Master Sub Kriteria',
                'user'=>$user,
                'settings'=>$settings,
                'sub_criteria'=>$sub_criteria,
                'content'=>resource_path('views/admin/sub-criteria/index.blade.php')
            ]);
        }
    }
    public function sub_sub_criteria(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                // creating the billboard data
                $sub_sub_criteria = SubSubCriteria::create($data);
                return redirect('/admin/sub-sub-criteria');
            }else{
                $settings = Settings::find(1);
                $criteria = Criteria::with('subCriteria')->get()->toArray();
                return view('layouts.app', [
                    'title'=>'Admin: Sub Sub Kriteria Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'criteria'=>$criteria,
                    'content'=>resource_path('views/admin/sub-sub-criteria/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $sub_sub_criteria = SubSubCriteria::find($id);
                    if($sub_sub_criteria){
                        $sub_sub_criteria->update($data);
                    }
                    return redirect('/admin/sub-sub-criteria?t=edit&id='.$id);
                }else{
                    $criteria = Criteria::with('subCriteria')->get()->toArray();
                    $settings = Settings::find(1);
                    $this_sub_sub_criteria = SubSubCriteria::with('subCriteria.criteria')->where('id',$id)->first()->toArray();
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Sub Sub Kriteria',
                        'user'=>$user,
                        'criteria'=>$criteria,
                        'this_sub_sub_criteria'=>$this_sub_sub_criteria,
                        'settings'=>$settings,
                        'content'=>resource_path('views/admin/sub-sub-criteria/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/sub-sub-criteria');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $sub_sub_criteria = SubSubCriteria::find($id);
                if($sub_sub_criteria){
                    $sub_sub_criteria->delete();
                }
            }
            return redirect('/admin/sub-sub-criteria');
        }else{
            $settings = Settings::find(1);
            $sub_sub_criteria = SubSubCriteria::with(['subCriteria.criteria','creditOnPos.jabatan'])->get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Master Sub Sub Kriteria',
                'user'=>$user,
                'settings'=>$settings,
                'sub_sub_criteria'=>$sub_sub_criteria,
                'content'=>resource_path('views/admin/sub-sub-criteria/index.blade.php')
            ]);
        }
    }
    public function appointment_update(Request $request){
        $data = $request->all();
        $data_ = Credit::where('sub_sub_criteria_id',$data['sub_sub_criteria_id'])
        ->where('user_id',$data['user_id'])->first();
        if($data_){
            $data_->update(['qty'=>$data['value']]);
        }else{
            Credit::create(['user_id'=>$data['user_id'],'qty'=>$data['value'],'sub_sub_criteria_id'=>$data['sub_sub_criteria_id']]);
        }
        // make all the archive data of this user to finished
        $archive = Archives::find($data['archive_id']);
        $archive->update(['status'=>$data['status'],'commented_at'=>Carbon::now()]);
        return response()->json(['valid'=>true]);
    }
    public function appointment(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $id = $request->input('id', null);
        if($id){

            $akun = User::find($id);
            $settings = Settings::find(1);
            $criteria = Criteria::with(['subCriteria.subSubCriteria.archives','subCriteria.subSubCriteria.creditOnPos.jabatan'])->get()->toArray();
            $credit = Credit::with('subSubCriteria.creditOnPos.jabatan')->where('user_id',$akun->id)->get()->toArray();
            foreach($criteria as $cindex => $c){
                if(isset($c['sub_criteria']) and count($c['sub_criteria'])){
                    foreach($c['sub_criteria'] as $scindex => $sc){
                        if(isset($sc['sub_sub_criteria']) and count($sc['sub_sub_criteria'])){
                            foreach($sc['sub_sub_criteria'] as $sscindex => $ssc){
                                if(count($ssc['credit_on_pos']) > 0){
                                    foreach($ssc['credit_on_pos'] as $cop_index => $credit_op){
                                        if($credit_op['jabatan']['name'] === $akun->pangkat){
                                            $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['credit'] = $credit_op['credit'];
                                        }
                                    }
                                }
                                $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['qty'] = 0;
                                foreach($credit as $crindex => $cr){
                                    if($cr['sub_sub_criteria']['id'] === $ssc['id']){
                                        $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['qty'] = $cr['qty'];
                                        if(count($cr['sub_sub_criteria']['credit_on_pos']) > 0){
                                            foreach($cr['sub_sub_criteria']['credit_on_pos'] as $cop_index => $credit_op){
                                                if($credit_op['jabatan']['name'] === $akun->pangkat){
                                                    $criteria[$cindex]['sub_criteria'][$scindex]['sub_sub_criteria'][$sscindex]['credit'] = $credit_op['credit'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }        
                    }
                }
            }
            return view('layouts.app', [
                'title'=>'Admin: Input Pengajuan',
                'user'=>$user,
                'akun'=>$akun,
                'settings'=>$settings,
                'criteria'=>$criteria,
                'content'=>resource_path('views/admin/master-akun/appointment.blade.php')
            ]);
        }
    }
    public function catatan_berkas(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $id = $_GET['id'];
        if($request->isMethod('post')){
            $data = $request->all();
            $archive = Archives::find($id);
            if($archive){
                $archive->update([
                    'comment'=>$data['comment'],
                    'commentator_id'=>$user['id'],
                    'commented_at'=>Carbon::now()
                ]);
            }
            return redirect('/admin/appointment?id='.$_GET['old_id']);
        }else{
            $archive = Archives::with(['commentator','subSubCriteria.subCriteria.criteria'])->find($id)->toArray();
            $settings = Settings::find(1);
            return view('layouts.app', [
                'title'=>'Admin: Catatan Berkas',
                'user'=>$user,
                'settings'=>$settings,
                'archive'=>$archive,
                'content'=>resource_path('views/admin/catatan-berkas/index.blade.php')
            ]);
        }
    }
    public function upload_berkas(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        
        $id = $_GET['id'];
        $akun = User::find($_GET['userId']);

        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('archive')) {
                $file = $request->file('archive');
                $randomName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                if ($file->move(base_path('public/uploads'), $randomName)) {
                    $data['url'] = $randomName;
                }
            }

            Archives::create(['sub_sub_criteria_id'=>$id,'user_id'=>$akun['id'],'url'=>$data['url']]);
            return redirect('/admin/appointment?id='.$akun['id']);
        }else{
            $criteria = SubSubCriteria::with('subCriteria.criteria')->find($id)->toArray();
            $settings = Settings::find(1);
            return view('layouts.app', [
                'title'=>'Admin: Upload Berkas',
                'user'=>$user,
                'criteria'=>$criteria,
                'settings'=>$settings,
                'akun'=>$akun,
                'content'=>resource_path('views/admin/berkas/index.blade.php')
            ]);
        }
    }
    public function jabatan(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                // creating the billboard data
                $jabatan = Jabatan::create($data);
                return redirect('/admin/jabatan');
            }else{
                $settings = Settings::find(1);
                return view('layouts.app', [
                    'title'=>'Admin: Jabatan Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'content'=>resource_path('views/admin/jabatan/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $jabatan = Jabatan::find($id);
                    if($jabatan){
                        $jabatan->update($data);
                    }
                    return redirect('/admin/jabatan?t=edit&id='.$id);
                }else{
                    $jabatan = Jabatan::find($id);
                    $settings = Settings::find(1);
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Kriteria',
                        'user'=>$user,
                        'jabatan'=>$jabatan,
                        'settings'=>$settings,
                        'content'=>resource_path('views/admin/jabatan/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/jabatan');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $jabatan = Jabatan::find($id);
                if($jabatan){
                    $jabatan->delete();
                }
            }
            return redirect('/admin/jabatan');
        }else{
            $settings = Settings::find(1);
            $jabatan = Jabatan::get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Master Akun',
                'user'=>$user,
                'settings'=>$settings,
                'jabatan'=>$jabatan,
                'content'=>resource_path('views/admin/jabatan/index.blade.php')
            ]);
        }
    }
    public function kredit_jabatan(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                // creating the billboard data
                $kredit_jabatan = CreditOnPos::create($data);
                return redirect('/admin/kredit-jabatan');
            }else{
                $settings = Settings::find(1);
                $criteria = Criteria::with('subCriteria.subSubCriteria')->get()->toArray();
                $jabatan = Jabatan::all();
                return view('layouts.app', [
                    'title'=>'Admin: Kredit Jabatan Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'criteria'=>$criteria,
                    'jabatan'=>$jabatan,
                    'content'=>resource_path('views/admin/kredit-jabatan/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $kredit_jabatan = CreditOnPos::find($id);
                    if($kredit_jabatan){
                        $kredit_jabatan->update($data);
                    }
                    return redirect('/admin/kredit-jabatan?t=edit&id='.$id);
                }else{
                    $settings = Settings::find(1);
                    $criteria = Criteria::with('subCriteria.subSubCriteria')->get()->toArray();
                    $jabatan = Jabatan::all();
                    $kredit_jabatan = CreditOnPos::with('subSubCriteria.subCriteria.criteria')->find($id)->toArray();
                    return view('layouts.app', [
                        'title'=>'Admin: Kredit Jabatan Baru',
                        'user'=>$user,
                        'settings'=>$settings,
                        'criteria'=>$criteria,
                        'jabatan'=>$jabatan,
                        'kredit_jabatan'=>$kredit_jabatan,
                        'content'=>resource_path('views/admin/kredit-jabatan/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/jabatan');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $kredit_jabatan = CreditOnPos::find($id);
                if($kredit_jabatan){
                    $kredit_jabatan->delete();
                }
            }
            return redirect('/admin/kredit-jabatan');
        }else{
            $settings = Settings::find(1);
            $kredit_jabatan = CreditOnPos::with(['subSubCriteria.subCriteria.criteria','jabatan'])->get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Kredit Jabatan',
                'user'=>$user,
                'settings'=>$settings,
                'kredit_jabatan'=>$kredit_jabatan,
                'content'=>resource_path('views/admin/kredit-jabatan/index.blade.php')
            ]);
        }
    }
    public function pk_umum(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                $kredit_umum = PoinCreditUmum::create($data);
                return redirect('/admin/poin-kredit-umum');
            }else{
                $settings = Settings::find(1);
                return view('layouts.app', [
                    'title'=>'Admin: Kredit Umum Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'content'=>resource_path('views/admin/poin-kredit-umum/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $kredit_umum = PoinCreditUmum::find($id);
                    if($kredit_umum){
                        $kredit_umum->update($data);
                    }
                    return redirect('/admin/poin-kredit-umum?t=edit&id='.$id);
                }else{
                    $settings = Settings::find(1);
                    $kredit_umum = PoinCreditUmum::find($id)->toArray();
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Kredit Umum',
                        'user'=>$user,
                        'settings'=>$settings,
                        'kredit_umum'=>$kredit_umum,
                        'content'=>resource_path('views/admin/poin-kredit-umum/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/poin-kredit-umum');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $kredit_umum = PoinCreditUmum::find($id);
                if($kredit_umum){
                    $kredit_umum->delete();
                }
            }
            return redirect('/admin/poin-kredit-umum');
        }else{
            $settings = Settings::find(1);
            $poin_kredit_umum = PoinCreditUmum::get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Poin Kredit Umum',
                'user'=>$user,
                'settings'=>$settings,
                'poin_kredit_umum'=>$poin_kredit_umum,
                'content'=>resource_path('views/admin/poin-kredit-umum/index.blade.php')
            ]);
        }
    }
    public function pk_jenis(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                $kredit_umum = PoinCreditJenis::create($data);
                return redirect('/admin/poin-kredit-jenis');
            }else{
                $settings = Settings::find(1);
                return view('layouts.app', [
                    'title'=>'Admin: Kredit Jenis Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'content'=>resource_path('views/admin/poin-kredit-jenis/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $kredit_jenis = PoinCreditJenis::find($id);
                    if($kredit_jenis){
                        $kredit_jenis->update($data);
                    }
                    return redirect('/admin/poin-kredit-jenis?t=edit&id='.$id);
                }else{
                    $settings = Settings::find(1);
                    $kredit_jenis = PoinCreditJenis::find($id)->toArray();
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Kredit Jenis',
                        'user'=>$user,
                        'settings'=>$settings,
                        'kredit_jenis'=>$kredit_jenis,
                        'content'=>resource_path('views/admin/poin-kredit-jenis/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/poin-kredit-jenis');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $kredit_jenis = PoinCreditJenis::find($id);
                if($kredit_jenis){
                    $kredit_jenis->delete();
                }
            }
            return redirect('/admin/poin-kredit-jenis');
        }else{
            $settings = Settings::find(1);
            $poin_kredit_jenis = PoinCreditJenis::get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Poin Kredit Jenis',
                'user'=>$user,
                'settings'=>$settings,
                'poin_kredit_jenis'=>$poin_kredit_jenis,
                'content'=>resource_path('views/admin/poin-kredit-jenis/index.blade.php')
            ]);
        }
    }
    public function pk_capaian(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                $kredit_capaian = PoinCreditCapaian::create($data);
                return redirect('/admin/poin-kredit-capaian');
            }else{
                $settings = Settings::find(1);
                return view('layouts.app', [
                    'title'=>'Admin: Kredit Capaian Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'content'=>resource_path('views/admin/poin-kredit-capaian/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $kredit_capaian = PoinCreditCapaian::find($id);
                    if($kredit_capaian){
                        $kredit_capaian->update($data);
                    }
                    return redirect('/admin/poin-kredit-capaian?t=edit&id='.$id);
                }else{
                    $settings = Settings::find(1);
                    $kredit_capaian = PoinCreditCapaian::find($id)->toArray();
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Kredit Capaian',
                        'user'=>$user,
                        'settings'=>$settings,
                        'kredit_capaian'=>$kredit_capaian,
                        'content'=>resource_path('views/admin/poin-kredit-capaian/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/poin-kredit-capaian');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $kredit_capaian = PoinCreditCapaian::find($id);
                if($kredit_capaian){
                    $kredit_capaian->delete();
                }
            }
            return redirect('/admin/poin-kredit-capaian');
        }else{
            $settings = Settings::find(1);
            $poin_kredit_capaian = PoinCreditCapaian::get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Poin Kredit Capaian',
                'user'=>$user,
                'settings'=>$settings,
                'poin_kredit_capaian'=>$poin_kredit_capaian,
                'content'=>resource_path('views/admin/poin-kredit-capaian/index.blade.php')
            ]);
        }
    }
    public function pk_kegiatan(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                $kredit_kegiatan = PoinCreditKegiatan::create($data);
                return redirect('/admin/poin-kredit-kegiatan');
            }else{
                $settings = Settings::find(1);
                return view('layouts.app', [
                    'title'=>'Admin: Kredit Kegaitan Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'content'=>resource_path('views/admin/poin-kredit-kegiatan/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $kredit_kegiatan = PoinCreditKegiatan::find($id);
                    if($kredit_kegiatan){
                        $kredit_kegiatan->update($data);
                    }
                    return redirect('/admin/poin-kredit-kegiatan?t=edit&id='.$id);
                }else{
                    $settings = Settings::find(1);
                    $kredit_kegiatan = PoinCreditKegiatan::find($id)->toArray();
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Kredit Kegiatan',
                        'user'=>$user,
                        'settings'=>$settings,
                        'kredit_kegiatan'=>$kredit_kegiatan,
                        'content'=>resource_path('views/admin/poin-kredit-kegiatan/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/poin-kredit-kegiatan');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $kredit_kegiatan = PoinCreditKegiatan::find($id);
                if($kredit_kegiatan){
                    $kredit_kegiatan->delete();
                }
            }
            return redirect('/admin/poin-kredit-kegiatan');
        }else{
            $settings = Settings::find(1);
            $poin_kredit_kegiatan = PoinCreditKegiatan::get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Poin Kredit Kegiatan',
                'user'=>$user,
                'settings'=>$settings,
                'poin_kredit_kegiatan'=>$poin_kredit_kegiatan,
                'content'=>resource_path('views/admin/poin-kredit-kegiatan/index.blade.php')
            ]);
        }
    }
    public function prodi(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'admin'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                // creating the billboard data
                $prodi = ProgramStudi::create($data);
                return redirect('/admin/prodi');
            }else{
                $settings = Settings::find(1);
                return view('layouts.app', [
                    'title'=>'Admin: Program Studi Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'content'=>resource_path('views/admin/program-studi/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $prodi = ProgramStudi::find($id);
                    if($prodi){
                        $prodi->update($data);
                    }
                    return redirect('/admin/prodi?t=edit&id='.$id);
                }else{
                    $prodi = ProgramStudi::find($id);
                    $settings = Settings::find(1);
                    return view('layouts.app', [
                        'title'=>'Admin: Edit Program Studi',
                        'user'=>$user,
                        'prodi'=>$prodi,
                        'settings'=>$settings,
                        'content'=>resource_path('views/admin/program-studi/edit.blade.php')
                    ]);
                }
            }
            return redirect('/admin/prodi');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $prodi = ProgramStudi::find($id);
                if($prodi){
                    $prodi->delete();
                }
            }
            return redirect('/admin/prodi');
        }else{
            $settings = Settings::find(1);
            $prodi = ProgramStudi::get()->toArray();
            return view('layouts.app', [
                'title'=>'Admin: Master Akun',
                'user'=>$user,
                'settings'=>$settings,
                'prodi'=>$prodi,
                'content'=>resource_path('views/admin/program-studi/index.blade.php')
            ]);
        }
    }
}
