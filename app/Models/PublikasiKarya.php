<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublikasiKarya extends Model
{
    protected $table = 'publikasi_karya';

    protected $fillable = [
        'user_id',
        'pk_1', 'pk_2', 'pk_3', 'pk_4', 'pk_5',
        'pk_6', 'pk_7', 'pk_8', 'pk_9', 'pk_10',
        'pk_11', 'pk_12', 'pk_13',
        'jenis_publikasi',
        'kategori_capaian',
        'aktivitas_litabmas',
        'judul_artikel',
        'nama_seminar',
        'tanggal_terbit',
        'penerbit_penyelenggara',
        'kota_penyelenggaraan',
        'seminar',
        'prosiding',
        'bahasa',
        'isbn',
        'issn',
        'e_issn',
        'tautan_eksternal',
        'keterangan',
        'status','review_notes'
    ];

    protected $casts = [
        'pk_1' => 'boolean',
        'pk_2' => 'boolean',
        'pk_3' => 'boolean',
        'pk_4' => 'boolean',
        'pk_5' => 'boolean',
        'pk_6' => 'boolean',
        'pk_7' => 'boolean',
        'pk_8' => 'boolean',
        'pk_9' => 'boolean',
        'pk_10' => 'boolean',
        'pk_11' => 'boolean',
        'pk_12' => 'boolean',
        'pk_13' => 'boolean',
        'seminar' => 'boolean',
        'prosiding' => 'boolean',
        'tanggal_terbit' => 'date',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenis_publikasi(){
        return $this->belongsTo(PoinCreditJenis::class, 'jenis_publikasi');
    }

    public function kategori_capaian(){
        return $this->belongsTo(PoinCreditCapaian::class, 'kategori_capaian');
    }

    public function anggotaDosen()
    {
        return $this->hasMany(PublikasiKaryaAnggotaDosen::class);
    }

    public function anggotaMahasiswa()
    {
        return $this->hasMany(PublikasiKaryaAnggotaMahasiswa::class);
    }

    public function anggotaEksternal()
    {
        return $this->hasMany(PublikasiKaryaAnggotaEksternal::class);
    }
}
