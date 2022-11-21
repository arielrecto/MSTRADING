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
}
