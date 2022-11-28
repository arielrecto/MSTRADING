<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'range',
        'user_id',
    ];



    public function user() {


        $this->belongsToMany(User::class);

    }

    public function payroll(){

        $this->belongsTo(Payroll::class);

    }

}
