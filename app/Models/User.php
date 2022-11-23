<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
            'name',
            'email',
            'password',
            'is_admin',
            'position_id',
            'on_leave'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function admin(){

        return $this->hasOne(Admin::class);

    }

    public function position () {

        return $this->belongsTo(Position::class);

    }

    public function profile() {

        return $this->hasOne(Profile::class);

    }

    public function attendances () {

        return $this->hasMany(Attendance::class);

    }


    public function salary() {

        return $this->hasOne(Salary::class);

    }

    public function products() {
        
        return $this->hasMany(Product::class);

    }
    
    public function payroll() {

        return $this->hasOne(Payroll::class);

    }

    public function deductionSalary() {

        return $this->belongsToMany(DeductionSalary::class);

    }

    public function image() {

        return $this->hasOne(Image::class);

    }
    public function absences() {

        return $this->hasMany(Absents::class);

    }
}
