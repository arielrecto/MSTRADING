<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $requests = Absents::where('is_approve', '=' , false)->latest()->get();
        return view('components.admin.leave.index', compact(['requests']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.employee.absent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        Absents::create([
            'reason' => $request->reason,
            'user_id' => $user->id,
            'log_date' => now()->setTimezone('Asia/Manila')->toDateString()
        ]);


        return redirect()->route('dashboard.index')->with(['message' => 'Wait for Approval of your request']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approve(Request $request, $id){

        $absent = Absents::find($id);


        $absent->update([
            'is_approve' => $request->approve
        ]);

        $absent->user->update([
            'on_leave' => true
        ]);
        return back()->with(['message' => 'Approved']);
    }
    public function usersOnLeave(){

        $users = User::where('on_leave', '=', '1')->get();


        return view('components.admin.leave.userOnLeave', compact(['users']));

    }
    public function userActive(Request $request, $id){

        $user = User::find($id);



        $user->update([
            'on_leave' => $request->active
        ]);


        return back()->with(['message' => 'User is Active']);
    }
}
