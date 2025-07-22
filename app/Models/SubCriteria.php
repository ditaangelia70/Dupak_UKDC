<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCriteria extends Model
{
    protected $table = 'sub_criteria';
    
    public $timestamps = false;
    protected $fillable = [
        'name',
        'criteria_id'
    ];
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
    public function subSubCriteria(){
        return $this->hasMany(SubSubCriteria::class);
    }
}