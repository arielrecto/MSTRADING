<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    
    public function create(Request $request) {

       $data = $request->validate([
            'name' => 'string',
            'salary_rate' => 'integer',
            'hours_work' => 'integer',
            'break_hours' => 'integer'
        ]);


        Position::create($data);
       
        return redirect()->back()->with(['message' => 'Position Successfully Added']);
    }


    public function show () {

        $positions = Position::all();

        return view('components.admin.position.show', compact(['positions']));
    }

    public function set (Request $request ,$id){ 
        
        $position = Position::where('name', $request->position)->first();

       
         $setPosition = User::find($id);
         $setPosition->update([
             'position_id' => $position['id']
         ]);


        return redirect()->route('admin.salary.show')->with(['message' => 'Possition is Successfully Added']);

    }
    public function update(Request $request, $id){

        $position = Position::find($id);


        $position->update([
            'name' => $request->name === null ? $position->name : $request->name,
            'hours_work' => $request->hours_work === null ? $position->hours_work : $request->hours_work,
            'break_hours' => $request->break_hours === null ? $position->break_hours : $request->break_hours,
            'salary_rate' => $request->salary_rate === null ? $position->salary_rate : $request->salary_rate
        ]);

        return back()->with(['message' => 'Position Updated Successfully']);

    }
    public function destroy ($id){


        $position = Position::find($id);


        $position->delete();


        return back()->with(['message' => 'Position Deleted Success']);

    }
    public function edit($id){


        $position = Position::find($id);



        return view('components.admin.position.edit', compact('position'));

    }
}
