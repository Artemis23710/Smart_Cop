<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Operation_officers;
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



}
