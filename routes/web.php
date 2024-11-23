<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\ClosedinvestigationController;
use App\Http\Controllers\ComplainDashboard;
use App\Http\Controllers\ConvictedcriminalController;
use App\Http\Controllers\CrimeanalizerController;
use App\Http\Controllers\CrimedashboardController;
use App\Http\Controllers\CriminaldashboardController;
use App\Http\Controllers\CriminalotherController;
use App\Http\Controllers\CriminalpropertyController;
use App\Http\Controllers\CriminalseriousController;
use App\Http\Controllers\CriminalviolentController;
use App\Http\Controllers\RolemanageController;
use App\Http\Controllers\UsermanageController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\MissingpersonController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\OngoinginvestigationController;
use App\Http\Controllers\OthercomplainsController;
use App\Http\Controllers\PDFCriminalDocumentController;
use App\Http\Controllers\PDFInvestigationDocumentController;
use App\Http\Controllers\ProfilesettingController;
use App\Http\Controllers\SuspectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin controller routes
Route::get('/permisionlist', [Admincontroller::class, 'index'])->name('permisionlist');
Route::get('/addpermision/{id}', [Admincontroller::class, 'addprivilegesview'])->name('addpermision');
Route::post('/saveprivilegies', [Admincontroller::class, 'updateprivilegies'])->name('saveprivilegies');



// role mange controller routes
Route::get('/rolelists', [RolemanageController::class, 'index'])->name('rolelists');
Route::post('/insertrole', [RolemanageController::class, 'storeRole'])->name('insertrole');
Route::post('/editrole', [RolemanageController::class, 'edit'])->name('editrole');
Route::delete('/roledelete/{role}', [RolemanageController::class, 'destroy'])->name('roledelete');

// user manage controller routes
Route::get('/userdashbord', [UsermanageController::class, 'index'])->name('userdashbord');
Route::post('/storeuser', [UsermanageController::class, 'store'])->name('storeuser');
Route::post('/edituser', [UsermanageController::class, 'edit'])->name('edituser');
Route::get('/userstatus/{id}/{status}', [UsermanageController::class, 'status'])->name('userstatus');

// Department Controller Routes
Route::get('/departmentdashboard', [DepartmentController::class, 'index'])->name('departmentdashboard');
Route::post('/officersearch', [DepartmentController::class, 'search'])->name('officersearch');
Route::get('/viewofficer/{id}', [DepartmentController::class, 'viewofficer'])->name('viewofficer');


// Division Controller Routes
Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions');
Route::get('/districts/{provinceId}', [DivisionController::class, 'getDistricts'])->name('districts');
Route::post('/divisionstore', [DivisionController::class, 'store'])->name('divisionstore');
Route::post('/divisionsedit', [DivisionController::class, 'edit'])->name('divisionsedit');
Route::get('/divisionsstatus/{id}/{status}', [DivisionController::class, 'status'])->name('divisionsstatus');

// Station Controller Routes
Route::get('/stations', [StationController::class, 'index'])->name('stations');
Route::post('/stationsstore', [StationController::class, 'store'])->name('stationsstore');
Route::post('/stationsedit', [StationController::class, 'edit'])->name('stationsedit');
Route::get('/stationsstatus/{id}/{status}', [StationController::class, 'status'])->name('stationsstatus');

// Officer Controller Routes
Route::get('/offiers', [OfficerController::class, 'index'])->name('offiers');
Route::get('/newoffiers', [OfficerController::class, 'newofficer'])->name('newoffiers');
Route::get('/showofficers', [OfficerController::class, 'showofficers'])->name('showofficers');
Route::get('/policestations/{divisionID}', [OfficerController::class, 'getpolicestation'])->name('policestations');
Route::post('/offiersstore', [OfficerController::class, 'store'])->name('offiersstore');
Route::get('/offieredit/{id}', [OfficerController::class, 'edit'])->name('offieredit');
Route::get('/offiersstatus/{id}/{status}', [OfficerController::class, 'status'])->name('offiersstatus');
Route::post('/checkidcardavalibility', [OfficerController::class, 'checkIdCard'])->name('checkidcardavalibility');
Route::post('/checkofficeridavalibility', [OfficerController::class, 'checkOfficerId'])->name('checkofficeridavalibility');
Route::post('/offierslogincreate', [OfficerController::class, 'createofficerlogin'])->name('offierslogincreate');

// Criminal Dashboard Controller Routes
Route::get('/criminaldashboard', [CriminaldashboardController::class, 'index'])->name('criminaldashboard');
Route::post('/criminalsearch', [CriminaldashboardController::class, 'search'])->name('criminalsearch');
Route::get('/criminalview/{id}', [CriminaldashboardController::class, 'View'])->name('criminalview');
Route::post('/criminalsearchimage', [CriminaldashboardController::class, 'Imagesearch'])->name('criminalsearchimage');


// Suspects Controller Routes
Route::get('/suspects', [SuspectController::class, 'index'])->name('suspects');
Route::get('/newsuspects', [SuspectController::class, 'newsuspect'])->name('newsuspects');
Route::post('/suspectsstore', [SuspectController::class, 'store'])->name('suspectsstore');
Route::get('/crimelist/{maincategoryID}', [SuspectController::class, 'getcrime'])->name('crimelist');
Route::get('/showsuspects', [SuspectController::class, 'showsuspects'])->name('showsuspects');
Route::get('/suspectsedit/{id}', [SuspectController::class, 'edit'])->name('suspectsedit');
Route::get('/suspectstatus/{id}/{status}', [SuspectController::class, 'status'])->name('suspectstatus');
Route::post('/suspectcheckidcardavalibility', [SuspectController::class, 'checkIdCard'])->name('suspectcheckidcardavalibility');


//Criminalserous Controller Routes
Route::get('/criminalserious', [CriminalseriousController::class, 'index'])->name('criminalserious');
Route::get('/showseriouscriminal', [CriminalseriousController::class, 'showseriouscriminal'])->name('showseriouscriminal');
Route::post('/criminalseriousstore', [CriminalseriousController::class, 'store'])->name('criminalseriousstore');
Route::post('/criminalseriouscrimeverdict', [CriminalseriousController::class, 'crimeverdict'])->name('criminalseriouscrimeverdict');
Route::get('/criminalseriousview/{id}', [CriminalseriousController::class, 'View'])->name('criminalseriousview');
Route::post('/criminalseriousupdate', [CriminalseriousController::class, 'update'])->name('criminalseriousupdate');
Route::post('/criminalseriouscrimeverdictupdate', [CriminalseriousController::class, 'updateotherCrimeVerdict'])->name('criminalseriouscrimeverdictupdate');

//Criminalproperty Controller Routes
Route::get('/criminalproperty', [CriminalpropertyController::class, 'index'])->name('criminalproperty');
Route::get('/showpropertycriminal', [CriminalpropertyController::class, 'showpropertycriminal'])->name('showpropertycriminal');
Route::post('/criminalpropertystore', [CriminalpropertyController::class, 'store'])->name('criminalpropertystore');
Route::post('/criminalpropertycrimeverdict', [CriminalpropertyController::class, 'crimeverdict'])->name('criminalpropertycrimeverdict');
Route::get('/criminalpropertyview/{id}', [CriminalpropertyController::class, 'View'])->name('criminalpropertyview');
Route::post('/criminalpropertyupdate', [CriminalpropertyController::class, 'update'])->name('criminalpropertyupdate');
Route::post('/criminalpropertycrimeverdictupdate', [CriminalpropertyController::class, 'updateotherCrimeVerdict'])->name('criminalpropertycrimeverdictupdate');


//Criminalviolent Controller Routes
Route::get('/criminalviolent', [CriminalviolentController::class, 'index'])->name('criminalviolent');
Route::get('/showviolentcriminal', [CriminalviolentController::class, 'showviolentcriminal'])->name('showviolentcriminal');
Route::post('/criminalviolentstore', [CriminalviolentController::class, 'store'])->name('criminalviolentstore');
Route::post('/criminalviolentcrimeverdict', [CriminalviolentController::class, 'crimeverdict'])->name('criminalviolentcrimeverdict');
Route::get('/criminalviolentview/{id}', [CriminalviolentController::class, 'View'])->name('criminalviolentview');
Route::post('/criminalviolentupdate', [CriminalviolentController::class, 'update'])->name('criminalviolentupdate');
Route::post('/criminalviolentcrimeverdictupdate', [CriminalviolentController::class, 'updateCrimeVerdict'])->name('criminalviolentcrimeverdictupdate');

// commen routes
Route::get('/getCrimeDetails/{id}', [CriminalviolentController::class, 'getCrimeDetails'])->name('getCrimeDetails');
Route::get('/getCrimejudgementDetails/{id}', [CriminalviolentController::class, 'getCrimejudgementDetails'])->name('getCrimejudgementDetails');
Route::get('/getcrimerecordlist', [CriminalviolentController::class, 'getCrimeRecords'])->name('getcrimerecordlist');
Route::get('/deletecrimedetails/{id}', [CriminalviolentController::class, 'deletecrimedetails'])->name('deletecrimedetails');
Route::get('/deletejudgementdetails/{id}', [CriminalviolentController::class, 'deletejudgementdetails'])->name('deletejudgementdetails');

//Criminalother Controller Routes
Route::get('/criminalother', [CriminalotherController::class, 'index'])->name('criminalother');
Route::get('/showothercriminal', [CriminalotherController::class, 'showothercriminal'])->name('showothercriminal');
Route::get('/criminalotherview/{id}', [CriminalotherController::class, 'View'])->name('criminalotherview');
Route::post('/criminalotherstore', [CriminalotherController::class, 'store'])->name('criminalotherstore');
Route::post('/criminalothercrimeverdict', [CriminalotherController::class, 'crimeverdict'])->name('criminalothercrimeverdict');
Route::post('/criminalotherupdate', [CriminalotherController::class, 'update'])->name('criminalotherupdate');
Route::post('/criminalothercrimeverdictupdate', [CriminalotherController::class, 'updateotherCrimeVerdict'])->name('criminalothercrimeverdictupdate');

//Convictedcriminal Controller Routes
Route::get('/convictedcriminals', [ConvictedcriminalController::class, 'index'])->name('convictedcriminals');
Route::get('/showconvictedcriminals', [ConvictedcriminalController::class, 'showconvictedcriminals'])->name('showconvictedcriminals');
Route::get('/convictedcriminalsview/{id}', [ConvictedcriminalController::class, 'View'])->name('convictedcriminalsview');

// Crime Dashboard Controller Routes
Route::get('/crimedashboard', [CrimedashboardController::class, 'index'])->name('crimedashboard');
Route::post('/crimesearch', [CrimedashboardController::class, 'search'])->name('crimesearch');
Route::get('/crimeview/{id}', [CrimedashboardController::class, 'view'])->name('crimeview');

// investigation Contontroller Routes
Route::get('/investigations', [InvestigationController::class, 'index'])->name('investigations');
Route::get('/newinvestigation', [InvestigationController::class, 'newinvestigation'])->name('newinvestigation');
Route::post('/investigationstore', [InvestigationController::class, 'store'])->name('investigationstore');
Route::get('/showinvestigations', [InvestigationController::class, 'showinvestigations'])->name('showinvestigations');
Route::get('/investigationstatus/{id}/{status}', [InvestigationController::class, 'status'])->name('investigationstatus');
Route::get('/investigationsedit/{id}', [InvestigationController::class, 'edit'])->name('investigationsedit');
Route::get('/investigationsvictimdelete/{id}', [InvestigationController::class, 'victimdelete'])->name('investigationsvictimdelete');

// ongoing investigation controller routes
Route::get('/ongoinginvestigations', [OngoinginvestigationController::class, 'index'])->name('ongoinginvestigations');
Route::get('/showongoinginvestigations', [OngoinginvestigationController::class, 'showongoinginvestigations'])->name('showongoinginvestigations');
Route::post('/saveinvestigationnote', [OngoinginvestigationController::class, 'saveinvestigationnote'])->name('saveinvestigationnote');
Route::post('/saveinvestigationclose', [OngoinginvestigationController::class, 'saveinvestigationclose'])->name('saveinvestigationclose');
Route::get('/ongoinginvestigationviewgetCrimeDetails/{id}', [OngoinginvestigationController::class, 'view'])->name('ongoinginvestigationview');
Route::get('/getCrimeNoteDetails/{id}', [OngoinginvestigationController::class, 'getCrimeNoteDetails'])->name('getCrimeNoteDetails');
Route::post('/updateinvestigationnote', [OngoinginvestigationController::class, 'updateinvestigationnote'])->name('updateinvestigationnote');
Route::get('/deleteinvestigationnote/{id}', [OngoinginvestigationController::class, 'deleteinvestigationnote'])->name('deleteinvestigationnote');

// colsed investigation controller routes
Route::get('/closedinvestigations', [ClosedinvestigationController::class, 'index'])->name('closedinvestigations');
Route::get('/showclosedinvestigations', [ClosedinvestigationController::class, 'showclosedinvestigations'])->name('showclosedinvestigations');
Route::get('/closedinvestigationsviewapprove/{id}', [ClosedinvestigationController::class, 'viewforapprove'])->name('closedinvestigationsviewapprove');
Route::get('/closedinvestigationapprove/{id}', [ClosedinvestigationController::class, 'approveclosing'])->name('closedinvestigationapprove');
Route::get('/closedinvestigationsview/{id}', [ClosedinvestigationController::class, 'view'])->name('closedinvestigationsview');

// print pdf investigation document controller routes 
Route::post('/printinvestigationdocument', [PDFInvestigationDocumentController::class, 'printdocument'])->name('printinvestigationdocument');

// print pdf criminal document controller routes 
Route::post('/printcriminaldocument', [PDFCriminalDocumentController::class, 'printdocument'])->name('printcriminaldocument');

Route::get('/userprofile', [ProfilesettingController::class, 'index'])->name('userprofile');
Route::get('/usersettings', [ProfilesettingController::class, 'index'])->name('usersettings');

// Crime Anaizer
Route::get('/crimeanalizer', [CrimeanalizerController::class, 'index'])->name('crimeanalizer');
Route::post('/analizecrime', [CrimeanalizerController::class, 'analizer'])->name('analizecrime');


// Crime Dashboard Controller Routes
Route::get('/complaindashboard', [ComplainDashboard::class, 'index'])->name('complaindashboard');


// Missing Person Complains Controller Routes
Route::get('/missingpersioncomplains', [MissingpersonController::class, 'index'])->name('missingpersioncomplains');
Route::get('/newmissingcomplains', [MissingpersonController::class, 'newmissingcomplains'])->name('newmissingcomplains');
Route::post('/missingpersioncomplainsinsert', [MissingpersonController::class, 'insert'])->name('missingpersioncomplainsinsert');
Route::get('/showmissingpersioncomplain', [MissingpersonController::class, 'showcomplaints'])->name('showmissingpersioncomplain');
Route::get('/missingpersioncomplainsdelete/{id}', [MissingpersonController::class, 'delete'])->name('missingpersioncomplainsdelete');


// other Complains Controller Routes
Route::get('/othercomplains', [OthercomplainsController::class, 'index'])->name('othercomplains');
Route::get('/newothercomplains', [OthercomplainsController::class, 'newothercomplains'])->name('newothercomplains');