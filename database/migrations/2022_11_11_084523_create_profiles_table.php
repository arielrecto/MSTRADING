<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('age');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('religion');
            $table->string('citizenship');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('social_num');
            $table->string('phil_health')->nullable();
            $table->string('pag_ibig')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('cell_no')->nullable();
            $table->string('telephone')->nullable();
            $table->date('birth_date');
            $table->string('contact_first_name');
            $table->string('contact_last_name');
            $table->string('contact_middle_name');
            $table->string('contact_cell_no');
            $table->string('employee_type')->nullable();
            $table->string('status')->default('New Employee');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
