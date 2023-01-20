<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PDFController;
use App\Http\Livewire\Statecitydropdown;

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
    return view('welcome');
});


Route::get('/akwaaba', function () {
    return view('akwaaba');
});



Route::get('/livewire',function(){
    return view('livewire.category_home');
});


Route::get('/benefit',function(){
    return view('livewire.benefit_home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'get_dashboard'])->name('home');

Route::get('/file-import',[UserController::class,'importView'])->name('import-view');
Route::post('/import',[UserController::class,'import'])->name('import');
Route::get('/export-users',[UserController::class,'exportUsers'])->name('export-users');

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);




Route::get('/families', [App\Http\Controllers\FamilyController::class, 'index'])->name('get_family');
   
Route::any('/add_family', [App\Http\Controllers\FamilyController::class, 'add_family'])->name('add_family');
Route::any('/edit_family/{id}', [App\Http\Controllers\FamilyController::class, 'edit_family'])->name('edit_family');
Route::get('/get_dashboard', [App\Http\Controllers\HomeController::class, 'get_dashboard'])->name('get_dashboard');
Route::any('/get_death', [App\Http\Controllers\FamilyController::class, 'get_death'])->name('get_death');
Route::any('/add_death', [App\Http\Controllers\FamilyController::class, 'add_death'])->name('add_death');

Route::any('/edit_death/{id}', [App\Http\Controllers\FamilyController::class, 'edit_death'])->name('edit_death');

Route::any('/get_funeral', [App\Http\Controllers\FamilyController::class, 'get_funeral'])->name('get_funeral');

Route::any('/add_funeral', [App\Http\Controllers\FamilyController::class, 'add_funeral'])->name('add_funeral');

Route::any('/edit_funeral/{id}', [App\Http\Controllers\FamilyController::class, 'edit_funeral'])->name('edit_funeral');

Route::any('/del_deceased/{id}', [App\Http\Controllers\FamilyController::class, 'del_deceased'])->name('del_deceased');

Route::any('/get_beneficiary', [App\Http\Controllers\UtilityController::class, 'get_beneficiary'])->name('get_beneficiary');

//Route::get('post/{id}', Donation::class);


Route::any('/get_nsawa/{nid}', [App\Http\Controllers\UtilityController::class, 'get_nsawa'])->name('get_nsawa');

Route::any('/set_funeral', [App\Http\Controllers\UtilityController::class, 'set_funeral'])->name('set_funeral');

Route::any('/get_paymt_detail', [App\Http\Controllers\ReportController::class, 'get_paymt_detail'])->name('get_paymt_detail');
Route::any('/get_paymt_summary', [App\Http\Controllers\ReportController::class, 'get_paymt_summary'])->name('get_paymt_summary');

Route::any('/get_paymt_detail_excel', [App\Http\Controllers\ReportController::class, 'get_paymt_detail_excel'])->name('get_paymt_detail_excel');

Route::any('/get_paymt_detail_pdf', [App\Http\Controllers\ReportController::class, 'get_paymt_detail_pdf'])->name('get_paymt_detail_pdf');

Route::any('/get_rpt_options', [App\Http\Controllers\ReportController::class, 'get_rpt_options'])->name('get_rpt_options');

Route::any('/donation_bydeceased', [App\Http\Controllers\ReportController::class, 'donation_bydeceased'])->name('donation_bydeceased');




Route::get('/sign_out', function (){
    Session::flush();
    Auth::logout();

    return Redirect('login');
});


Route::get('/students',function(){
    return view('livewire.student_home');
});



// Others or Tests



Route::get('statecitydropdown', Statecitydropdown::class);

Route::get('/ben/{nid}', App\Http\Livewire\Donation::class);



// Route::get('/donation/{nid}',function(){
//     return view('livewire.donation_home');
// });