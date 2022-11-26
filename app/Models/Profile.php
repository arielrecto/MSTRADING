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
        'city',
        'state',
        'zipcode',
        'phil_health',
        'pag_ibig',
        'tin_no',
        'cell_no',
        'telephone',
        'contact_first_name',
        'contact_middle_name',
        'contact_last_name',
        'contact_cell_no',
        'employee_type',
        'status'
    ];


    public function user () {

        return $this->belongsTo(User::class);

    }

}
