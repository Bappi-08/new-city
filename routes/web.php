<?php

use App\Models\building_category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Building;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Building_Category_Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User_Detail_controller;
use App\Http\Controllers\UserController;
use App\Models\User_Detail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/user_information',[HomeController::class,'user_information'])->name('user_information');
Route::get('/details/{id}',[HomeController::class,'details'])->name('details');
Route::middleware('auth')->group(function () {
    Route::get('/second_home',[HomeController::class,'second_home']);
    Route::get('/third_home',[HomeController::class,'third_home'])->name('third_home');
    Route::get('/create',[HomeController::class,'create'])->name('create');
    Route::post('/create/store',[HomeController::class,'data_store'])->name('user.store');
    Route::get('/user_create',[HomeController::class,'user_create'])->name('user_create');
    Route::post('/user_create/user_store',[HomeController::class,'user_store'])->name('user_store');
    Route::get('/forth_home',[HomeController::class,'forth_home'])->name('forth_home');
    Route::get('/information_edit/{id}',[HomeController::class,'bari_edit'])->name('bari_edit');
    // Route::post('/user_update/{id}',[HomeController::class,'user_update'])->name('user_update');
    Route::match(['put', 'post'], 'user_update/{id}', [HomeController::class, 'user_update'])->name('user_update');
   
});

Route::get('/dashboard', function () {
    return view('frontEnd.pages.second_home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route ::middleware(['auth','is_admin'])->prefix('admin')->name('admin.')->group(function()
{   Route::get('/dashboard',function()
    {   return view ('backEnd.layouts.masters');

    });
    Route::get('/profile',[Building_Category_Controller::class,'profile'])->name('profile');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    

Route::put('/User_Detail/{id}/updateStatus', [User_Detail_controller::class, 'updateStatus'])->name('User_Detail.updateStatus');
Route::put('/Building/{id}/updateStatus', [BuildingController::class, 'updateStatus'])->name('Building.updateStatus');


    Route::get('/users',[UserController::class,'index'])->name('users');
    Route::get('/buildings/map', [BuildingController::class, 'mapView'])->name('Building.map');
    Route::get('/buildings/{id}/map', [BuildingController::class, 'showMap'])->name('Building.showMap');


    Route::get('/User_Detail/{id}/user_details',[User_Detail_controller::class,'user_details'])->name('user_detailss');

    Route::resource('Building_Category',Building_Category_Controller::class);
    Route::resource('Building',BuildingController::class);
    Route::resource('User_Detail',User_Detail_controller::class);
    
});



