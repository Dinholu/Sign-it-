<?php

use App\Models\Seal;
use Inertia\Inertia;
use App\Models\Meeting;
use setasign\Fpdi\Fpdi;
use App\Models\Participant;
use Illuminate\Support\Str;
use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SealController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Http\RedirectResponse;

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
    if (Auth::check()) {
        return redirect('/index');
    }
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('Welcome');


Route::middleware(['auth', 'verified'])->group(
    function () {
        # Route index
        Route::get('/index', [MeetingController::class, 'index'])->name('index');
        Route::get('/index/search', [MeetingController::class, 'index'])->middleware(['auth', 'verified'])->name('index.search');

        # Route pour créer un nouveau meeting
        route::get('/createmeeting', [MeetingController::class, 'create'])->name('createmeeting');
        route::post('/createmeeting', [MeetingController::class, 'store'])->name('createmeeting');
        route::get('/editmeeting/{meeting:slug}', [MeetingController::class, 'edit'])->name('editmeeting');
        route::put('/editmeeting/{meeting:slug}', [MeetingController::class, 'update'])->name('editmeeting');
        route::put('/closemeeting/{meeting:slug}', [MeetingController::class, 'close'])->name('closemeeting');
        route::get('/participantedit/{meeting:slug}', [MeetingController::class, 'editparticipant'])->name('openmeeting');
        route::delete('/deletemeeting/{meeting:slug}', [MeetingController::class, 'destroy'])->name('deletemeeting');
        route::delete('participantedit/deleteparticipant/{participant:id}', [ParticipantController::class, 'destroy'])->name('deleteparticipant');



        Route::get('/seal', [SealController::class, 'index'])->name('seals');
        Route::get('/seal/{seal:id}', [SealController::class, 'download']);
    }
);


# route afficher une réunion
Route::get('meetings/{meeting:slug}', [MeetingController::class, 'show']);
#route pour participant
Route::post('/createparticipant', [ParticipantController::class, 'store'])->name('createparticipant');

// Route::get('/test', function () {
//     return Inertia::render('Test');
// })->name('test');


require __DIR__ . '/auth.php';
