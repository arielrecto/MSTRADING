<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;



class PDFController extends Controller
{
    public function show($id){


             $employeeData = User::find($id);
            
             dump($employeeData);


             $data = [
                'name' => 'ariel Recto',
                'position' => 'deliver',
                'salary_rate' => '800', 
                'attendance' => '7',
                'total_salary' => '70000000'
             ];
        

         return view('myPDF', compact(['data']));

    }

    public function generate()
    {

        $data = [
            'name' => 'ariel Recto',
            'position' => 'deliver',
            'salary_rate' => '800', 
            'attendance' => '7',
            'total_salary' => '70000000'
         ];

        $pdf = PDF::loadView('myPDF', compact(['data']));



        return $pdf->download('sample.pdf');
    }
}
