<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
    
class Material extends Model
{
    use SoftDeletes;

    protected $table = 'materials';
    protected $primaryKey = 'materials_id';
    protected $guarded = [];
    public $timestamps = true;

    public function materialCopies()
    {
        return $this->hasMany('App\Models\MaterialCopy', 'materials_id', 'materials_id')->orderBy('date_recieved', 'DESC');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\MaterialSubject', 'materials_subject_link',  'mat_id', 'sub_id');
    }
}
