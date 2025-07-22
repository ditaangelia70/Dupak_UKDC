<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengabdianDokumen extends Model
{
    protected $table = 'pengabdian_dokumen';
    protected $fillable = [
    	'pengabdian_id',
    	'nama_dokumen',
    	'keterangan',
    	'jenis_dokumen',
    	'tautan_dokumen',
    	'file_path'
    ];
}
