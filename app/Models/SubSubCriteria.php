<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubCriteria extends Model
{
    protected $table = 'sub_sub_criteria';
    
    public $timestamps = false;
    protected $fillable = [
        'name',
        'sub_criteria_id',
        'unit',
        'credit'
    ];
    public function subCriteria(){
        return $this->belongsTo(SubCriteria::class);
    }
    public function credit(){
        return $this->hasMany(Credit::class);
    }
    public function archives()
    {
        return $this->hasMany(Archives::class);
    }
    public function creditOnPos()
    {
        return $this->hasMany(CreditOnPos::class);
    }
}