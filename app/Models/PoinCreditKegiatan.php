<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinCreditKegiatan extends Model
{
    protected $table = 'poin_credit_kegiatan';
    
    protected $fillable = [
        'name','credit'
    ];
}