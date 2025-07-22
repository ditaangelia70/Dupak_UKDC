<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublikasiKaryaAnggotaMahasiswa extends Model
{
    protected $table = 'publikasi_karya_anggota_mahasiswa';
    protected $fillable = [
    	'publikasi_karya_id',
    	'nama_mahasiswa',
    	'peran'
    ];
}
