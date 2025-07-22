<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinCreditCapaian extends Model
{
    protected $table = 'poin_credit_capaian';
    
    protected $fillable = [
        'name','credit'
    ];
}