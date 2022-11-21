<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'birth_date',
        'marital_status',
        'religion',
        'citizenship',
        'address',
        'phil_health',
        'pag_ibig',
        'tin_no',
        'cell_no'
    ];


    public function user () {

        return $this->belongsTo(User::class);

    }

}
