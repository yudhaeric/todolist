<?php

use App\Http\Controllers\TodoController;
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

Route::get('/', [TodoController::class, 'index']);
Route::put('/update-status/{id}', [TodoController::class, 'updateStatus']);

Route::get('/add', [TodoController::class, 'add']);
Route::post('/store', [TodoController::class, 'store']);

Route::get('/edit-task/{id}', [TodoController::class, 'edit']);
Route::put('/task/{id}', [TodoController::class, 'update']);

Route::delete('/delete-task/{id}', [TodoController::class, 'delete']);
Route::get('/task/{id}/restore', [TodoController::class, 'restore']);
Route::get('/task/{id}/destroy', [TodoController::class, 'destroy']);
