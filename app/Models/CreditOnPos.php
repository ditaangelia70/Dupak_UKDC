<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditOnPos extends Model
{
    protected $table = 'credit_on_pos';
    
    public $timestamps = false;
    protected $fillable = [
        'sub_sub_criteria_id',
        'jabatan_id',
        'credit'
    ];
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function subSubCriteria(){
        return $this->belongsTo(SubSubCriteria::class);
    }
}