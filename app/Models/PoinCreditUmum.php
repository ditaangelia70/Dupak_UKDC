<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinCreditUmum extends Model
{
    protected $table = 'poin_credit_umum';
    
    protected $fillable = [
        'name','credit'
    ];
    public function pengabdian()
    {
        return $this->hasMany(Pengabdian::class);
    }
}