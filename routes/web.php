<?php

use Inertia\Inertia;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SealController;
use App\Http\Controllers\MeetingController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', [MeetingController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

route::get('/createmeeting', [MeetingController::class, 'create'])->name('createmeeting');
route::post('/createmeeting', [MeetingController::class, 'store'])->name('createmeeting');


# test pour pdf
Route::get('/hello', [SealController::class, "index"]);
Route::post('/hello', [SealController::class, "store"]);



require __DIR__ . '/auth.php';
