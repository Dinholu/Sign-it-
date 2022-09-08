<?php

use App\Models\Seal;
use Inertia\Inertia;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SealController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ParticipantController;

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
})->name('Welcome');



Route::get('/index', [MeetingController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

# Route pour créer un nouveau meeting
route::get('/createmeeting', [MeetingController::class, 'create'])->name('createmeeting');
route::post('/createmeeting', [MeetingController::class, 'store'])->name('createmeeting');
route::get('/editmeeting/{meeting:slug}', [MeetingController::class, 'edit'])->name('editmeeting');
route::put('/editmeeting/{meeting:slug}', [MeetingController::class, 'update'])->name('editmeeting');
route::put('/closemeeting/{meeting:slug}', [MeetingController::class, 'close'])->name('closemeeting');
route::delete('/deletemeeting/{meeting:slug}', [MeetingController::class, 'destroy'])->name('deletemeeting');


# route afficher une réunion
Route::get('meetings/{meeting:slug}', [MeetingController::class, 'show']);

#route pour participant
Route::post('/createparticipant', [ParticipantController::class, 'store'])->name('createparticipant');


Route::get('/seal', [SealController::class, 'index'])->name('seals');
Route::get('/seal/{seal:id}', [SealController::class, 'download']);
# test pour pdf
// Route::get('/hello', [SealController::class, "index"]);
// Route::post('/hello', [SealController::class, "store"]);





require __DIR__ . '/auth.php';
