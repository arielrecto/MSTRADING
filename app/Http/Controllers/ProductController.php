<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', '=', 'inactive')->get();
        return view('components.admin.product.index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('components.admin.product.create', compact(['categories', 'suppliers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        dump($request->all());

        $supplier = Supplier::where('name', '=', $request->supplier)->first();
        $category = Category::where('name', '=' , $request->category)->first();

        
        dump($supplier->id);

        dump($category);
 
       
         $product = Auth::user()->products()->create([
              'name' => $request->product_name,
              'description' => $request->description,
             'quantity' => $request->quantity,
              'category_id' => $category->id,
              'supplier_id' => $supplier->id,
              'log_date' => Carbon::now()->setTimezone('Asia/Manila')->toDateString()
          ]);

          $product->update([
            'product_code' => $category->category_code . $product->id
          ]);
         return redirect()->route('admin.product.index')->with(['message' => 'Successfully Ordered Product']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::find($id);

        return view('components.admin.product.edit', compact(['product']));
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
        $product = Product::find($id);


        $category  = $product->category()->update([
            'name' => $request->category === null ? $product->category->name : $request->category,
        ]);

        $product = Product::find($id)->update([
            'name' => $request->product_name === null ? $product->name : $request->product_name,
            'description' => $request->description  === null ? $product->description : $request->description,
            'quantity' => $request->quantity === null ? $product->quantity : $request->quantity
        ]);

        $supplier = Product::find($id)->supplier;

        $supplier->update([
            'name' => $request->company_name === null ? $supplier->name : $request->company_name,
            'address' => $request->address === null ? $supplier->address : $request->address,
            'contact' => $request->contact === null ? $supplier->contact : $request->contact
        ]);



        return redirect()->back()->with(['message' => 'Data Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);


        $product->delete();


        return redirect()->route('admin.product.index')->with(['message' => 'Successfully Deleted']);
    }
    public function archive()
    {

        $products =  Product::onlyTrashed()->get();


        return view('components.admin.product.archive', compact(['products']));
    }
    public function status (Request $request, $id) {

    
        $product = Product::find($id);


        $product->update([
             'status' => $request->status,
         ]);

        $stock = Stock::get();
        if($stock->count() === 0 ) {

            Stock::create([
                'category' => $product->category->name,
                'total' => $product->quantity
            ]);
        
        } else {

            $addStock = Stock::where('category', '=', $product->category->name)->get();

            if($addStock->count() === 1) {
            


                $category = $addStock->first();

                $category->update([
                    'total' => $category->total + $product->quantity
                ]);


                

            } else {


             Stock::create([
                'category' => $product->category->name,
                 'total' => $product->quantity
             ]);

            }

        }

    return redirect()->back()->with('status is updated');

    }
    public function recieved () {

        $products = Product::where('status' , '=', 'arrived')->get();



        return view('components.admin.product.status.recieve', compact(['products']));

    }
    public function stock(){

        $stocks = Stock::all();

        return view('components.admin.stock.index', compact(['stocks']));

    }
    public function popProduct () {

        $products = Product::where('status' , '=', 'arrived')->get();


        return view('components.admin.product.getProduct.index', compact(['products']));

    }
    public function popProductStore (Request $request, $id){


        $request->validate([
            'quantity' => 'required'
        ]);

        $product = Product::find($id);
        $user = Auth::user();

         $transaction = Transaction::create([
             'name' => $product->name,
             'product_code' => $product->product_code,
             'quantity' => $request->quantity,
             'person_name' => $user->name,
             'log_date' => Carbon::now()->setTimezone('Asia/Manila')->toDateTimeString(),
         ]);

         $product->update([
             'quantity' => $product->quantity - $request->quantity
         ]);

         $stock = Stock::where('category', '=' , $product->category->name)->first();

         $stock->update([
            'total' => $stock->total - $request->quantity
         ]);
    
     return redirect()->back()->with(['message' => 'Success']);
    }

    public function record () {

        $records = Transaction::latest()->get();



        return view('components.admin.product.record.index', compact(['records']));

    }
}
