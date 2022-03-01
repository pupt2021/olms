<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalty extends Model
{
    use SoftDeletes;
    protected $table = 'penalty';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function borrowing()
    {
        return $this->belongsTo('App\Models\Borrowing', 'borrowings_id', 'id')->orderBy('date_returned', 'ASC');
    }
}
