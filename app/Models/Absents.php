<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absents extends Model
{
    use HasFactory;


    protected $fillable = [
        'reason',
        'attendance_id'
    ];


    public function attendances() {

        return $this->belongsToMany(Attendance::class);

    }

}
