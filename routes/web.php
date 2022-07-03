<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LetterController;
use App\Models\Letter;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $data = Letter::paginate(10);
        $active = 'active';
        return view('dashboard', compact('data', 'active'));
        // return $data;
    })->name('dashboard');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::resource('category', CategoryController::class)->except('show');

    Route::resource('letter',LetterController::class);
});


