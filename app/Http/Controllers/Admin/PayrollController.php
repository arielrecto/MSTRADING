<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DeductionSalary;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {

        $payrolls = Payroll::where('is_approved', '=', 'true')->paginate(5);
        
        return view('components.admin.payroll.index', compact(['payrolls']));
    }
    public function store($id)
    {

        $user = User::find($id);


        //list ng oras na pumasok sya 
        $workDays = Attendance::where('user_id', '=', $user->id)->where('is_approved', '=', 'true')->get();

        //compute total of work hour
        $sumWorkHours = 0;
        foreach ($workDays as $workday) {
            $sumWorkHours = $sumWorkHours + $workday['day_hours'];
        }

        //calculate total over time of employee in thier attendance
        $overTime = 0;
        foreach ($workDays as $workday) {
            $overTime = $overTime + $workday['over_time'];
        }

        $salaryRate = $user->position->salary_rate;

        $hourWork = $user->position->hours_work;

        //rate per hour
        $ratePerHour = $salaryRate / $hourWork;

        //compute overtime salary
        $overSalary = $overTime * $ratePerHour;

        $totalDeduct = 0;        
        foreach($user->deductionSalary()->get()as $deduction) {


            $totalDeduct = $totalDeduct + $deduction['amount'];

        }

        $totalSalary = 0;
        if($user->deductionSalary()->count() === 0) {

            $totalSalary = ($sumWorkHours / $hourWork) * $salaryRate;

        } else {

            $totalSalary = (($sumWorkHours / $hourWork) * $salaryRate) - $totalDeduct;

        }
       

        if ($user->payroll()->latest()->first() === null) {

            $user->payroll()->create([
                'total_days' => $workDays->count(),
                'salary_rate' => $salaryRate,
                'hours_work' => $sumWorkHours,
                'position' => $user->position->name,
                'overtime_hours' => $overTime,
                'overtime_salary' => $overSalary, 
                'total' => $totalSalary,
                'log_date' => Carbon::now()->setTimezone('Asia/Manila')->toDateString()
            ]);
        } else {

            //chek if already payroll is generated

            if ($user->payroll->log_date === Carbon::now()->setTimezone('Asia/Manila')->toDateString()) {
                $message = 'Payroll for Today ' . Carbon::now()->setTimezone('Asia/Manila')->toDateString() . " " . Carbon::now()->setTimezone('Asia/Manila')->toTimeString() . ' Already Generated for ' . $user->name;

                return redirect()->back()->with(['message' => $message]);
            } else {

                if ($user->deductionSalary->count() === 0) {

                    dump('with deduction');
                } else {

                    $user->payroll()->create([
                        'total_days' => $workDays->count(),
                        'hours_work' => $sumWorkHours,
                        'salary_rate' => $salaryRate,
                        'position' => $user->position->name,
                        'total' => $totalSalary,
                        'log_date' => Carbon::now()->setTimezone('Asia/Manila')->toDateString()
                    ]);
                };
            }
        }

     return redirect()->back()->with(['message' => 'Salary is payroll is Created!']);

    }
    public function update(Request $request, $id)
    {


        $user = User::find($id);

        $user->payroll()->update([
            'is_approved' => $request->approved,
        ]);

        return redirect()->back()->with(['message' => 'Payroll is Approved']);
    }

    public function show($id)
    {

        $payroll = User::find($id)->payroll()->latest()->first();


        return view('components.admin.payroll.show', compact(['payroll']));
    }

    public function withOverTime(Request $request, $id)
    {

        $user = User::find($id);

        $workDays = Attendance::where('user_id', '=', $user->id)->where('is_approved', '=', 'true')->get();

       $totalHours =  $user->payroll->hours_work;

    
        
       $overTime = 0;
        foreach ($workDays as $workday) {
            $overTime = $overTime + $workday['over_time'];
        }
        $ratePerHour = $user->position->salary_rate / $user->position->hours_work;



        $overTimeSalary = $overTime * $ratePerHour;

        
        $totalSalary = $user->payroll->total;   

        $overTimeSalary = ($totalHours / $user->position->hours_work);

       
         if ($request->overtime) {

               $user->payroll()->update([
                     'overtime_hours' => $overTime,
                     'overtime_salary'=> $overTimeSalary, 
                   'total' => $totalSalary + $overTimeSalary,
           ]);

               return redirect()->back()->with(['message' => 'With Overtime!']);
      }
    }
    public function isApprove(Request $request, $id){

        $payroll = Payroll::find($id);
    
    if($request->isApproved) {
        $payroll->update([
            'is_approved' => $request->isApproved
        ]);
    } else

        return redirect()->route('admin.payroll.index')->with(['message' => 'Payroll Arroved']);
    }
    public function editPayroll($id){

        $payroll = Payroll::find($id);

        $deductions = DeductionSalary::all();
        
        $deductionAmounts = $payroll->user->deductionSalary()->get();

        $totalDeduct = 0;
        foreach($deductionAmounts as $totalDeduction){


            $totalDeduct = $totalDeduct + $totalDeduction['amount'];

        }

      return view('components.admin.payroll.edit', compact(['payroll', 'deductions', 'totalDeduct']));

    }
    public function updatePayroll($id){

        $payroll = Payroll::find($id);

        $totalDeductions = $payroll->user->deductionSalary()->get();

        $deductionTotal = 0; 
        foreach ($totalDeductions as $deduction) {

            $deductionTotal = $deductionTotal + $deduction['amount'];

        }

        $payroll->update([
            'total' => $payroll->total - $deductionTotal
        ]);

    
    return redirect()->back()->with(['message' => 'Updated Successs']);

    }
}
