<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
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

// Route::get('/datatable', function () {
//     return view('datatable');
// });

Route::get('/datatable', function () {
    if (request()->start_date || request()->end_date) {
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $data = App\Models\Registrant::whereBetween('created_at',[$start_date,$end_date])->get();
    } else {
        $data = App\Models\Registrant::latest()->get();
    }
    
    return view('datatable', compact('data'));
});

Route::get('/', function () {
    if (request()->start_date || request()->end_date) {
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        $data = App\Models\Registrant::whereBetween('created_at',[$start_date,$end_date])->get();
    } else {
        $data = App\Models\Registrant::latest()->get();
    }
    
    return view('welcome', compact('data'));
});