<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengabdianAnggotaEksternal extends Model
{
    protected $table = 'pengabdian_anggota_eksternal';
    protected $fillable = [
    	'pengabdian_id',
    	'nama',
        'institusi',
    	'peran'
    ];
}
