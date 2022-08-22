<?php

use Inertia\Inertia;
use Illuminate\Support\Str;
use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

# test pour pdf
Route::get('/hello', function () {
    $hello = Str::random($length = 15);


    // $outputFile = "./public/hello.pdf";
    // header('Content-type: application/pdf');
    // header('Content-Disposition: inline; filename="' . $outputFile . '"');
    // header('Content-Transfer-Encoding: binary');
    // header('Accept-Ranges: bytes');
    // @readfile($outputFile);


    $pdf = new Fpdi();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $path = public_path('/hello.pdf');
    $pdf->setSourceFile($path);
    $tplId = $pdf->importPage(1);
    // use the imported page and place it at point 10,10 with a width of 100 mm
    $pdf->useTemplate($tplId, null, null, null, 210, true);

    // Now this details we are going to print in pdf.
    // Horizontal and veritcal setXY


    $pdf->SetXY(40, 40);
    // Details you want to print

    // Now let's change details an position
    $pdf->Write(0.1, "BBUniversal");

    // let's bring another below it

    // Second details
    $pdf->SetXY(40, 50);
    $pdf->Write(0.1, "Thank you. If you have any doubt.");

    $pdf->SetXY(40, 60);
    $pdf->Write(0.1, "Feel free to comment.");
    ddd($pdf);
});
require __DIR__ . '/auth.php';
