<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable =[
        'total', 
        'salary_id',
        'attendance_id'
    ];


    public function salary() {

        return $this->belongsTo(Salary::class);

    }

    public function attendances () {

        return $this->belongsToMany(Attendance::class);

    }
}
