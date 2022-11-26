<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'reason',
        'absents_id'
    ];



    public function absent() {

       return  $this->belongsTo(Absents::class);
    }

}
