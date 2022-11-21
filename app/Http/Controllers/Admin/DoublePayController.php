<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoublePay;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DoublePayController extends Controller
{
    public function store(Request $request) {


   $double = DoublePay::create(
    [
        'name' => $request->name,
        'rate' => $request->rate,
        'type' => $request->type,
        'date_start' => $request->date_start,
        'date_end' => $request->date_end,
        'is_active' => true
    ]);


    $message = 'Double Pay is Active until ' . Carbon::parse($request->date_end)->format('F d Y');



        return redirect()->back()->with(['message' => $message]);

    }


    public function index () {

        $doublePays = DoublePay::all();

        return view('components.admin.doublepay.index', compact(['doublePays']));

    }
}
