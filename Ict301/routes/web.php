<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Fruitcake\Cors\HandleCors;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ReservationController;

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

Route::get('/',function (){
    return view('admin.dashboard');
});

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('slider',[App\Http\Controllers\SliderController::class, 'index'])->name('slider.index');
Route::get('reservation',[ReservationController::class, 'index'])->name('reservation.index');
Route::get('contact',[App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
Route::post('reservation', [ReservationController::class, 'store'])->name('reservation.reserve');
Route::post('reserver/{id}', [ReservationController::class, 'status'])->name('reserver.status');
Route::delete('reservation/{id}',[App\Http\Controllers\ReservationController::class, 'destory'])->name('reserva.destory');
Route::resource('reservation', \App\Http\Controllers\Admin\ReservationController::class);
Route::resource('category',\App\Http\Controllers\Admin\CategoryController::class);
Route::resource('item',\App\Http\Controllers\Admin\ItemController::class);
Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class);

Route::get('/home',  [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/contact',[App\Http\Controllers\ContactController::class, 'message'])->name('contact.send');


Route::get('admin/dashboard',function (){
    return view('admin.dashboard');


});

Route::group(['prefix'=>'admin','middleware'=>'auth','as' => 'admin.'],function(){

	Route::get('dashboard',[DashboardController::class, 'index']);
    Route::get('slider',[SliderController::class,'index']);
	Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class);
	Route::resource('category',\App\Http\Controllers\Admin\CategoryController::class);
	Route::resource('item',\App\Http\Controllers\Admin\ItemController::class);

    Route::get('reservation',[App\Http\Controllers\ReservationController::class, 'index'])->name('reservation.index');
    Route::post('reservation/{id}',[App\Http\Controllers\ReservationController::class, 'status'])->name('reservation.status');
    Route::delete('reservation/{id}',[App\Http\Controllers\ReservationController::class, 'destory'])->name('reservation.destory');

    Route::get('contact',[App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/{id}',[App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
    Route::delete('contact/{id}',[App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');

	// lage nai ai gula
//	Route::get('create','SliderController@create');
//	Route::get('store','SliderController@store');
//	Route::post('edit','SliderController@edit');
//	Route::post('update','SliderController@update'); ai porjonto

   // Route::get('category','CategoryController@index')->name('admin.category');

});

