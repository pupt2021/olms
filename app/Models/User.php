<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function userDetails()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id');
    }

}
