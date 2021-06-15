<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('welcome');
});

//Category Controller
Route::get('/category/all', [CategoryController::class, 'Allcat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'Addcat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Editcat']);
Route::post('/category/update/{id}', [CategoryController::class, 'Updatecat']);
Route::get('/category/softdelete/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'RestorCat']);
Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);

//For multi-image

Route::get('/multi-image', [BrandController::class, 'MultiImage'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImage'])->name('store.image');

//For Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'UpdateBrand']);
// Route::get('/brand/softdelete/{id}', [BrandController::class, 'SoftDelete']);
// Route::get('/brand/restore/{id}', [BrandController::class, 'RestorBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);


//auth Route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    //$users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
