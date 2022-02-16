<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'materials_id';
    protected $guarded = [];
    public $timestamps = true;


}
