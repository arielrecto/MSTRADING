<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function show()
    {


        $positions = Position::all();
        $employees = User::where('is_admin', false)->paginate(5);



        return view('components.admin.salary.show', compact(['employees', 'positions']));
    }
    public function showSalary()
    {
        $employees = Payroll::with('user')->where('is_approved', false)->paginate(5);


        $allSalaries = DB::table('payrolls')->get()->sum('total');

        $positions = Position::all();



        return view('components.admin.salary.show', compact(['employees', 'allSalaries', 'positions']));
    }
    public function store(Request $request, $id)
    {


        $employee = User::find($id)->salary()->create([
            'rate' => $request->rate,
            'per_hour' => $request->rate / 8,
        ]);


        return redirect()->back()->with(['message' => `Salary Successfully Add to {$employee->name}`]);
    }
}
