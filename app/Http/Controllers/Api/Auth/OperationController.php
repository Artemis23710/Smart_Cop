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
                'created_by' => Auth::id(),
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
                        'created_by' => Auth::id(),
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
                        'created_by' =>Auth::id(),
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


}
