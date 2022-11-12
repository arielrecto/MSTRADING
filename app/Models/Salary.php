<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;


    protected $fillable = [
        'rate',
        'user_id'
    ];


    public function user() {

        return $this->belongsTo(User::class);

    }

    public function payroll () {

        return $this->hasOne(Payroll::class);

    }
}