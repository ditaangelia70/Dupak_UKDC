<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublikasiKaryaAnggotaEksternal extends Model
{
    protected $table = 'publikasi_karya_anggota_eksternal';
    protected $fillable = [
        'publikasi_karya_id',
        'nama',
        'institusi',
        'peran'
    ];
}
