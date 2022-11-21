<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoublePay extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'rate',
        'type',
        'date_start',
        'date_end',
        'is_active'
    ];



    public function attendance(){

        return $this->belongsTo(Attendance::class);
        
    }
}
