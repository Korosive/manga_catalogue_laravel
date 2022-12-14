<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;

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

Route::get('/', [MangaController::class, 'index']);

Route::get('/home', [MangaController::class, 'index']);

Route::get('/search', [MangaController::class, 'search']);

Route::post('/search/add', [MangaController::class, 'create']);

Route::post('/update_status', [MangaController::class, 'update']);

Route::post('/remove', [MangaController::class, 'destroy']);