<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengabdianAnggotaDosen extends Model
{
    protected $table = 'pengabdian_anggota_dosen';
    protected $fillable = [
    	'pengabdian_id',
    	'nama_dosen',
    	'peran',
        'user_id'
    ];
}
