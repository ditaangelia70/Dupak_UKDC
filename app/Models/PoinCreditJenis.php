<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinCreditJenis extends Model
{
    protected $table = 'poin_credit_jenis';
    
    protected $fillable = [
        'name','credit'
    ];
}