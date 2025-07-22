<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'credit';
    
    public $timestamps = false;
    protected $fillable = [
        'name',
        'sub_sub_criteria_id',
        'user_id',
        'qty'
    ];
    public function subSubCriteria(){
        return $this->belongsTo(SubSubCriteria::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}