<?php

use App\Models\DeductionSalary;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('total_days');
            $table->string('salary_rate');
            $table->string('position');
            $table->string('double_pay')->nullable();
            $table->date('log_date');
            $table->string('hours_work');
            $table->string('overtime_hours')->nullable();
            $table->string('overtime_salary')->nullable();
            $table->string('deduction_name')->nullable();
            $table->string('deduction_amount')->nullable();
            $table->foreignIdFor(User::class);
            $table->string('total');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_viewed')->default(false);
            $table->date('date_viewed')->nullable();
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
        Schema::dropIfExists('payrolls');
    }
}
