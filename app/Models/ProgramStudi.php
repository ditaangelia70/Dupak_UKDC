<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';

    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];
}