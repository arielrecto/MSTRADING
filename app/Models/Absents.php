<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absents extends Model
{
    use HasFactory;


    protected $fillable = [
        'reason',
        'user_id',
        'log_date',
        'is_approve'
    ];


    public function attendances() {

        return $this->belongsToMany(Attendance::class);

    }

    public function user(){

        return $this->belongsTo(User::class);

    }

}
