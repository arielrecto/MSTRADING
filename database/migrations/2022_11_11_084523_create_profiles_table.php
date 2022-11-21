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
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('age');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('religion');
            $table->string('citizenship');
            $table->string('address');
            $table->string('phil_health')->nullable();
            $table->string('pag_ibig')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('cell_no')->nullable();
            $table->date('birth_date');
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
