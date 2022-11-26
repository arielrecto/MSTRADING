<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {


        $suppliers = Supplier::all();




        return view('components.admin.supplier.index', compact(['suppliers']));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'first_name'=>'required',
            'last_name' => 'required',
            'contact' => 'required',
            'position' => 'required'
        ]);

        $_suppliers = Supplier::create([
            'name' => $request->name,
            'address' => $request->address, 
            'contact' => $request->cell_prefix . $request->contact,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => $request->position
        ]);




        return redirect()->route('admin.supplier.index')->with(['message' => 'Supplier Successfully Created']);
    }
    public function create()
    {

        return view('components.admin.supplier.create');
    }
    public function edit($id)
    {

        $supplier = Supplier::find($id);



        return view('components.admin.supplier.edit', compact(['supplier']));
    }

    public function update(Request $request, $id)
    {




        $supplier = Supplier::find($id);


        $supplier->update([
            'name' => $request->name === null ? $supplier->name : $request->name,
            'address' => $request->adress === null ? $supplier->address : $request->address,
            'contact' => $request->contact === null ? $supplier->contact : $request->contact
        ]);


        return redirect()->back()->with(['message' => 'Supplier Data Updated Successfully']);
    }
    public function show ($id) {

        $supplier = Supplier::find($id);

        return view('components.admin.supplier.show', compact(['supplier']));

    }
}
