<?php

use App\Http\Controllers\Admin\AbsentController;
use App\Http\Controllers\Admin\AdminRecordController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeductionController;
use App\Http\Controllers\Admin\DoublePayController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Employee\RecordController;
use App\Http\Controllers\Employee\ResponseController as EmployeeResponseController;
use App\Http\Controllers\ProductController;
use App\Models\Attendance;
use App\Models\DeductionSalary;
use App\Models\DoublePay;
use App\Models\Payroll;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $notif = DoublePay::where('is_active', true)->latest()->first();
    return view('welcome', compact(['notif']));
})->name('home');


Route::middleware(['auth'])->group(function () {




    Route::middleware(['is_admin'])->prefix('admin')->as('admin.')->group(function () {

        Route::prefix('dashboard')->group(function () {

            Route::get('index', [AdminRecordController::class, 'index'])->name('index');

            //admin/salary
            Route::group(
                ['prefix' => 'salary', 'as' => 'salary.'],
                function () {
                    Route::get('/show', [SalaryController::class, 'show'])->name('show');
                    Route::post('/salary/id={id}', [SalaryController::class, 'store'])->name('store');
                    Route::get('/view/salary/id={id}', [SalaryController::class, 'showSalary'])->name('viewSalary');
                }
            );
            //admin/employees
            Route::group(['prefix' => 'employees', 'as' => 'employee.'], function () {
                Route::get('/index', [EmployeeController::class, 'index'])->name('index');
                Route::get('/show/id={id}', [EmployeeController::class, 'show'])->name('show');
                Route::post('/create/id={id}', [EmployeeController::class, 'store'])->name('store');
                Route::get('/addprofile/id={id}', [EmployeeController::class, 'addprofile'])->name('addprofile');
                Route::post('/update/id={id}', [EmployeeController::class, 'update'])->name('update');
                Route::get('/edit/id={id}', [EmployeeController::class, 'edit'])->name('edit');
                Route::post('/delete/id={id}', [EmployeeController::class, 'destroy'])->name('delete');
                Route::get('/employee/archive', [EmployeeController::class, 'archive'])->name('archive');
                Route::post('/regular/id={id}',[EmployeeController::class, 'regular'])->name('regular');
            });

            //admin/product

            Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
                Route::get('/index', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');
                Route::get('/edit/id={id}', [ProductController::class, 'edit'])->name('edit');
                Route::post('/update/id={id}', [ProductController::class, 'update'])->name('update');
                Route::post('/delete/id={id}', [ProductController::class, 'destroy'])->name('delete');
                Route::get('/archive', [ProductController::class, 'archive'])->name('archive');
                Route::post('/status/id={id}',[ProductController::class, 'status'])->name('status');
                Route::get('/arrived', [ProductController::class, 'recieved'])->name('recieved');
                Route::get('/stock', [ProductController::class, 'stock'])->name('stock');
                Route::get('/popProduct', [ProductController::class, 'popProduct'])->name('pop');
                Route::post('/popStoreProduct/id={id}', [ProductController::class, 'popProductStore'])->name('popStore');
                Route::get('/record', [ProductController::class, 'record'])->name('record');
            });

            //position routes
            Route::group(['prefix' => 'position', 'as' => 'position.'], function () {
                Route::get('/show', [PositionController::class, 'show'])->name('show');
                Route::post('/position/create', [PositionController::class, 'create'])->name('create');
                Route::post('/position/id={id}', [PositionController::class, 'set'])->name('setPosition');
            });

            //payroll

            Route::group(['prefix' => 'payroll', 'as' => 'payroll.'], function () {
                Route::post('/create/id={id}', [PayrollController::class, 'store'])->name('store');
                Route::get('/index', [PayrollController::class, 'index'])->name('index');
                Route::post('/approved/id={id}', [PayrollController::class, 'update'])->name('update');
                Route::get('/show/id={id}', [PayrollController::class, 'show'])->name('show');
                Route::post('/overtime/id={id}', [PayrollController::class, 'withOverTime'])->name('overtime');
                Route::post('/approve/id={id}',[PayrollController::class, 'isApprove'])->name('approve');
                Route::get('/edit/id={id}', [PayrollController::class, 'editPayroll'])->name('edit');
                Route::post('/updatePayroll/id={id}', [PayrollController::class, 'updatePayroll'])->name('updatePayroll');
                Route::post('/delete/id={id}', [PayrollController::class, 'destroy'])->name('delete');
            });
            //double pay
            Route::group(['prefix' => 'doublepay', 'as' => 'doublepay.'], function () {
                Route::post('/store', [DoublePayController::class, 'store'])->name('store');
                Route::get('/index', [DoublePayController::class, 'index'])->name('index');
                Route::post('/inactive/id={id}', [DoublePayController::class, 'inactive'])->name('inactive');
                Route::post('/delete/id={id}', [DoublePayController::class, 'destroy'])->name('delete');
            });

            //attendance
            Route::group(['prefix' => 'attendance', 'as' => 'attendance.'], function () {
                Route::get('/index', [AttendanceController::class, 'index'])->name('index');
                Route::post('/approvedAttendance/id={id}', [AttendanceController::class, 'approvedAttendance'])->name('approvedAttendance');
            });

            
            //deduction salary
            Route::group(['prefix' => 'deduction', 'as' => 'deduction.'], function () {
                Route::get('/index', [DeductionController::class, 'index'])->name('index');
                Route::post('/setDeduction/id={id}', [DeductionController::class, 'setDeduction'])->name('setDeduction');
                Route::post('/store', [DeductionController::class, 'store'])->name('store');
                Route::post('/delete/id={id}', [DeductionController::class, 'destroy'])->name('destroy');
                Route::post('/update/payroll/id={id}', [DeductionController::class, 'updatePayroll'])->name('updatePayroll');
            });

            //PDF
            Route::group(['prefix' => 'generatePDF', 'as' => 'generatePDF.'],  function () {
                Route::get('/view/id={id}', [PDFController::class, 'show'])->name('view');
                Route::get('/getPDF', [PDFController::class, 'generate'])->name('generate');
            });


            //supplier routes
            Route::group(['prefix' => 'supplier', 'as' => 'supplier.'], function () {
                Route::get('/index', [SupplierController::class, 'index'])->name('index');
                Route::get('/create', [SupplierController::class, 'create'])->name('create');
                Route::post('/store', [SupplierController::class, 'store'])->name('store');
                Route::get('/edit/id={id}', [SupplierController::class, 'edit'])->name('edit');
                Route::post('/update/id={id}',[SupplierController::class, 'update'])->name('update');
                Route::get('/show/id={id}', [SupplierController::class, 'show'])->name('show');
            });


            //category routes

            Route::group(['prefix' => 'category' , 'as' => 'category.'], function (){
                Route::get('/index', [CategoryController::class, 'index'])->name('index');
                Route::post('/store', [CategoryController::class, 'store'])->name('store');
                Route::get('/create', [CategoryController::class, 'create'])->name('create');
                Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::post('/update', [CategoryController::class, 'update'])->name('update');
                Route::post('delete', [CategoryController::class, 'destroy'])->name('dlelete');
            });

            //absent
            Route::group(['prefix' => 'absent', 'as' => 'absent.'], function () {
                Route::get('/index', [AbsentController::class, 'index'])->name('index');
                Route::post('/is_approve/id={id}', [AbsentController::class, 'approve'])->name('approve');
                Route::get('/users/onleave',[AbsentController::class, 'usersOnLeave'])->name('usersOnLeave');
                Route::post('/user/update/active/id={id}', [AbsentController::class, 'userActive'])->name('userActive');
            });
            //response
            Route::group(['prefix' => 'response', 'as' => 'response.'], function (){
                Route::post('/store/id={id}', [ResponseController::class, 'store'])->name('store');
                Route::get('/create/id={id}', [ResponseController::class, 'create'])->name('create');
            });
            //Tax
            // Route::group(['prefix' => 'tax', 'as' => 'tax.'], function(){
            //     Route::get('/create', [TaxController::class, 'create'])->name('create');
            //     Route::post('/store', [TaxController::class, 'store'])->name('store');
            //     Route::get('/index', [TaxController::class, 'index'])->name('index');
            // });
        });
    });


    //Employee -- Routes
    Route::prefix('/dashboard')->as('dashboard.')->group(function () {


         //absent 

         Route::group(['prefix' => 'absent', 'as' => 'absent.'], function() {

            Route::get('/create', [AbsentController::class, 'create'])->name('create');
            Route::post('/store', [AbsentController::class, 'store'])->name('store');

        });

        Route::group(['prefix' => 'response', 'as' => 'response.'], function(){
           Route::get('/index', [EmployeeResponseController::class, 'index'])->name('index');
           Route::get('/show/id={id}', [EmployeeResponseController::class, 'show'])->name('show');
        });

        Route::get('/index', [RecordController::class, 'index'])->name('index');

        Route::post('/create', [RecordController::class, 'create'])->name('create');

        Route::post('/attendace', [RecordController::class, 'attendance'])->name('attendance');
        Route::get('/getItemView' , [RecordController::class, 'getItemView'])->name('getItemView');
        Route::post('getItemPop/id={id}', [RecordController::class, 'getITemPop'])->name('getItemPop');

        Route::get('/view/Salary', [RecordController::class, 'salaryView'])->name('salaryView');
    });
});





// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


// Route::middleware(['auth'])->group(function(){
//     Route::get('/admin', [AdminController::class, 'index']);
// });
require __DIR__ . '/auth.php';
