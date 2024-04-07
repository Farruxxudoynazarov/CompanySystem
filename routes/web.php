<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

*/

Route::get('/', function (){
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/profile/edit', function () {
    return view('profile.edit');
})->middleware(['auth'])->name('profile.edit');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('company', CompanyController::class);
Route::resource('employee', EmployeeController::class);

require __DIR__.'/auth.php';

// CompanyController va EmployeeController uchun resurs yo'llarini ro'yxatga olish
// Route::resource('company', CompanyController::class);
// Route::resource('employee', EmployeeController::class);


// Route::resource('employees', EmployeeController::class);
    
    // Route::middleware(['role:company'])->group(function () {
        // Route::get('/company/dashboard', [CompanyController::class, 'index']);
        
        
        // Route::get('profile', [CompanyController::class, 'editProfile'])->name('company.profile.edit');
        // Route::put('profile', [CompanyController::class, 'updateProfile'])->name('company.profile.update');
        
        
    // });
    

    // Route::middleware(['role:admin'])->group(function () {
        
        
    //     Route::get('/admin/dashboard', [UsersController::class, 'index'])->name('admin.dashboard');
        
    //     Route::resource('admin', UsersController::class);
    //     Route::resource('employee', EmployeeController::class);
    //     Route::resource('company', CompanyController::class);
        
    // });
   
    // Route::resource('employee', EmployeeController::class);
    
// Route::group(['prefix' => 'company', 'middleware' => ['auth', 'role:company']], function () {
//     Route::get('/dashboard', [CompanyController::class, 'index'])->name('company.dashboard');
//     Route::resource('employees', EmployeeController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
//     Route::get('/profile', [CompanyController::class, 'editProfile'])->name('company.profile.edit');
//     Route::post('/profile', [CompanyController::class, 'updateProfile'])->name('company.profile.update');
// });


// Autentifikatsiya yo'nalishlari
