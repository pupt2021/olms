<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialCopy extends Model
{
    protected $table = 'materials_copies';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    protected $appends = ['digit_in_accession_number', 'formatted_date_recieved'];

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
