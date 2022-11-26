<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'first_name',
        'last_name',
        'position'
    ];



    public function products() {

        return $this->hasMany(Product::class);

    }

}
