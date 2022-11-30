<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {

        $attendances = Attendance::with('user')->where('is_approved', false)->get();


        return view('components.admin.attendance.index', compact(['attendances']));
    }
    public function employeeAttendance (){

        $users = User::where('is_admin', '=','0')->get();

        return view('components.admin.attendance.employee.index', compact('users'));
    }
    public function showUserAttendance($id){

        $user = User::find($id);

        $attendances = $user->attendances()->where('is_approved', '=', 'true')->get();

        return view('components.admin.attendance.employee.show', compact('attendances', 'user'));
    } 

    public function approvedAttendance(Request $request, $id)
    {

        $attendance = Attendance::find($id);

        $attendance->update([
            'is_approved' => $request->approve,
        ]);

        return redirect()->back()->with(['message' => 'Attendance Aproved']);
    }

    public function destroy($id) {

        $attendance = Attendance::find($id);

        $attendance->delete();


        return back()->with(['message' => 'Attendance Deleted Successfully']);

    }
    public function edit($id){


        $attendance = Attendance::find($id);


        return view('components.admin.attendance.employee.edit', compact('attendance'));


    }

    public function update(Request $request, $id){

        $attendance = Attendance::find($id);


        $attendance->update([
            'time_in' => $request->time_in === null ? $attendance->time_in : $request->time_in,
            'time_out' => $request->time_out === null ? $attendance->time_out : $request->time_out,
            'over_time' => $request->over_time === null ? $attendance->over_time : $request->over_time,
            'day_hours' => $request->day_hours === null ? $attendance->day_hours : $request->day_hours
        ]);


        return back()->with(['message' => 'Attendance Updated Successfully']);

    }
}
