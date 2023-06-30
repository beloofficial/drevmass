<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthWebController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', function () {
        return redirect('/admin/products');
    });

    Route::get('/admin/lessons', [AuthWebController::class, 'lessons'])->name('list-lessons');
    Route::get('/admin/lessons/{lesson}', [AuthWebController::class, 'showLesson']);
    Route::post('/admin/lessons/{lesson}', [AuthWebController::class, 'updateLesson']);
    Route::get('/admin/lessons/{lesson}/delete', [AuthWebController::class, 'deleteLesson']);
    Route::get('/admin/lessons/create/new', [AuthWebController::class, 'createLesson']);
    Route::post('/admin/lessons/create/new', [AuthWebController::class, 'createLessonPost']);

    Route::get('/admin/products', [AuthWebController::class, 'products'])->name('list-products');
    Route::get('/admin/products/{product}', [AuthWebController::class, 'showProduct']);
    Route::post('/admin/products/{product}', [AuthWebController::class, 'updateProduct']);
    Route::get('/admin/products/{product}/delete', [AuthWebController::class, 'deleteProduct']);
    Route::get('/admin/products/create/new', [AuthWebController::class, 'createProduct']);
    Route::post('/admin/products/create/new', [AuthWebController::class, 'createProductPost']);

    Route::get('/admin/supports', [AuthWebController::class, 'supports'])->name('list-supports');
    Route::get('/admin/supports/{support}', [AuthWebController::class, 'showSupport']);
    Route::post('/admin/supports/{support}', [AuthWebController::class, 'updateSupport']);
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/admin/login', [AuthWebController::class, 'login'])->name('password.update')->name('authorize');
Route::get('/admin/logout', [AuthWebController::class, 'logout'])->name('password.update')->name('admin-logout');


Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/reset-password-success', function () {
    return view('auth.reset-password-success');
})->name('password-reset-success');


Route::get('__health', function () {
   echo "working";
});
