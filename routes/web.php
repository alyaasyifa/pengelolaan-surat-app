\<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::middleware('IsGuest')->group(function() {
    Route::get('/', function () {
        return view('login');
    })->name('login');
});

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/error-permission', function () {
    return view('errors.permission');
})->name('error.permission');



Route::middleware(['IsLogin', 'IsStaff'])->group(function() {
    Route::get('/home', function(){
        return view('home');
    })->name('home');

      //route bener bikin sendiri PLSPLSPLS
      Route::prefix('/user')->name('user.')->group(function(){
        Route::prefix('/staff')->name('staff.')->group(function() {
            Route::get('/', [UserController::class, 'staff'])->name('home');
        });
      
        Route::prefix('/guru')->name('guru.')->group(function() {
            //bikin route, methodnya get, nama urlnya, controllernya berbentuk clas,terus manggil apa yg kita butuhin
            // contoh disini index, class index
            Route::get('/', [UserController::class, 'guru'])->name('home');
        });
        
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    });
    
    
    Route::prefix('/data')->name('data.')->group(function(){
        Route::prefix('/klasifikasi')->name('klasifikasi.')->group(function(){
            Route::get('/', [LetterTypeController::class, 'index'])->name('home');
            Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
            Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
            Route::get('/{id}', [LetterTypeController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
            Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
            Route::get('/show/{id}', [LetterTypeController::class, 'show'])->name('show');
            Route::get('/export/pdf', [LetterTypeController::class, 'export'])->name('export');
            
            Route::get('/data', [LetterTypeController::class, 'data'])->name('data');
            Route::get('/print/{id}', [LetterTypeController::class, 'show'])->name('print');
            Route::get('/download/{id}', [LetterTypeController::class, 'downloadPDF'])->name('download');
        });
        
        Route::prefix('/datasurat')->name('datasurat.')->group(function() {
            Route::get('/', [LetterController::class, 'index'])->name('home');
            Route::get('/create', [LetterController::class, 'create'])->name('create');
            Route::post('/store', [LetterController::class, 'store'])->name('store');
            Route::get('/{id}', [LetterController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [LetterController::class, 'update'])->name('update');
            Route::delete('/{id}', [LetterController::class, 'destroy'])->name('delete');
            Route::get('/print/{id}', [LetterController::class, 'show'])->name('print');
            Route::get('/show/{id}', [LetterController::class, 'show'])->name('show');
            Route::get('/detail/{id}', [LetterController::class, 'detail'])->name('detail');
            Route::get('/download/{id}', [LetterController::class, 'downloadPDF'])->name('download');
            Route::get('/export/pdf', [LetterController::class, 'export'])->name('export');
        });
    
    });
});

Route::middleware(['IsLogin', 'IsGuru'])->group(function() {
    Route::get('/home', function(){
        return view('home');
    })->name('home');

    Route::prefix('/data')->name('data.')->group(function(){
        Route::prefix('/suratmasuk')->name('suratmasuk.')->group(function(){
            Route::get('/', [ResultController::class, 'index'])->name('index');
            Route::get('/create/{id}', [ResultController::class,'create'])->name('create');
            Route::post('/store', [ResultController::class,'store'])->name('store');
            Route::get('/show/{id}', [ResultController::class, 'show'])->name('show');
        });
    });

});



Route::middleware('IsLogin')->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', function(){
        return view('home');
    })->name('home');
});