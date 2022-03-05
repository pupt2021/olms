<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialSubject extends Model
{
    protected $table = 'materials_subject';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;
}
