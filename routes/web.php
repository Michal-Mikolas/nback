<?php

use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Models\UserTest;
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
Route::post('/api/save-test', [ApiController::class, 'saveTest']);
Route::get('/{email}', function($email){
    return view('results', [
        'user' => User::where('email', $email)->firstOrFail(),
        'allMainTests' => UserTest::where('is_main_test', 1),
        'allMinorTests' => UserTest::where('is_main_test', 0),
    ]);
})->where('email', '[^\s@]+@[^\s@]+\.[^\s@]+');

Route::get('/', function () {
    return view('welcome');
});
