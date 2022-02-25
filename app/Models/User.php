<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function userDetails()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id');
    }

}
