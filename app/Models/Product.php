<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'product_code', 
        'description',
        'quantity',
        'user_id',
        'category_id',
        'supplier_id',
        'status',
        'log_date'
    ];


    public function supplier () {

        return $this->belongsTo(Supplier::class);

    }

    public function category( ) {


        return $this->belongsTo(Category::class);


    }


    public function user() {

        return $this->belongsTo(User::class);

    }

}
