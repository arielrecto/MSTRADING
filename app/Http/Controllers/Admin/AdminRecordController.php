<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Position;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRecordController extends Controller
{

   
    public function index() {

    $attendances = Attendance::where('is_approved', false)->count();

    $stocks = Stock::all();
    $employees = User::where('is_admin', '=', false)->paginate(5);
    $positions = Position::all();

        return view('components.admin.dashboard', compact(['attendances', 'stocks', 'positions', 'employees']));

    }
}
