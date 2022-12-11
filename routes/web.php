<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/api/find-user/{email}', [ApiController::class, 'findUser']);
Route::get('/api/save-test', [ApiController::class, 'saveTest']);
Route::post('/api/save-test', [ApiController::class, 'saveTest']);

Route::get('/', function () {
    return view('welcome');
});
