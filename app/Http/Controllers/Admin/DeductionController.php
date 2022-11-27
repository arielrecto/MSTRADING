<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DeductionSalary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    public function index()
    {

        $deductions = DeductionSalary::all();

        return view('components.admin.deduction.index', compact(['deductions']));

    }

    public function store(Request $request)
    {


        $deductions = DeductionSalary::create([
            'name' => $request->name,
            'amount' => $request->amount
        ]);



        return redirect()->back()->with(['message' => 'Added Successfully']);
    }


    public function setDeduction(Request $request, $id){  

        $user = User::find($id);

         $deduction = DeductionSalary::where('name', '=' , $request->deduction)->first();

         $user->deductionSalary()->attach($deduction->id);



         return redirect()->back()->with(['messsage' => 'added Sucesss']);

    }

    public function destroy ($id){


        $deduction = DeductionSalary::find($id);


        $deduction->delete();


    return redirect()->back()->with(['message' => 'Successfully Deleted']);        

    }

}
