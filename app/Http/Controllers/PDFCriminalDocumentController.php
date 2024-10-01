<?php

namespace App\Http\Controllers;

use App\Models\CourtVerdicts;
use App\Models\CrimeDetails;
use App\Models\Suspectphoto;
use App\Models\investigation_details;
use App\Models\Suspect;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PDFCriminalDocumentController extends Controller
{
    public function printdocument(Request $request){

        $id =  $request->input('id');

        $suspectinfo = Suspect::with(['maincategory','station', 'crimecategory'])
        ->where('id', $id)
        ->first();

        $suspectphoto = Suspectphoto::where('suspect_id', $id)->first();
        $crimedetails = CrimeDetails::where('suspect_id', $id)->where('status', 1)->get();
        $courtjudements = CourtVerdicts::where('suspect_id', $id)->where('status', 1)->get();

        if ($suspectinfo) {
            $record_id = 'CRN-' . str_pad($suspectinfo->id, 3, '0', STR_PAD_LEFT);
            $currentDate = Carbon::now()->format('Y-m-d');
        }

        $htmlcrimes ='';

        foreach ($crimedetails as $crimedetail) {
            $htmlcrimes .= '
                 <tr>
                    <td colspan="2" class="form-cell"><label>' . $crimedetail->arrested_date. '</label></td>
                    <td colspan="2" class="form-cell"><label>' . $crimedetail->crime->crime. '</label></td>
                    <td colspan="2" class="form-cell"><label>' . $crimedetail->station->station_name. '</label></td>
                   <td colspan="2" class="form-cell"><label>' . $crimedetail->incident_location. '</label></td>
                  </tr>';
        }

        $htmlverdicts ='';

        foreach ($courtjudements as $courtjudement) {
            $htmlverdicts .= '
                 <tr>
                    <td colspan="2" class="form-cell"><label>' . $courtjudement->crimedetail->crime->crime. '</label></td>
                    <td colspan="2" class="form-cell"><label>' . $courtjudement->dateofjudgement. '</label></td>
                   <td colspan="2" class="form-cell"><label>' . $courtjudement->verdict. '</label></td>
                    <td colspan="2" class="form-cell"><label>' . $courtjudement->penelty. '</label></td>
                  </tr>';
        }

        $html ='<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Criminal Record</title>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                           font-family: Courier New, Courier, monospace;
                        }

                        body {
                            background-color: #fff;
                            padding: 20px;

                        }

                        .form-container {
                            background-color: #fff;
                            padding: 20px;
                            max-width: 100%;
                            margin: 0 auto;
                            border-radius: 5px;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                            position: relative;
                            z-index: 1;
                        }

                        .header-table {
                            width: 100%;
                            margin-top: 20px;
                        }

                        .logo {
                            width: 100px;
                            vertical-align: top;
                        }

                        .logo img {
                            width: 100px;
                            height: 100px;
                        }

                        .header-text {
                            text-align: center;
                            vertical-align: top;
                        }

                        .header-text h1 {
                            font-size: 25px;
                            font-weight: bold;
                            text-transform: uppercase;
                            margin-bottom: 5px;
                        }

                        .header-text h3 {
                            font-size: 20px;
                            margin-bottom: 5px;
                        }

                        .custom-table {
                            width: 100%;
                            margin: 20px 0;
                            text-align: center;
                        }

                        .custom-table table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 0 auto;
                            text-align: center;
                            background-color: #d3e4e4;
                        }

                        .custom-table td {
                            padding: 10px;
                            font-size: 12pt;
                            border: 1px solid #000;
                        }

                        .custom-table td strong {
                            font-weight: bold;
                        }

                        .clearfix {
                           margin: top 25px;
                        }

                        .criminal-profile {
                            margin-top: 20px;
                        }

                        .profile-info {
                            float: left;
                            width: 60%;
                        }

                        .profile-info table {
                            width: 100%;
                            border-collapse: collapse;
                        }

                        .profile-info th,
                        .profile-info td {
                            padding: 3mm;
                            text-align: left;
                            border-bottom: 1px solid #000;
                            font-size: 12pt;
                        }

                        .profile-info td {
                            border-right: none;
                        }

                        .profile-photo {
                            float: right;
                            width: 35%;
                            text-align: right;
                        }

                        .profile-photo img {
                            max-width: 100%;
                            height: auto;
                            border-radius: 5px;
                        }

                        .form-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 20px;
                        }

                        .form-label {
                            font-weight: bold;
                            padding: 3mm;
                            border: 1px solid #333;
                            text-align: left;
                            background-color: #d3e4e4;
                            font-size: 12pt;
                        }

                        .form-cell {
                            padding: 3mm;
                            border: 1px solid #333;
                            background-color: #fff;
                            font-size: 12pt;
                        }

                        .clearfix {
                            clear: both;
                        }
                    </style>
                </head>

                <body>
                    <div class="form-container">
                        <div class="header">
                            <table class="header-table">
                                <tr>
                                    <td class="logo">
                                        <img src="' . public_path('/Images/Logo.png') . '" alt="Police Logo">
                                    </td>
                                    <td class="header-text">
                                        <h1>SMART COP POLICE DEPARTMENT</h1>
                                        <h3>CRIMINAL REPORT</h3>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="custom-table">
                            <table>
                                <tr>
                                    <td><strong>DATE</strong></td>
                                    <td><label>'. $currentDate.'</label></td>
                                    <td><strong>RECORD NO</strong></td>
                                    <td><label>'. $record_id.'</label></td>
                                </tr>
                            </table>
                        </div>

                        <div class="criminal-profile">
                            <div class="profile-info">
                                <table>
                                    <tr>
                                        <td colspan="2"><strong>NAME</strong></td>
                                        <td colspan="6"><label>' . $suspectinfo->fullname. '</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>ALIASES</strong></td>
                                        <td colspan="6">A.K.A.: <label>' . $suspectinfo->aliases. '</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>NIC</strong></td>
                                        <td colspan="3"><label>' . $suspectinfo->idcardno. '</label></td>
                                        <td colspan="2"><strong>GENDER</strong></td>
                                        <td colspan="1"><label>' . $suspectinfo->gender. '</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>DOB</strong></td>
                                        <td colspan="3"><label>' . $suspectinfo->officerdob. '</label></td>
                                        <td colspan="2"><strong>AGE</strong></td>
                                        <td colspan="1"><label>' . $suspectinfo->age. '</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>NATIONALITY</strong></td>
                                        <td colspan="3"><label>' . $suspectinfo->nationality. '</label></td>
                                        <td colspan="2"><strong>CITIZEN</strong></td>
                                        <td colspan="1"><label>' . $suspectinfo->citizenship. '</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>ADDRESS</strong></td>
                                        <td colspan="6"><label>' . $suspectinfo->permentaddress. '</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>CONTACT NO</strong></td>
                                        <td colspan="2"><label>' . $suspectinfo->contactno. '</label></td>
                                        <td colspan="2"><strong>CITY</strong></td>
                                        <td colspan="2"><label>' . $suspectinfo->officercity. '</label></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="profile-photo">
                                <img src="' . public_path('/storage/Photos/SuspectFace/'. $suspectphoto->frontside) . '"
                                    alt="Suspect Photo">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                         <br><br>
                        <div class="crimerecordsection">
                            <table class="form-table">
                                <tr>
                                    <td colspan="2" class="form-label"><strong>ARRESTED DATE</strong></td>
                                    <td colspan="2" class="form-label"><strong>OFFENSE</strong></td>
                                    <td colspan="2" class="form-label"><strong>STATION</strong></td>
                                    <td colspan="2" class="form-label"><strong>LOCATION</strong></td>
                                </tr>
                                '.$htmlcrimes.'
                            </table>
                        </div>
                        <br><br>
                        <div class="crimerecordsection">
                            <table class="form-table">
                                <tr>
                                    <td colspan="2" class="form-label"><strong>OFFENSE</strong></td>
                                    <td colspan="2" class="form-label"><strong>DATE</strong></td>
                                    <td colspan="2" class="form-label"><strong>VERDICT</strong></td>
                                    <td colspan="2" class="form-label"><strong>PENALTY</strong></td>
                                </tr>
                                '.$htmlverdicts.'
                            </table>
                        </div>
                    </div>
                </body>

                </html>


        ';
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');
        $pdfContent = $pdf->output();
        return response()->json(['pdf' => base64_encode($pdfContent)]);
    }
}
