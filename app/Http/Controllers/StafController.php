<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Models\User;

use App\Models\Settings;

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
use App\Models\PoinCreditKegiatan;

use App\Models\Jabatan;

use App\Models\KreditMataKuliahPengajaran;
use App\Models\CreditPengajaran;


use Illuminate\Support\Facades\Hash;

class StafController extends BaseController
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

        if($user->role !== 'staf'){
            return redirect('/'.$user->role);
        }
        $settings = Settings::find(1);

        $archives = Archives::with('user')->where('status', 'pending')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('jurusan', $user->jurusan);
            })
            ->orderByDesc('id')
            ->get()
            ->unique('user_id')
            ->count();

        $credit_pengajaran = CreditPengajaran::where('jurusan_id', $user->jurusan)
        ->where('status','pending')->count();

        $pengabdian = Pengabdian::with('user')->where('status', 'pending')
            ->whereHas('user', function($query) use ($user) {
                $query->where('jurusan', $user->jurusan);
            })->count();

        $publikasi_karya = PublikasiKarya::with('user')->where('status', 'pending')
            ->whereHas('user', function($query) use ($user) {
                $query->where('jurusan', $user->jurusan);
            })->count();

        return view('layouts.app', [
            'title'=>'Staf: Dashboard',
            'user'=>$user,
            'archives'=>$archives,
            'settings'=>$settings,
            'credit_pengajaran'=>$credit_pengajaran,
            'pengabdian'=>$pengabdian,
            'publikasi_karya'=>$publikasi_karya,
            'content'=>resource_path('views/staf/home/index.blade.php')
        ]);
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

        if($user->role !== 'staf'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'edit'){
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
                    'title'=>'Staf: Input Pengajuan',
                    'user'=>$user,
                    'akun'=>$akun,
                    'settings'=>$settings,
                    'criteria'=>$criteria,
                    'content'=>resource_path('views/staf/pengajuan/appointment.blade.php')
                ]);
            }
            return redirect('/staf/appointment');
        }else{
            $settings = Settings::find(1);
            $archives = Archives::with(['subSubCriteria', 'user'])
            ->where('status','pending')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('jurusan', $user->jurusan);
            })
            ->orderBy('id', 'desc')
            ->get()
            ->unique('sub_sub_criteria_id')
            ->values()->toArray();
            return view('layouts.app', [
                'title'=>'Staf: Pengajuan',
                'user'=>$user,
                'settings'=>$settings,
                'archives'=>$archives,
                'content'=>resource_path('views/staf/pengajuan/index.blade.php')
            ]);
        }
    }
    public function catatan_berkas(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'staf'){
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
            return redirect('/staf/appointment?t=edit&id='.$_GET['old_id']);
        }else{
            $archive = Archives::with(['commentator','subSubCriteria.subCriteria.criteria'])->find($id)->toArray();
            $settings = Settings::find(1);
            return view('layouts.app', [
                'title'=>'Staf: Catatan Berkas',
                'user'=>$user,
                'settings'=>$settings,
                'archive'=>$archive,
                'content'=>resource_path('views/staf/catatan-berkas/index.blade.php')
            ]);
        }
    }
    public function upload_berkas(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'staf'){
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
            return redirect('/staf/appointment?t=edit&id='.$akun['id']);
        }else{
            $criteria = SubSubCriteria::with('subCriteria.criteria')->find($id)->toArray();
            $settings = Settings::find(1);
            return view('layouts.app', [
                'title'=>'Staf: Upload Berkas',
                'user'=>$user,
                'criteria'=>$criteria,
                'settings'=>$settings,
                'akun'=>$akun,
                'content'=>resource_path('views/staf/berkas/index.blade.php')
            ]);
        }
    }
    public function publikasi_karya(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'staf'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    // creating the billboard data
                    $publikasi = PublikasiKarya::find($id);
                    if($publikasi){
                        $publikasi->update(['status'=>$data['status'],'review_notes'=>$data['review_notes']]);
                    }
                    return redirect('/staf/publikasi-karya?t=edit&id='.$id);
                }else{
                    $publikasi = PublikasiKarya::with(['anggotaDosen','anggotaMahasiswa','anggotaEksternal','user'])->find($id)->toArray();
                    $settings = Settings::find(1);
                    return view('layouts.app', [
                        'title'=>'Dosen: Edit publikasi',
                        'user'=>$user,
                        'publikasi'=>$publikasi,
                        'settings'=>$settings,
                        'content'=>resource_path('views/staf/publikasi-karya/edit.blade.php')
                    ]);
                }
            }
            return redirect('/staf/publikasi-karya');
        }else{
            $settings = Settings::find(1);
            $publikasi = PublikasiKarya::with('user')->where('status','pending')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('jurusan', $user->jurusan);
            })->get()->toArray();
            foreach($publikasi as $index => $p){
                $publikasi[$index]['created_at'] = date('d-m-Y H:i:s', strtotime($p['created_at']));
                $publikasi[$index]['tanggal_terbit'] = date('d-m-Y', strtotime($p['tanggal_terbit']));
            }
            return view('layouts.app', [
                'title'=>'Dosen: Publikasi Karya',
                'user'=>$user,
                'settings'=>$settings,
                'publikasi'=>$publikasi,
                'content'=>resource_path('views/staf/publikasi-karya/index.blade.php')
            ]);
        }
    }
    public function pengabdian(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'staf'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'detail'){
            $id = $request->input('id', null);
            if($request->isMethod('post')){
                $data = $request->all();
                $pengabdian = Pengabdian::find($id);
                if($pengabdian){
                    $pengabdian->update(['status'=>$data['status'],'review_notes'=>$data['review_notes']]);
                }
                return redirect('/staf/pengabdian?t=detail&id='.$id);
            }else{
                if($id){
                    $pengabdian = Pengabdian::with(['dokumen','anggotaDosen','anggotaMahasiswa','anggotaEksternal','user'])->find($id)->toArray();
                    $kategori_kegiatan = PoinCreditKegiatan::get()->toArray();
                    $settings = Settings::find(1);
                    return view('layouts.app', [
                        'title'=>'Staf: Detail Pengabdian',
                        'user'=>$user,
                        'pengabdian'=>$pengabdian,
                        'settings'=>$settings,
                        'kategori_kegiatan'=>$kategori_kegiatan,
                        'content'=>resource_path('views/staf/pengabdian/edit.blade.php')
                    ]);
                }
            }
            return redirect('/staf/pengabdian');
        }else{
            $settings = Settings::find(1);
            $pengabdian = Pengabdian::with(['dokumen','anggotaDosen','anggotaMahasiswa','anggotaEksternal','user'])
            ->where('status', 'pending')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('jurusan', $user->jurusan);
            })
            ->get()
            ->toArray();
            foreach($pengabdian as $index => $p){
                $pengabdian[$index]['created_at'] = date('d-m-Y H:i:s', strtotime($p['created_at']));
                $pengabdian[$index]['updated_at'] = date('d-m-Y H:i:s', strtotime($p['updated_at']));
            }
            return view('layouts.app', [
                'title'=>'Staf: Pengabdian',
                'user'=>$user,
                'settings'=>$settings,
                'pengabdian'=>$pengabdian,
                'content'=>resource_path('views/staf/pengabdian/index.blade.php')
            ]);
        }
    }
    public function spesial_update(Request $request){
        $id = $request->input('id');
        $user_id = $request->input('akun_id');
        $qty = $request->input('value');
        $data_ = Credit::where('sub_sub_criteria_id',$id)
        ->where('user_id',$user_id)->first();
        if($data_){
            $data_->update(['qty'=>$qty]);
        }else{
            Credit::create(['user_id'=>$user_id,'qty'=>$qty,'sub_sub_criteria_id'=>$id]);
        }
        return response()->json(['valid'=>true]);
    }
    public function kredit_mata_kuliah(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'staf'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'add'){
            if($request->isMethod('post')){
                $data = $request->all();
                $data['jurusan_id'] = $user->jurusan;
                $kredit = KreditMataKuliahPengajaran::create($data);
                return redirect('/staf/kredit-mata-kuliah');
            }else{
                $settings = Settings::find(1);
                $jabatan = Jabatan::all()->toArray();
                return view('layouts.app', [
                    'title'=>'Staf: Kredit Mata Kuliah Baru',
                    'user'=>$user,
                    'settings'=>$settings,
                    'jabatan'=>$jabatan,
                    'content'=>resource_path('views/staf/kredit-mata-kuliah/add.blade.php')
                ]);
            }
        }elseif($mode === 'edit'){
            $id = $request->input('id', null);
            if($id){
                if($request->isMethod('post')){
                    $data = $request->all();
                    $data['jurusan_id'] = $user->jurusan;
                    // creating the billboard data
                    $kredit = KreditMataKuliahPengajaran::find($id);
                    if($kredit){
                        $kredit->update($data);
                    }
                    return redirect('/staf/kredit-mata-kuliah?t=edit&id='.$id);
                }else{
                    $kredit = KreditMataKuliahPengajaran::find($id)->toArray();
                    $jabatan = Jabatan::all()->toArray();
                    $settings = Settings::find(1);
                    return view('layouts.app', [
                        'title'=>'Staf: Edit Kredit Mata Kuliah',
                        'user'=>$user,
                        'kredit'=>$kredit,
                        'jabatan'=>$jabatan,
                        'settings'=>$settings,
                        'content'=>resource_path('views/staf/kredit-mata-kuliah/edit.blade.php')
                    ]);
                }
            }
            return redirect('/staf/kredit-mata-kuliah');
        }elseif($mode === 'delete'){
            $id = $request->input('id', null);
            if($id){
                $kredit = KreditMataKuliahPengajaran::find($id);
                if($kredit){
                    $kredit->delete();
                }
            }
            return redirect('/staf/kredit-mata-kuliah');
        }else{
            $settings = Settings::find(1);
            $kredit = KreditMataKuliahPengajaran::with(['jurusan','jabatan'])
            ->where('jurusan_id', $user->jurusan)
            ->get()->toArray();
            return view('layouts.app', [
                'title'=>'Staf: Kredit Mata Kuliah Pengajaran',
                'user'=>$user,
                'settings'=>$settings,
                'kredit'=>$kredit,
                'content'=>resource_path('views/staf/kredit-mata-kuliah/index.blade.php')
            ]);
        }
    }
    public function pengajuan_pengajaran(Request $request){
        $user = $this->get_user($request);
        if(!$user){
            return redirect('/login');
        }

        if($user->role !== 'staf'){
            return redirect('/'.$user->role);
        }
        $mode = $request->input('t','');

        if($mode === 'edit'){
            $id = $request->input('id', null);
            if($request->isMethod('post')){
                $data = $request->all();
                $pengajaran = CreditPengajaran::find($id);
                if($pengajaran){
                    $pengajaran->update($data);
                }
                return redirect('/staf/pengajuan-pengajaran');
            }else{
                $settings = Settings::find(1);
                $kredit = CreditPengajaran::with('archives')->find($id);
                $user_kredit = User::find($kredit->user_id);
                $jabatan = Jabatan::where('name',$user_kredit->pangkat)->first();
                $kredit_pengajaran_mata_kuliah = KreditMataKuliahPengajaran::where('jabatan_id',$jabatan->id)
                ->where('jurusan_id',$user->jurusan)->get()->toArray();
                return view('layouts.app', [
                    'title'=>'Staf: Pengajuan Pengajaran',
                    'user'=>$user,
                    'settings'=>$settings,
                    'kredit'=>$kredit,
                    'kredit_pengajaran_mata_kuliah'=>$kredit_pengajaran_mata_kuliah,
                    'content'=>resource_path('views/staf/pengajuan-pengajaran/edit.blade.php')
                ]);
            }
        }else{
            $settings = Settings::find(1);
            $kredit_pengajaran = CreditPengajaran::with(['user','Jurusan', 'KreditPengajaranMataKuliah'])
            ->where('jurusan_id',$user->jurusan)
            ->where('status','pending')
            ->get()->toArray();
            foreach($kredit_pengajaran as $index => $p){
                $kredit_pengajaran[$index]['created_at'] = date('d-m-Y H:i:s', strtotime($p['created_at']));
                $kredit_pengajaran[$index]['updated_at'] = date('d-m-Y H:i:s', strtotime($p['updated_at']));
            }
            return view('layouts.app', [
                'title'=>'Staf: Pengajuan Pengajaran',
                'user'=>$user,
                'settings'=>$settings,
                'kredit_pengajaran'=>$kredit_pengajaran,
                'content'=>resource_path('views/staf/pengajuan-pengajaran/index.blade.php')
            ]);
        }
    }
}
