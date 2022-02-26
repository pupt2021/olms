<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'materials_id';
    protected $guarded = [];
    public $timestamps = true;

    public function materialCopies()
    {
        return $this->hasMany('App\Models\MaterialCopy', 'materials_id', 'materials_id')->orderBy('date_recieved', 'DESC');
    }
}
