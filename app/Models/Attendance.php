<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
    'time_in',
    'time_out',
    'log_date',
    'user_id',
    'is_approved',
    'day_hours',
    'over_time',
    'double_pay'
    ];

    public function user() {


        return $this->belongsTo(User::class);


    }

    public function absent() {

        return $this->hasOne(Absents::class);

    }

    public function payroll() {

        return $this->hasOne(Payroll::class);

    }

    public function doublePay(){

        return $this->hasOne(DoublePay::class);

    }
    function time_to_decimal($time) {
        $timeArr = explode(':', $time);
        if (count($timeArr) == 3) {
          $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
        } else if (count($timeArr) == 2) {
          $decTime = ($timeArr[0]) + ($timeArr[1]/60);
        } else if (count($timeArr) == 2) {
          $decTime = $time;
        }
        return $decTime;
      }
      
}
