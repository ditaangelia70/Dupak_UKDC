<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'criteria';

    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];
    public function subCriteria()
    {
        return $this->hasMany(SubCriteria::class);
    }
    public function archives()
    {
        return $this->hasMany(Archives::class);
    }
}