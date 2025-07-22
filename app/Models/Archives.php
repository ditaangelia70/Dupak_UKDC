<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archives extends Model
{
    protected $table = 'archives';

    public $timestamps = false;
    
    protected $fillable = [
        'sub_sub_criteria_id',
        'user_id',
        'status',
        'url',
        'comment',
        'commentator_id',
        'commented_at'
    ];
    public function subSubCriteria()
    {
        return $this->belongsTo(SubSubCriteria::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentator()
    {
        return $this->belongsTo(User::class, 'commentator_id');
    }
}