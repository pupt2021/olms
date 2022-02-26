<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialCopy extends Model
{
    protected $table = 'materials_copies';
    protected $primaryKey = 'material_copy_id';
    protected $guarded = [];
    public $timestamps = false;

    protected $appends = ['digit_in_accession_number', 'formatted_date_recieved'];

    public function borrowings()
    {
        return $this->hasMany('App\Models\Borrowing', 'material_copy_id', 'material_copy_id')->orderBy('date_returned', 'DESC');
    }

    public function material()
    {
        return $this->belongsTo('App\Models\Material', 'materials_id', 'materials_id');
    }  

    /**
     * Get the number in the Accession Number
     * @return string
     */
    public function getDigitInAccessionNumberAttribute()
    {
        $matches = array();
        if (preg_match('/(\d+)$/', $this->accession_number, $matches)) {
            $number = $matches[0];
            return $number;
        }
    }

    /**
     * Format the Date Recieved Column
     * @return string
     */
    public function getFormattedDateRecievedAttribute()
    {
        return date_format(date_create($this->date_recieved), 'F d, Y');
    }
}
