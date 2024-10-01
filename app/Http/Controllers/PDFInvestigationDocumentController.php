<?php

namespace App\Http\Controllers;
;

use App\Models\investigation_details;
use App\Models\investigation_vicims;
use App\Models\Crime_investigation_closing;
use App\Models\CrimeDetails;
use App\Models\Crimelist;
use App\Models\investigation_evidences;
use App\Models\Maincrimecategory;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Officers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFInvestigationDocumentController extends Controller
{
    public function printdocument(Request $request){
        $id =  $request->input('id');
        $victims = investigation_vicims::where('investigation_id', $id)->where('status', 1)->get();
        $investigationinfo = investigation_details::with(['crimemain','station', 'crime', 'officer'])
                ->where('id', $id)
                ->first();
        $investigationcolse = Crime_investigation_closing::where('investigation_id', $id)->first();
        $suspects = CrimeDetails::where('investigation_id', $id)->where('status', 1)->with(['crime','suspect'])->get();
        $crimenotes = DB::table('crime_investigation_notes')
        ->select( 'crime_investigation_notes.*', )
        ->where('crime_investigation_notes.investigation_id', $id)
        ->where('crime_investigation_notes.status', 1)
        ->get();
    
        $instatus = $investigationinfo->investigation_status;
        $investigationstatus ='';
        if( $instatus == 0){
            $investigationstatus .='<span class="text-danger">Ongoing Investigation</span>';
        }else{
            $investigationstatus .='<span class="text-success">Closed Investigation</span>';
        }


        $htmlvictims = '';
                foreach ($victims as $victim) {
                    $htmlvictims .= '
                        <tr>
                            <td colspan="3" class="form-cell"><label>' . $victim->victim_name. '</label></td>
                            <td colspan="2" class="form-cell"><label>' . $victim->victim_gender . '</label></td>
                            <td class="form-cell"><label>' . $victim->victim_age . '</label></td>
                        </tr>';
                }

        $htmlsuspects ='';

        foreach ($suspects as $suspect) {
            $htmlsuspects .= '<tr>
                                <td colspan="3" class="form-label">NAME OF THE SUSPECTS</td>
                                <td class="form-label">ALIASES</td>
                                <td class="form-label">SUSPECTS NIC</td>
                                <td class="form-label">ARRESTED DATE</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="form-cell"><label>'.$suspect->suspect->fullname.'</label></td>
                                <td class="form-cell"><label>'.$suspect->suspect->aliases.'</label></td>
                                <td class="form-cell"><label>'.$suspect->suspect->idcardno.'</label></td>
                                <td class="form-cell"><label>'.$suspect->arrested_date.'</label></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="form-label">ARRESTED CRIME</td>
                                <td colspan="2" class="form-label">ARRESTED LOCATION</td>
                                <td colspan="2" class="form-label">DATE OF INCIDENT</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="form-cell"><label>'.$suspect->crime->crime.'</label></td>
                                <td colspan="2" class="form-cell"><label>'.$suspect->incident_location.'</label></td>
                                <td colspan="2" class="form-cell"><label>'.$suspect->dateofincident.'</label></td>
                            </tr>';
        }


        $htmlnotes = '';

        foreach ($crimenotes as $note) {
                    $htmlnotes .= '<table class="form-table">
                                    <tr>
                                        <td colspan="6" class="form-label" style="text-align:center;">
                                            <label>INVESTIGATION NOTE - ' . $note->investigation_title. '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="form-label">TITLE</td>
                                        <td class="form-label">DATE</td>
                                        <td colspan="2" class="form-label">RELATED LOCATION</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="form-cell"><label>' . $note->investigation_title . '</label></td>
                                        <td class="form-cell"><label>' .$note->day_investigation_note . '</label></td>
                                        <td colspan="2" class="form-cell"><label>' . $note->related_location. '</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="form-label">SUMMARY</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="form-cell"><label>' .$note->description. '</label></td>
                                    </tr>';

                                    $evidances = investigation_evidences::where('investigation_note_id', $note->id)->where('status', 1)->get();   
                                    if ($evidances->count() > 0) {
                                        foreach ($evidances as $evidance) {
                                            $htmlnotes .= '
                                                            <tr>
                                                                <td colspan="6" class="form-label" style="text-align:center;">
                                                                    <label>INVESTIGATION NOTE EVIDENCE </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td  colspan="3" class="form-label">EVIDENCE</td>
                                                                <td  class="form-label">EVIDENCE TITLE</td>
                                                                <td colspan="2" class="form-label">EVIDENCE DESCRIPTION</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="form-cell"> <img src="' . public_path('/storage/Investigation_Evidance/Evidances/'. $evidance->evidence) . '" class="evidanceimage" alt="Police Logo"></td>
                                                                <td class="form-cell"><label>' . $evidance->evidence_title . '</label></td>
                                                                <td colspan="2" class="form-cell"><label>' . $evidance->evidence_desription . '</label></td>
                                                            </tr> ';
                                        }
                                    }else{
                                        $htmlnotes .= '<tr><td colspan="6" class="form-cell">No evidence available for this note.</td></tr>';
                                    }
                    $htmlnotes .= '</table><br><br><br>';
                    }
        

        $html ='
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Police Report Form</title>
                <style>

                    * {
                        margin: 0;
                        padding: 0;
                        font-family: Courier New, Courier, monospace;
                    }

                    body {
                        background-color: #fff;
                        padding: 20px;
                        position: relative;
                    }

                    .form-container {
                        background-color: #fff;
                        padding: 20px;
                        max-width: 900px;
                        margin: 0 auto;
                        border-radius: 5px;
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
                        text-align: right;
                        vertical-align: top;
                    }

                    .header-text h1 {
                        font-size: 20px;
                        font-weight: bold;
                        text-transform: uppercase;
                        margin-bottom: 5px;
                    }

                    .header-text h3 {
                        font-size: 16px;
                        margin-bottom: 5px;
                    }

                    .header-text h5 {
                        font-size: 12px;
                        margin-top: 5px;
                    }


                    .info-row, .row {
                        display: flex;
                        flex-wrap: wrap;
                        margin-bottom: 10px;
                    }

                    .field {
                        flex: 1;
                        min-width: 200px;
                        padding: 10px;
                    }

                    .field.full {
                        flex: 1 0 100%;
                    }

                    .field label {
                        display: block;
                        font-weight: bold;
                        margin-bottom: 5px;
                        font-size: 14px;
                    }

                    .field input,
                    .field select,
                    .field textarea {
                        width: 100%;
                        padding: 8px;
                        border: 1px solid #ccc;
                        border-radius: 3px;
                    }

                    .field textarea {
                        height: 100px;
                    }

                    .section {
                        margin-bottom: 20px;
                    }

                    .section h4 {
                        padding: 10px;
                        font-size: 16px;
                        text-transform: uppercase;
                        margin-bottom: 10px;
                    }

                    .custom-table {
                        display: table;
                        width: 100%;
                        border-collapse: collapse;
                        border: 1px solid #333;
                    }

                    .table-row {
                        display: table-row;
                    }

                    .table-cell {
                        display: table-cell;
                        padding: 10px;
                        border: 1px solid #333;
                        text-align: left;
                        font-weight: bold;
                        background-color: #f0f0f0;
                        width: 33.33%;
                    }
                    .celltitles{
                        font-size: 12px;
                        font-weight: bold;
                        margin-bottom: 25px;
                    }

                    .form-table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .form-header {
                        text-align: left;
                        font-size: 18px;
                        font-weight: bold;
                        padding: 10px;
                        background-color: #f0f0f0;
                    }

                    .form-header span {
                        font-weight: normal;
                        font-size: 14px;
                    }

                    .form-label {
                        font-weight: bold;
                        padding: 8px;
                        border: 1px solid #333;
                        text-align: left;
                        background-color: #d3e4e4;
                    }

                    .form-cell {
                        padding: 15px;
                        border: 1px solid #333;
                        background-color: #fff;
                    }
                    .evidanceimage{
                                width: 350px;
                                height: auto;
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
                                    <h1>SMART-COP POLICE DEPARTMENT</h1>
                                    <h3>'.$investigationinfo->title_incident.'</h3>
                                    <h5>Investigation Case Document</h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="custom-table">
                        <div class="table-row">
                            <div class="table-cell"><label class="celltitles">STATION.  '.$investigationinfo->station->station_name.' </label></div>
                            <div class="table-cell"><label class="celltitles">CASE NO.  '.$investigationinfo->case_no.'</label></div>
                            <div class="table-cell"><label class="celltitles">REPORT DATE. '.$investigationinfo->report_date.'</label></div>
                        </div>
                    </div>

                    <div class="section">
                        <table class="form-table">
                            <tr>
                                <td colspan="4" class="form-label" style="text-align:center;">
                                    <label>INVESTIGATION INCIDENT DETAILS</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="form-label">CRIME CATEGORY</td>
                                <td colspan="2" class="form-label">CRIME</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="form-cell"><label>'.$investigationinfo->crimemain->main_crime_category.'</label></td>
                                <td colspan="2" class="form-cell"><label>'.$investigationinfo->crime->crime.'</label></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="form-label">INCIDET TITLE</td>
                                <td class="form-label">INCIDET DATE</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="form-cell"><label>'.$investigationinfo->title_incident.'</label></td>
                                <td class="form-cell"><label>'.$investigationinfo->incident_date.'</label></td>
                            </tr>
                            <tr>
                                <td class="form-label">INCIDENT LOCATION</td>
                                <td class="form-label">INCIDENT AREA</td>
                                <td colspan="2" class="form-label">INCIDENT RELATED STATION</td>
                            </tr>
                            <tr>
                                <td class="form-cell"><label>'.$investigationinfo->incident_location.'</label></td>
                                <td class="form-cell"><label>'.$investigationinfo->incident_area.'</label></td>
                                <td colspan="2" class="form-cell"><label>'.$investigationinfo->station->station_name.'</label></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="form-label">INVESTIGATION OFFICER</td>
                                <td class="form-label">ASSIGN DATE</td>
                                <td class="form-label">INVESTIGATION STATUS</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="form-cell"><label>'.$investigationinfo->officer->fullname.'</label></td>
                                <td class="form-cell"><label>'.$investigationinfo->assigndate.'</label></td>
                                <td class="form-cell"><label>'.$investigationstatus.'</label></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="form-label">INCIDENT DESCRIPTION</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="form-cell"><label>'.$investigationinfo->incident_description.'</label></td>
                            </tr>
                        </table>
                    </div>
                    <br><br><br><br>
                    <div class="section">
                        <table class="form-table">
                            <tr>
                                <td colspan="6" class="form-label" style="text-align:center;">
                                    <label>VICTIMS OF THE INCIDENT </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="form-label">NAME OF THE VICTIM</td>
                                <td colspan="2" class="form-label">GENDER</td>
                                <td class="form-label">AGE</td>
                            </tr>
                              ' . $htmlvictims . '
                        </table>
                    </div>

                    <br><br><br><br>

                    <div class="section">
                        <table class="form-table">
                            <tr>
                                <td colspan="6" class="form-label" style="text-align:center;">
                                    <label>SUSPECTS OF THE INVSTIGATION </label>
                                </td>
                            </tr>
                            '. $htmlsuspects.'
                        </table>
                    </div>
                    <br><br><br><br>

                    <div class="section">
                        <table class="form-table">
                            <tr>
                                <td colspan="6" class="form-label" style="text-align:center;">
                                    <label>INVESTIGATION CLOSING</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="form-label">DAY OF CLOSING INVESTIGATION</td>
                                <td colspan="3" class="form-label">REASON FOR CLOSING</td>
                                <td colspan="2" class="form-label">CLOSED BY</td>
                            </tr>
                            <tr>
                                <td class="form-cell"><label>'.$investigationcolse->dayofclosing.'</label></td>
                                <td colspan="3" class="form-cell"><label>'.$investigationcolse->reason_closing.'</label></td>
                                <td colspan="2" class="form-cell"><label></label></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="form-label">CLOSING SUMMARY</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="form-cell"><label>'.$investigationcolse->closing_summary.'</label></td>
                            </tr>
                        </table>
                    </div>

                    <br><br><br><br>

                    <div class="section">
                        '. $htmlnotes.'
                    </div>
                </div>
            </body>
            </html>';
            
            $pdf = Pdf::loadHTML($html);
            $pdf->setPaper('A4', 'portrait');
            $pdfContent = $pdf->output();
            return response()->json(['pdf' => base64_encode($pdfContent)]);
    }
}
