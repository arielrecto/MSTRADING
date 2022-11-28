<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DeductionSalary;
use App\Models\DoublePay;
use App\Models\Image;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function index()
    {




        $user = Auth::user();

        if ($user->payroll()->count() === 0) {


            $notif = false;
            $deductions = DeductionSalary::get();

            return view('dashboard', compact(['user', 'notif', 'deductions']));
        }

        $notif = $user->payroll->where('is_approved', '=', 'true')->latest()->first();

        return view('dashboard', compact('user', 'notif'));
    }


    public function create(Request $request)
    {




        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'birth_date' => 'required',
            'marital_status' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
            'cell_no' => 'required',
            'gender' => 'required',
            'contact_last_name' => 'required',
            'contact_first_name' => 'required',
            'contact_cell_no' => 'required'
        ]);



        if ($request->file('image_dir')) {
            $file = $request->file('image_dir');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);

            $image = Auth::user()->image()->create([
                'image_dir' => $filename,
                'user_id' => Auth::user()->id
            ]);
        }

        $user = Auth::user()->profile()->create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name === null ? 'N/A' : $request->middle_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion_other === null ? $request->religion : $request->religion_other,
            'citizenship' => $request->citizenship_other === null ? $request->citizenship : $request->citizenship_other,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'phil_health' => $request->phil_health === null ? 'N\A' : $request->phil_health,
            'pag_ibig' => $request->pag_ibig === null ? 'N\A' : $request->pag_ibig,
            'social_num' => $request->social_num === null ? 'N\A' : $request->social_num,
            'tin_no' => $request->tin_no === null ? 'N\A' : $request->time_no,
            'cell_no' =>  $request->cell_prefix . $request->cell_no,
            'telephone' => $request->telephone === null ? 'N\A' : $request->telephone,
            'contact_first_name' => $request->contact_first_name,
            'contact_last_name' => $request->contact_last_name,
            'contact_middle_name' => $request->contact_middle_name === null ? ' ' : $request->contact_middle_name,
            'contact_cell_no' => $request->cell_prefix . $request->contact_cell_no
        ]);



        if ($request->phil_health !== null) {

            $deduction = DeductionSalary::all();
            if ($deduction->count() !== 0 &  $deduction->where('name', '=', 'Phil Health')->first()->count() !== 0) {
                $deductionSalary = DeductionSalary::where('name', '=', 'Phil Health')->first();
                Auth::user()->deductionSalary()->attach($deductionSalary->id);
            }
        }

        if ($request->pag_ibig !== null) {

            $deduction = DeductionSalary::all();

            if ($deduction !== null  &  $deduction->where('name', '=', 'Pag Ibig')->first()->count() !== 0) {
                $deductionSalary = DeductionSalary::where('name', '=', 'Pag Ibig')->first();
                Auth::user()->deductionSalary()->attach($deductionSalary->id);
            }
        }


        if ($request->social_num !== null) {

            $deduction = DeductionSalary::all();

            if ($deduction !== null &  $deduction->where('name', '=', 'SSS')->first()->count() !== 0) {
                $deductionSalary = DeductionSalary::where('name', '=', 'SSS')->first();
                Auth::user()->deductionSalary()->attach($deductionSalary->id);
            }
        }


        return redirect()->route('dashboard.index')->with(['message' => 'Profile Successfully Created']);
    }

    public function attendance(Request $request)
    {

        $user = Auth::user();


        if ($user->position()->count() === 0) {

            return back()->with(['message' => 'Ask Admin for Position']);
        }

        if ($user->attendances()->latest()->count() === 0) {


            //test purpose

            /*
            lagay mo itong script na to sa time in 
            
            Carbon::now()->setTimezone('Asia/Manila')->toTimeString()
        
            */

            $set_time_in = '8:00:00';
            $user->attendances()->create([
                'time_in' =>  $set_time_in,
                'log_date' => Carbon::now()->setTimezone('Asia/Manila')->toDateString()
            ]);

            return redirect()->back()->with(['message' => 'Time in Sucess']);
        } else {


            if ($user->attendances()->latest()->first()->log_date === Carbon::now()->setTimezone('Asia/Manila')->toDateString()) {

                if ($user->attendances()->latest()->first()->time_out === null) {


                    //lagyan ng dalawang back slash ang user_time_out taz copy mo yung nasa taas kanina na carbon taz lagay mo
                    $user_time_out = '19:00:00';
                    $user->attendances()->latest()->first()->update([
                        'time_out' =>  $user_time_out // <-- dito
                    ]);

                    $user_time_in = $user->attendances()->latest()->first()->time_in;
                    $time_in = explode(':', $user_time_in);
                    if (count($time_in) == 3) {
                        $decTimeforTimeIn = ($time_in[0] * 60) + ($time_in[1]) + ($time_in[2] / 60);
                    } else if (count($time_in) == 2) {
                        $decTimeforTimeIn = ($time_in[0]) + ($time_in[1] / 60);
                    } else if (count($time_in) == 2) {
                        $decTimeforTimeIn = $time_in;
                    }


                    //$user_time_out = $user->attendances()->latest()->first()->time_out;


                    $time_out = explode(':', $user_time_out);
                    if (count($time_out) == 3) {
                        $decTimeforTimeOut = ($time_out[0] * 60) + ($time_out[1]) + ($time_out[2] / 60);
                    } else if (count($time_out) == 2) {
                        $decTimeforTimeOut = ($time_out[0]) + ($time_out[1] / 60);
                    } else if (count($time_out) == 2) {
                        $decTimeforTimeOut = $time_out;
                    }




                    $totalHoursWork = (($decTimeforTimeOut - $decTimeforTimeIn) / 60) - $user->position->break_hours;




                    $overTime = ($totalHoursWork - $user->position->hours_work);


                    $doublePay = DoublePay::where('is_active', '=', '1')->get()->first();



                    if ($doublePay !== null) {
                        if ($doublePay->is_active === '1') {


                            $user->attendances()->latest()->first()->update([
                                'double_pay' => 1
                            ]);
                        }
                    }


                    $user->attendances()->latest()->first()->update([
                        'day_hours' => round($totalHoursWork, 2),
                        'over_time' => $overTime,
                    ]);

                    return redirect()->back()->with(['message' => 'Time Out Sucess']);
                } else {

                    $data = $user->attendances()->latest()->first();

                    return redirect()->back()->with(['message' => "Comback Tomorrow"]);
                }
            } else {
                $user->attendances()->create([
                    'time_in' => Carbon::now()->setTimezone('Asia/Manila')->toTimeString(),
                    'log_date' => Carbon::now()->setTimezone('Asia/Manila')->toDateString()
                ]);
                return redirect()->back()->with(['message' => 'Time in Sucess']);
            }
        };
    }
    public function getItemView()
    {

        $products = Product::where('status', '=', 'arrived')->get();


        return view('components.employee.inventory.index', compact(['products']));
    }


    public function GetItemPop(Request $request, $id)
    {


        $request->validate([
            'quantity' => 'required'
        ]);

        $product = Product::find($id);
        $user = Auth::user();

        $transaction = Transaction::create([
            'name' => $product->name,
            'product_code' => $product->product_code,
            'quantity' => $request->quantity,
            'person_name' => $user->name,
            'log_date' => Carbon::now()->setTimezone('Asia/Manila')->toDateTimeString(),
        ]);

        $product->update([
            'quantity' => $product->quantity - $request->quantity
        ]);

        $stock = Stock::where('category', '=', $product->category->name)->first();

        $stock->update([
            'total' => $stock->total - $request->quantity
        ]);

        return redirect()->back()->with(['message' => 'Success']);
    }
    public function salaryView()
    {

        $payroll = auth::user()->payroll()->where('is_approved', '=', 'true')->latest()->first();


         if ($payroll->count() === 0) {

             return back()->with(['message' => 'No Payroll yet!']);
         }

         $payroll->latest()->first()->update([
             'is_viewed' => true,
             'date_viewed' => Carbon::now()->setTimezone('Asia/Manila')->toDateString()
         ]);
         return view('components.employee.salary.show', compact(['payroll']));
    }
}
