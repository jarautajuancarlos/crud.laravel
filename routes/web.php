<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;

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

// vista inicial login
Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

// ruta para entrar al index
Route::group(['middleware' => 'auth'], function(){
  Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});


require __DIR__.'/auth.php';
