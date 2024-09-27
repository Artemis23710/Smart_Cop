<?php

namespace App\Http\Controllers;
;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFInvestigationDocumentController extends Controller
{
    public function printdocument(Request $request){
        $id =  $request->input('id');


        $html ='<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Appointment Letter</title>
                         </head>
                    <body>
                        <div class="container">
                        <h1>Hellow world</h1>
                            </div>
                    </body>
                    </html>';


                    
                    $pdf = Pdf::loadHTML($html);
                    $pdf->setPaper('A4', 'portrait');
                    $pdfContent = $pdf->output();
                    return response()->json(['pdf' => base64_encode($pdfContent)]);
    }
}
