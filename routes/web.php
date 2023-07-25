<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashbobardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;




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

// Main Page Route
// Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
 Route::get('/',function (){

    return redirect()->route('panel.dashboard');

 });


/********************Authencation***********************/
Route::get('register',[RegisterController::class,'indexRegister'])->name('auth.register');
Route::get('login',[LoginController::class,'indexLogin'])->name('auth.login');
Route::post('login',[LoginController::class,'storeLogin'])->name('auth.login');
Route::get('index/logout', [LogoutController::class, 'logout'])->name('index.logout');

Route::prefix('panel')->middleware('isAuth')->group(function () {

   Route::get('',[ProfileController::class,'adminProfile'])->name('admin.profile');
   Route::post('/update',[ProfileController::class,'adminProfileUpdate'])->name('admin.profile.update');
   
   Route::get('dashboard',[DashbobardController::class,'indexDashboard'])->name('panel.dashboard');
   Route::resource('users', UserController::class);
   
   Route::prefix('gsetting')->group(function (){

      Route::resource('diseases', DiseaseController::class);
      Route::resource('tests', TestController::class);
   
   });

});

// Route::get('/', [\App\Http\Controllers\SocialController::class, 'redirectToProvider']);
// Route::get('/callback', [\App\Http\Controllers\SocialController::class, 'handleProviderCallback']);