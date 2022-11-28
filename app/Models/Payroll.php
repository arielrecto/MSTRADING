<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable =[
        'total_days',
        'salary_rate',
        'position',
        'double_pay',
        'user_id',
        'hours_work',
        'overtime_hours',
        'overtime_salary',
        'hours_work',          
        'total',
        'tax',
        'log_date', 
        'is_approved',
        'is_viewed',
        'at_viewed'
    ];


    public function user() {

        return $this->belongsTo(User::class);

    }
    public function deductions (){

        $this->hasMany(DeductionSalary::class);

    }
}
