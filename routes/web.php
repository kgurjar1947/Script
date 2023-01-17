<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CreatescriptController;


  
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
    return view('auth.login');
});

Route::get('/firstlevel', function () {
    return view('firstlevel');
})->name('firstlevel');

Route::get('/secondlevel', function () {
    return view('secondlevel');
})->name('secondlevel');

Route::get('/thirdlevel', function () {
    return view('thirdlevel');
})->name('thirdlevel');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Route::get('script/{uid}', [CreatescriptController::class, 'GenerateScript'])->name('script');

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('user/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::post('/addurl', [CreatescriptController::class, 'AddURL'])->name('add.url');
    Route::post('/script', [CreatescriptController::class, 'GetScript'])->name('get.script');
    Route::post('/level1/view', [CreatescriptController::class, 'Getlevel1view'])->name('Get.level1.view');
    Route::post('/level2/view', [CreatescriptController::class, 'Getlevel2view'])->name('Get.level2.view');
    Route::post('/profile/img', [CreatescriptController::class, 'profilepic'])->name('profile.img');
    Route::post('/profile/update', [CreatescriptController::class, 'profileupdate'])->name('profile_update');
    Route::get('/change-password', [HomeController::class, 'updatePassword'])->name('update-password');

    
    
    Route::post('/script/delete',[CreatescriptController::class,'deletescripts'])->name('delete.script');
    Route::post('/script/deletelevel2',[CreatescriptController::class,'deletescriptslevel2'])->name('deletelevel');

    

});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});