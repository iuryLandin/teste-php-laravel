<?php

use App\Http\Controllers\DocumentsController;
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
})->name('index');

Route::get('documents/queue', [DocumentsController::class, 'showQueue'])->name('documents.showQueue');
Route::post('documents/queue', [DocumentsController::class, 'processQueue'])->name('documents.processQueue');
Route::resource('documents', DocumentsController::class);
