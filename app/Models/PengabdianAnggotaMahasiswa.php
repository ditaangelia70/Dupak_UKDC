<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengabdianAnggotaMahasiswa extends Model
{
    protected $table = 'pengabdian_anggota_mahasiswa';
    protected $fillable = [
    	'pengabdian_id',
    	'nama_mahasiswa',
    	'peran'
    ];
}
