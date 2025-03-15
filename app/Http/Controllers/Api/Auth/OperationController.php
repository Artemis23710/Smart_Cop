<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\operation_close;
use App\Models\Operation_officers;
use App\Models\operation_progress;
use App\Models\Operation_targets;
use App\Models\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OperationController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $userid = $request->user_id;
            $operation = Operations::create([
                'Name' => $request->name_operation,
                'title' => $request->title_operation,
                'operation_Type' => $request->type_operation,
                'Start_date' => $request->start_operation,
                'End_date' => $request->end_operation,
                'operation_budget' => $request->budget_operation,
                'officerincharge' => $request->officer_incharge,
                'description' => $request->description,
                'status' => 1, 
                'Complete_status' => 0,
                'approve_status' => 0,
                'created_by' =>  $userid,
                'updated_by' => 0,
            ]);

            $operationId = $operation->id;
           
            $targetsofopp = $request->input('targetsofopp'); 



            if(is_array($targetsofopp)){

                foreach ($targetsofopp  as $rowtarget) {
                    $name = $rowtarget['name'];
                    $description = $rowtarget['description'];
                    Operation_targets::create([
                        'operation_id' => $operationId,
                        'target_name' => $name,
                        'target_description' => $description,
                        'status' => 1,
                        'created_by' => $userid,
                        'updated_by' => 0,
                    ]);
                }
            }
          

            $officerinopp = $request->input('officerinopp'); 

            if(is_array($officerinopp)){
            foreach ($officerinopp as $rowofficer) {

                $officer_id = $rowofficer['officer_id'];
                $officer_badge = $rowofficer['officer_badge'];
                $officer_role = $rowofficer['officer_role'];

                    Operation_officers::create([
                        'operation_id' => $operationId,
                        'Officer_id' => $officer_id,
                        'officer_badge' => $officer_badge,
                        'officer_role' => $officer_role,
                        'status' => 1,
                        'created_by' =>$userid,
                        'updated_by' => 0,
                    ]);
                }
            }
           
            DB ::commit();

                    return response()->json(['message' => 'Operation created successfully'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                
                return response()->json([
                    'error' => $e->getMessage()
                ], 400);
            }
    }

    public function operationlist(Request $request){

        $operations=DB::table('operations')->select('*')->where('status',1)->where('Complete_status',0)->get();

        $data = array(
            'operationlist' => $operations
        );
        return (new BaseController)->sendResponse($data, 'operationlist');
    }

    public function edit(Request $request)
    {
        $recordID = $request->id;

        $operations=DB::table('operations')->select('*')->where('id',$recordID) ->first();
        $operation_tragets=DB::table('operation_targets')->select('*')->where('operation_id',$recordID)->where('status',1)->get();
        
        $operation_officers = Operation_officers::with('officers:id,fullname') 
        ->where('operation_id', $recordID)
        ->where('status', 1)
        ->get()
        ->map(function ($officer) {
            return [
                'id' => $officer->id,
                'operation_id' => $officer->operation_id,
                'Officer_id' => $officer->Officer_id,
                'officer_badge' => $officer->officer_badge,
                'officer_role' => $officer->officer_role,
                'status' => $officer->status,
                'created_by' => $officer->created_by,
                'updated_by' => $officer->updated_by,
                'officer_name' => $officer->officers->fullname ?? null,
            ];
        });

        $data = array(
            'operationlist' => $operations,
            'targetlist' => $operation_tragets,
            'officerslist' => $operation_officers
        );
        return (new BaseController)->sendResponse($data, 'operationlist', 'targetlist','officerslist');

    }

    public function delete(Request $request){

        $recordID = $request->id;
        $userid = $request->user_id;

        DB::table('operations')->where('id', $recordID)->update(['status' => 3,'updated_by' => $userid]);
        DB::table('operation_targets')->where('operation_id', $recordID)->update(['status' => 3,'updated_by' => $userid]);
        DB::table('operation_officers')->where('operation_id', $recordID)->update(['status' => 3,'updated_by' => $userid]);

        return response()->json(['message' => 'Operation Deleted successfully'], 201);
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $userid = $request->user_id;
            $record_ID = $request->recordID;
            $operation = Operations::where('id', $record_ID )->update([
                'Name' => $request->name_operation,
                'title' => $request->title_operation,
                'operation_Type' => $request->type_operation,
                'Start_date' => $request->start_operation,
                'End_date' => $request->end_operation,
                'operation_budget' => $request->budget_operation,
                'officerincharge' => $request->officer_incharge,
                'description' => $request->description,
                'updated_by' => $userid,
            ]);
           
            $targetsofopp = $request->input('targetsofopp'); 



            if(is_array($targetsofopp)){

                foreach ($targetsofopp  as $rowtarget) {
                    $name = $rowtarget['name'];
                    $description = $rowtarget['description'];
                    $targetrecord_id = $rowtarget['targetrecord_id'];

                    if(!empty($targetrecord_id)){
                        Operation_targets::where('id', $targetrecord_id )->update([
                            'target_name' => $name,
                            'target_description' => $description,
                            'updated_by' => $userid,

                        ]);
                    }else{
                        Operation_targets::create([
                            'operation_id' => $record_ID,
                            'target_name' => $name,
                            'target_description' => $description,
                            'status' => 1,
                            'created_by' => $userid,
                            'updated_by' => 0,
                        ]);
                    }
                  
                }
            }
          

            $officerinopp = $request->input('officerinopp'); 

            if(is_array($officerinopp)){
            foreach ($officerinopp as $rowofficer) {

                $officer_id = $rowofficer['officer_id'];
                $officer_badge = $rowofficer['officer_badge'];
                $officer_role = $rowofficer['officer_role'];
                $officerrecord_id = $rowofficer['officerrecord_id'];

                if( !empty($officerrecord_id) ){

                    Operation_officers::where('id', $officerrecord_id)->update([
                        'Officer_id' => $officer_id,
                        'officer_badge' => $officer_badge,
                        'officer_role' => $officer_role,
                        'updated_by' =>$userid,
                    ]);

                }else{
                    
                    Operation_officers::create([
                        'operation_id' => $record_ID,
                        'Officer_id' => $officer_id,
                        'officer_badge' => $officer_badge,
                        'officer_role' => $officer_role,
                        'status' => 1,
                        'created_by' =>$userid,
                        'updated_by' => 0,
                    ]);
                }
                }
            }
           
            DB ::commit();

                    return response()->json(['message' => 'Operation Updated successfully'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                
                return response()->json([
                    'error' => $e->getMessage()
                ], 400);
            }
    }

    public function deletetarget(Request $request){
        $recordID = $request->id;
        $userid = $request->user_id;

        DB::table('operation_targets')->where('id', $recordID)->update(['status' => 3,'updated_by' => $userid]);

        return response()->json(['message' => 'Operation Target Deleted successfully'], 201);
    }

    public function deleteofficers(Request $request){
        $recordID = $request->id;
        $userid = $request->user_id;

        DB::table('operation_officers')->where('id', $recordID)->update(['status' => 3,'updated_by' => $userid]);

        return response()->json(['message' => 'Operation Officers Deleted successfully'], 201);
    }

    public function approve(Request $request){

        $recordID = $request->operation_id;
        $userid = $request->user_id;

        DB::table('operations')->where('id', $recordID)->update(['approve_status' => 1,'approved_by' => $userid]);

        return response()->json(['message' => 'Operation Approved successfully'], 201);
    }

    public function closedoperationlist(Request $request){

        $operations=DB::table('operations')->select('*')->where('status',1)->where('Complete_status',1)->get();

        $data = array(
            'operationlist' => $operations
        );
        return (new BaseController)->sendResponse($data, 'operationlist');
    }

    public function operationprogress(Request $request){
        
        DB::beginTransaction();
        try {

            $userid = $request->user_id;
            $operation = operation_progress::create([
                'operation_id' => $request->recordID,
                'report_date' => $request->progressdate,
                'report_title' => $request->progresstitle,
                'description' => $request->progressdescription,
                'status' => 1, 
                'created_by' =>  $userid,
                'updated_by' => 0,
            ]);

            DB ::commit();

                    return response()->json(['message' => 'Operation Progress Report created successfully'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                
                return response()->json([
                    'error' => $e->getMessage()
                ], 400);
            }
    }


    public function operationclosing(Request $request){
        
        DB::beginTransaction();
        try {

            $recordID = $request->recordID;
            $userid = $request->user_id;
            $operation = operation_close::create([
                'operation_id' => $request->recordID,
                'closing_date' => $request->closing_date,
                'closing_type' => $request->closing_type,
                'closing_reason' => $request->close_reason,
                'closing_description' => $request->closingdescription,
                'status' => 1, 
                'created_by' =>  $userid,
                'updated_by' => 0,
            ]);

            DB::table('operations')->where('id', $recordID)
            ->update(['Complete_status' => 1,'approved_by' => $userid]);

            DB ::commit();

                    return response()->json(['message' => 'Operation Closing Report created successfully'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                
                return response()->json([
                    'error' => $e->getMessage()
                ], 400);
            }
    }
}
