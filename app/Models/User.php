<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // protected $fillable = [
    //     'name', 'email', 'password', 'role', 'username'
    // ];

    protected $fillable = [
        'name', 'password', 'role', 'username',
        'seri_karpeg',
        'tempat_tanggal_lahir',
        'kredit_pendidikan_terhitung',
        'pangkat',
        'jurusan',
        'fakultas',
        'universitas'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    // Implement JWTSubject Methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function archives()
    {
        return $this->hasMany(Archives::class);
    }

    public function credit()
    {
        return $this->hasMany(Credit::class);
    }

    public function publikasi_karya()
    {
        return $this->hasMany(PublikasiKarya::class);
    }

    public function jurusan(){
        return $this->belongsTo(ProgramStudi::class, 'jurusan');
    }

    // public function getAuthIdentifierName()
    // {
    //     return 'username';
    // }

}
