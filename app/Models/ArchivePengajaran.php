<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivePengajaran extends Model
{
    protected $table = 'archive_pengajaran';

    public $timestamps = false;
    
    protected $fillable = [
        'pengajaran_id',
        'path'
    ];

    public function CreditPengajaran(){
        return $this->belongsTo(CreditPengajaran::class);
    }
}