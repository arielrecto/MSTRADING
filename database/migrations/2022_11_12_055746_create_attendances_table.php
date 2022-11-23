<?php

use App\Models\DoublePay;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('time_in');
            $table->string('time_out')->nullable();
            $table->date('log_date');
            $table->foreignIdFor(User::class);
            $table->string('double_pay')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->string('day_hours')->nullable();
            $table->string('over_time')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
