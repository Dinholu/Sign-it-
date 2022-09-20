<?php

namespace App\Console;

use App\Models\Seal;
use App\Models\Meeting;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            $meetings = Meeting::where('statut', 'open')->get();
            foreach ($meetings as $meeting) {
                if ($meeting->closing < $meeting->date) {
                    $meeting->statut = 'close';
                    $meeting->save();

                    $token = Str::random($length = 15);
                    $path = 'pdftest.pdf';

                    // $file = storage_path('app/' . $path);
                    $image = storage_path('app/encart.png');

                    $pdf = new Fpdi('L', 'mm', 'A4');
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->setSourceFile(storage_path('app/' . $path));
                    $tplId = $pdf->importPage(1);
                    $size = $pdf->getTemplateSize($tplId);
                    $pdf->useTemplate($tplId, 1, 1, $size['width'], $size['height'], TRUE);

                    $pdf->SetXY(15, 50);
                    $pdf->SetFont("");
                    $pdf->Write(15, 'Reunion du ' . $meeting->date);
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->SetXY(15, 60);
                    $pdf->Write(15, 'Ordre du jour : ' . iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $meeting->title));
                    $pdf->SetXY(15, 70);
                    $pdf->SetFont("");

                    $pdf->Write(15, 'Lieu : ' . iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $meeting->place));
                    $pdf->SetXY(15, 90);
                    $pdf->Write(15, 'Description : ' . iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $meeting->description));
                    $pdf->SetXY(15, 100);
                    $pdf->Write(15, 'Date de cloture : ' . $meeting->closing);
                    $pdf->SetXY(15, 110);
                    $pdf->Write(15, 'Participants:');
                    $pdf->SetXY(15, 120);
                    foreach ($meeting->participant as $participant) {
                        $pdf->Write(15, iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $participant->name . ' ' . $participant->firstname));
                        $pdf->SetXY(15, $pdf->GetY() + 10);
                    }
                    // $xxx_final = ($size['width'] - 60);
                    // $yyy_final = ($size['height'] - 20);
                    // $pdf->Image($image, $xxx_final, $yyy_final, 40, 20, 'PNG');
                    $pathOutput = storage_path('app/pdf/' . $meeting->slug . '.pdf');
                    $pdf->Output($pathOutput, "F");
                    $fileHash = sha1_file($pathOutput);

                    Seal::create([
                        'path' => $meeting->slug . '.pdf',
                        'token' => $token,
                        'sha1' => $fileHash,
                        'meeting_id' => $meeting->id,
                    ]);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
