<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $user = User::find($id)->profile()->create($data);


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


        return view('components.admin.dashboard', compact(['employee']));
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
        return view('components.admin.dashboard', compact(['employee', 'positions']));
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
              'birth_date' =>isEmpty($request->birth_date) ? $user->profile->birth_date : $request->lbirth_date,
              'marital_status' => isEmpty($request->marital_status) ? $user->profile->marital_status : $request->marital_status,
              'religion' => isEmpty($request->religion) ? $user->profile->religion : $request->religion,
              'citizenship' => isEmpty($request->citizenship) ? $user->profile->citizenship : $request->citizenship,
              'address' => isEmpty($request->address) ? $user->profile->address : $request->address,
              'phil_health' => isEmpty($request->phil_health) ? $user->profile->phil_health : $request->phil_health,
              'pag_ibig' => isEmpty($request->pag_ibig) ? $user->profile->pag_ibig : $request->pag_ibig,
              'tin_no' => isEmpty($request->tin_no) ? $user->profile->tin_no : $request->tin_no,
              'cell_no' => isEmpty($request->cell_no) ? $user->profile->cell_no : $request->cell_no,
          ]);


          
          $setposition = Position::where('name', $request->position)->first();
           $user->update([
               'position_id' => $setposition->id
           ]);
 

        $user->update([
            'name' => $request->input('name') !== null ? $request->input('name') : $user->name,
            'email' => $request->input('email') !== null ? $request->input('email') : $user->email
        ]);


        return redirect()->back()->with(['message' => 'Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('admin.employee.index')->with(['message' => 'Successfully Deleted']);

    }

    public function addprofile($id)
    {


        $employee = User::find($id);

        return view('components.admin.employee.create', compact(['employee']));
    }

    public function archive () {


        $employees = User::onlyTrashed()->get();


        return view('components.admin.employee.arhive', compact(['employees']));

    }
}
