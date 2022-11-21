<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {

        $attendances = Attendance::with('user')->where('is_approved', false)->get();


        return view('components.admin.attendance.index', compact(['attendances']));
    }

    public function approvedAttendance(Request $request, $id)
    {

        $attendance = Attendance::find($id);

        $attendance->update([
            'is_approved' => $request->approve,
        ]);

        return redirect()->back()->with(['message' => 'Attendance Aproved']);
    }
}
