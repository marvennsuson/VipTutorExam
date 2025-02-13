<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductAdminController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\admin\UserAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'admin','as' => 'admin.'],function(){
    Route::middleware(['auth', 'verified','CheckAdmin:admin'])->group(function () {

    Route::group(['prefix' => 'dashboard','as' => 'dashboard.'],function(){
        Route::get('index', [AdminDashboardController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'product','as' => 'product.'],function(){
  
          Route::get('index', [ProductAdminController::class, 'index'])->name('index');
            Route::get('create', [ProductAdminController::class, 'create'])->name('create');
            Route::post('store', [ProductAdminController::class, 'store'])->name('store');
            Route::get('/show/{id?}', [ProductAdminController::class, 'show'])->name('show');
            Route::put('/update/{id?}', [ProductAdminController::class, 'update'])->name('update');
            Route::get('/delete/{id?}', [ProductAdminController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'users','as' => 'users.'],function(){
  
        Route::get('index', [UserAdminController::class, 'index'])->name('index');
    
          Route::get('/show/{id?}', [UserAdminController::class, 'show'])->name('show');

  });
});
});



    // Route group for users
    Route::group(['prefix' => 'user','as' => 'user.'],function(){
        Route::middleware(['auth','CheckAdmin:user'])->group(function () {
        Route::group(['prefix' => 'dashboard','as' => 'dashboard.'],function(){
            Route::get('index', [UserDashboardController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'product','as' => 'product.'],function(){
            Route::get('index', [ProductController::class, 'index'])->name('index');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('/show/{id?}', [ProductController::class, 'show'])->name('show');
            Route::get('/edit/{id?}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{id?}', [ProductController::class, 'update'])->name('update');
            Route::get('/delete/{id?}', [ProductController::class, 'destroy'])->name('destroy');
        });
    
     
    });
    });

    Route::group(['prefix' => 'api','as' => 'api.'],function(){
   
        Route::group(['prefix' => 'product','as' => 'product.'],function(){
            Route::get('index', [ApiProductController::class, 'index'])->name('index');
            Route::get('create', [ApiProductController::class, 'create'])->name('create');
            Route::post('store', [ApiProductController::class, 'store'])->name('store');
            Route::get('/show/{id?}', [ApiProductController::class, 'show'])->name('show');
            Route::get('/edit/{id?}', [ApiProductController::class, 'edit'])->name('edit');
            Route::put('/update/{id?}', [ApiProductController::class, 'update'])->name('update');
            Route::get('/delete/{id?}', [ApiProductController::class, 'destroy'])->name('destroy');
        });
     
        //   Route::apiResource('product',ApiProductController::class);
    
    
    
   
    });
require __DIR__.'/auth.php';
