<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $table = 'borrowings';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function materialCopy()
    {
        return $this->belongsTo('App\Models\MaterialCopy', 'material_copy_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
}
