<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $guarded = [];
    public $timestamps = false;
    protected $appends = ['full_name_with_student_number', 'full_name'];

    /**
     * Format the full name with student number of the user
     * @return string
     */
    public function getFullNameWithStudentNumberAttribute()
    {
        $name = "{$this->lastname}, {$this->firstname}";

        if (! $this->middlename === NULL)
            $name .= " {$this->middle_name}";
        
        $name .= " ({$this->stud_number})";

        return $name;
    }

    /**
     * Format the full name of the user
     * @return string
     */
    public function getFullNameAttribute()
    {
        $name = "{$this->lastname}, {$this->firstname}";

        if (! $this->middlename === NULL)
            $name .= " {$this->middle_name}";

        return $name;
    }
}
