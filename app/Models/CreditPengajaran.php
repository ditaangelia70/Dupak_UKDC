<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditPengajaran extends Model
{
    protected $table = 'credit_pengajaran';
    
    protected $fillable = [
        'user_id',
        'kredit_pengajaran_mata_kuliah_id',
        'jurusan_id',
        'sks',
        'type',
        'tahun_ajaran',
        'kelompok',
        'semester',
        'status',
        'keterangan'
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Jurusan()
    {
        return $this->belongsTo(ProgramStudi::class);
    }
    public function KreditPengajaranMataKuliah(){
        return $this->belongsTo(KreditMataKuliahPengajaran::class);
    }
    public function archives(){
        return $this->hasMany(ArchivePengajaran::class, 'pengajaran_id');
    }
}