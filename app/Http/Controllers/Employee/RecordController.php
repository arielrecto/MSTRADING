<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
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

            return view('dashboard', compact(['user', 'notif']));
        }

        $notif = $user->payroll->where('is_approved', '=', 'true')->latest()->first();

        return view('dashboard', compact(['user', 'notif']));
    }


    public function create(Request $request)
    {


        $data = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'birth_date' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'citizenship' => 'required',
            'social_num' => 'string',
            'address' => 'required',
            'phil_health' => 'string',
            'pag_ibig' => 'string',
            'tin_no' => 'string',
            'cell_no' => 'string',
            'gender' => 'required'
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


        $user = Auth::user()->profile()->create($data);


        return redirect()->route('dashboard.index')->with(['message' => 'Profile Successfully Created']);
    }

    public function attendance(Request $request)
    {

        $user = Auth::user();

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

        $payroll = auth::user()->payroll->latest()->first();

        $payroll->update([
            'is_viewed' => true,
            'date_viewed' => Carbon::now()->setTimezone('Asia/Manila')->toDateString()
        ]);
        return view('components.employee.salary.show', compact(['payroll']));
    }
}
