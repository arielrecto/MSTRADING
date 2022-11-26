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
        'is_approve',
        'is_denied'
    ];


    public function attendances() {

        return $this->belongsToMany(Attendance::class);

    }

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function adminResponse(){

        return $this->hasOne(AdminResponse::class);

    }

}
