<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublikasiKaryaAnggotaDosen extends Model
{
    protected $table = 'publikasi_karya_anggota_dosen';
    protected $fillable = [
    	'publikasi_karya_id',
    	'nama_dosen',
    	'peran',
        'user_id'
    ];
}
