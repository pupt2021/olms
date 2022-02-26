<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $table = 'borrowings';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;
    protected $appends = ['formatted_date_borrowed_returned'];
    
    public function materialCopy()
    {
        return $this->belongsTo('App\Models\MaterialCopy', 'material_copy_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    /**
     * Format the Date Borrowed + Date Returned Column
     * @return string
     */
    public function getFormattedDateBorrowedReturnedAttribute()
    {
        return date_format(date_create($this->date_borrowed), 'F d, Y') 
            . ' - '
            . date_format(date_create($this->date_returned), 'F d, Y') ;
    }
}
