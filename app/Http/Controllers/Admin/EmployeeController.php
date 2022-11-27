<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeductionSalary;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::paginate(12);


        return view('components.admin.dashboard', compact(['employees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $user = User::find($id);
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'birth_date' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'citizenship' => 'required',
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

            $image = $user->image()->create([
                'image_dir' => $filename,
                'user_id' => $user->id
            ]);
        }


        $user->profile()->create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name === null ? 'N/A' : $request->middle_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'citizenship' => $request->citizenship,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'phil_health' => $request->phil_health === null ? 'N\A' : $request->phil_health,
            'pag_ibig' => $request->pag_ibig === null ? 'N\A' : $request->pag_ibig,
            'tin_no' => $request->tin_no === null ? 'N\A' : $request->time_no,
            'cell_no' =>  $request->cell_prefix . $request->cell_no,
            'telephone' => $request->telephone === null ? 'N\A' : $request->telephone,
            'contact_first_name' => $request->contact_first_name,
            'contact_last_name' => $request->contact_last_name,
            'contact_middle_name' => $request->contact_middle_name === null ? ' ' : $request->contact_middle_name,
            'contact_cell_no' => $request->cell_prefix . $request->contact_cell_no
        ]);


        return redirect()->route('admin.employee.index')->with(['message' => 'Profile Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::find($id);

        $deductions = DeductionSalary::get();
        return view('components.admin.dashboard', compact(['employee', 'deductions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::find($id);
        $positions = Position::all();
        $deductions = DeductionSalary::all();
        return view('components.admin.dashboard', compact(['employee', 'positions', 'deductions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->profile()->update([
            'first_name' => isEmpty($request->first_name) ? $user->profile->first_name : $request->first_name,
            'middle_name' => isEmpty($request->middle_name) ? $user->profile->middle_name : $request->middle_name,
            'last_name' => isEmpty($request->last_name) ? $user->profile->last_name : $request->last_name,
            'age' => isEmpty($request->age) ? $user->profile->age : $request->age,
            'birth_date' => isEmpty($request->birth_date) ? $user->profile->birth_date : $request->lbirth_date,
            'marital_status' => isEmpty($request->marital_status) ? $user->profile->marital_status : $request->marital_status,
            'religion' => isEmpty($request->religion) ? $user->profile->religion : $request->religion,
            'citizenship' => isEmpty($request->citizenship) ? $user->profile->citizenship : $request->citizenship,
            'address' => isEmpty($request->address) ? $user->profile->address : $request->address,
            'city' => isEmpty($request->city) ? $user->profile->city : $request->city,
            'state' => isEmpty($request->state) ? $user->profile->state : $request->state,
            'zipcode' => isEmpty($request->zipcode) ? $user->profile->address : $request->zipcode,
            'phil_health' => isEmpty($request->phil_health) ? $user->profile->phil_health : $request->phil_health,
            'pag_ibig' => isEmpty($request->pag_ibig) ? $user->profile->pag_ibig : $request->pag_ibig,
            'tin_no' => isEmpty($request->tin_no) ? $user->profile->tin_no : $request->tin_no,
            'cell_no' => isEmpty($request->cell_no) ? $user->profile->cell_no : $request->cell_prefix . $request->cell_no,
            'contact_first_name' => isEmpty($request->contact_first_name) ? $user->profile->contact_first_name : $request->contact_first_name,
            'contact_last_name' => isEmpty($request->contact_last_name) ? $user->profile->contact_last_name : $request->contact_last_name,
            'contact_middle_name' => isEmpty($request->contact_middle_name) ? $user->profile->contact_middle_name : $request->contact_middle_name,
            'contact_cell_no' => isEmpty($request->contact_cell_no) ? $user->profile->contact_cell_no : $request->contact_cell_no,
            'employee_type' => $request->employee_type
        ]);

        $user->update([
            'name' => $request->input('name') !== null ? $request->input('name') : $user->name,
            'email' => $request->input('email') !== null ? $request->input('email') : $user->email
        ]);

        $position = Position::where('name', '=', $request->position)->get()->first();

        $user->update([
             'position_id' => $position->id
         ]);

         return redirect()->back()->with(['message' => 'Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {


        $user = User::find($id);


         $user->update([
         'reason' => $request->reason_select === null ? $request->reason : $request->reason_select,
         ]);

    

         $user->delete();

         return redirect()->route('admin.employee.index')->with(['message' => 'Successfully Deleted']);
    }

    public function addprofile($id)
    {


        $employee = User::find($id);

        return view('components.admin.employee.create', compact(['employee']));
    }

    public function archive()
    {


        $employees = User::onlyTrashed()->get();


        return view('components.admin.employee.arhive', compact(['employees']));
    }
    public function regular(Request $request, $id)
    {


        $employee = User::find($id);

        $employee->profile()->update([
            'status' => $request->regular
        ]);

        return back()->with(['message' => 'Promote as Regular Employee']);
    }
}
