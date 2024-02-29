<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['approval'])->group(function () {
        Route::get('/pending', [UserController::class, 'status'])->name('request.pending');

        Route::get('/dashboard', function () {
            $user = auth()->user();

            \Log::info('User status:', ['status' => optional($user)->status]);

            if ($user && $user->status == 'approved') {
                return redirect()->route('redirect');
            } elseif ($user && $user->status == 'pending') {
                return view('request.pending');
            } else {
                return view('request.rejected');
            }
        })->name('dashboard');
        
        // routes/web.php

        Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

        Route::resource('companies', CompanyController::class);
        Route::resource('products', ProductController::class);

        Route::get('/home', [HomeController::class, 'redirect'])->middleware('user.approval');

        Route::get('/show-products/{companyId}', [HomeController::class, 'showProductsByCompany'])->middleware('user.approval')->name('show.products.by.company');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/approve/{id}', [UserController::class, 'approve'])->name('users.approve');
        Route::put('/users/reject/{id}', [UserController::class, 'reject'])->name('users.reject');
    });
});

require __DIR__.'/auth.php';

