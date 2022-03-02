<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrowing extends Model
{
    use SoftDeletes;
    
    protected $table = 'borrowings';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;
    protected $appends = ['formatted_date_borrowed_returned', 'formatted_date_borrowed', 'formatted_date_returned', 'days_overdue'];
    
    public function materialCopy()
    {
        return $this->belongsTo('App\Models\MaterialCopy', 'material_copy_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function penalty()
    {
        return $this->belongsTo('App\Models\Penalty', 'id', 'borrowings_id');
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

    /**
     * Format the Date Borrowed Column
     * @return string
     */
    public function getFormattedDateBorrowedAttribute()
    {
        return date_format(date_create($this->date_borrowed), 'F d, Y');
    }

    /**
     * Format the Date Returned Column
     * @return string
     */
    public function getFormattedDateReturnedAttribute()
    {
        return date_format(date_create($this->date_returned), 'F d, Y');
    }

    /**
     * Get the Overdue Date of Borrowing
     * @return int
     */
    public function getDaysOverdueAttribute(): int
    {
        $returned_date = Carbon::createMidnightDate($this->date_returned);
        $daysOverdue = (int) $returned_date->diffInDays(now(), false);
        return $daysOverdue;
    }
}
