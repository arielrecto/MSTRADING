<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
    'date_time',
    'user_id'
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
}
