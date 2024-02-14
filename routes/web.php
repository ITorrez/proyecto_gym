<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/listar_usuarios', [App\Http\Controllers\HomeController::class, 'listar'])->name('listar_usuarios');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::post('/crear_usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('crear_usuarios');
Route::put('/editar_usuarios/{idUser}', [App\Http\Controllers\UserController::class, 'update'])->name('editar_usuarios');
Route::delete('/eliminar_usuarios/{idUser}', [App\Http\Controllers\UserController::class, 'destroy'])->name('eliminar_usuarios');
//Clientes
Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients');
Route::get('/listar_clients', [App\Http\Controllers\ClientController::class, 'listado_clientes'])->name('listar_clients');
Route::post('/crear_clientes', [App\Http\Controllers\ClientController::class, 'store'])->name('crear_clientes');
Route::put('/editar_clientes/{idcli}', [App\Http\Controllers\ClientController::class, 'update'])->name('editar_clientes');
Route::delete('/eliminar_clientes/{idcli}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('eliminar_clientes');
//Membresia
Route::post('/crear_membresia', [App\Http\Controllers\MembresiaController::class, 'store'])->name('crear_membresia');
//Precios
Route::get('/precios', [App\Http\Controllers\PrecioController::class, 'index'])->name('precios');
Route::get('/listar_precios', [App\Http\Controllers\PrecioController::class, 'listado_precios'])->name('listar_precios');
Route::get('/listado_precios_membresia', [App\Http\Controllers\PrecioController::class, 'listado_precios_membresia'])->name('listar_precios_membresia');
Route::post('/crear_precio', [App\Http\Controllers\PrecioController::class, 'store'])->name('crear_precio');
Route::put('/editar_precio/{precio}', [App\Http\Controllers\PrecioController::class, 'update'])->name('editar_precio');
Route::delete('/eliminar_precio/{precio}', [App\Http\Controllers\PrecioController::class, 'destroy'])->name('eliminar_precio');
Route::get('/mostrar_precio/{precio}', [App\Http\Controllers\PrecioController::class, 'show'])->name('mostrar_precio');



