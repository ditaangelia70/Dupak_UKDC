<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];
    public function creditOnPos()
    {
        return $this->hasMany(CreditOnPos::class);
    }
}