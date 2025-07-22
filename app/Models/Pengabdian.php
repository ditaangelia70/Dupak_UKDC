<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    protected $table = 'pengabdian';

    protected $fillable = [
        'user_id',
        'kategori_kegiatan', 'judul_kegiatan', 'affiliasi', 'kelompok_bidang',
        'litabmas_sebelumnya', 'jenis_skim', 'lokasi_kegiatan',
        'tahun_usulan', 'tahun_kegiatan', 'tahun_pelaksanaan',
        'lama_kegiatan', 'dana_dikti', 'dana_pt', 'dana_lain',
        'in_kind', 'nomor_sk', 'tanggal_sk', 'nama_mitra', 'status', 'review_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumen()
    {
        return $this->hasMany(PengabdianDokumen::class);
    }

    public function anggotaDosen()
    {
        return $this->hasMany(PengabdianAnggotaDosen::class);
    }

    public function anggotaMahasiswa()
    {
        return $this->hasMany(PengabdianAnggotaMahasiswa::class);
    }

    public function anggotaEksternal()
    {
        return $this->hasMany(PengabdianAnggotaEksternal::class);
    }

    public function kategori_kegiatan(){
        return $this->belongsTo(PoinCreditKegiatan::class, 'kategori_kegiatan');
    }
}
