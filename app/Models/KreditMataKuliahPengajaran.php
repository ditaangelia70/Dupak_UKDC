<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KreditMataKuliahPengajaran extends Model
{
    protected $table = 'kredit_pengajaran_mata_kuliah';

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'jabatan_id',
        'jurusan_id',
        'credit'
    ];
    public function jabatan(){
        return $this->belongsTo(Jabatan::class);
    }
    public function jurusan(){
        return $this->belongsTo(ProgramStudi::class);
    }
}