<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Operation_officers;
use App\Models\Operation_targets;
use App\Models\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name_operation' => 'required|string',
            'title_operation' => 'required|string',
            'type_operation' => 'required|string',
            'start_operation' => 'required|date',
            'end_operation' => 'required|date',
            'budget_operation' => 'required|numeric',
            'officer_incharge' => 'required|string',
            'description' => 'nullable|string',
            'targetsofopp' => 'array',
            'targetsofopp.*.name' => 'required|string',
            'targetsofopp.*.description' => 'nullable|string',
            'officerinopp' => 'array',
            'officerinopp.*.officer_id' => 'required|integer',
            'officerinopp.*.officer_badge' => 'required|string',
            'officerinopp.*.officer_role' => 'required|string',
        ]);

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
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);


            foreach ($request->targetsofopp as $target) {
                Operation_targets::create([
                    'target_name' => $target['name'],
                    'target_description' => $target['description'],
                    'status' => 'Active',
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
            }

            foreach ($request->officerinopp as $officer) {
                Operation_officers::create([
                    'Officer_id' => $officer['officer_id'],
                    'officer_badge' => $officer['officer_badge'],
                    'officer_role' => $officer['officer_role'],
                    'status' => 'Active',
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
            }

            DB ::commit();

            return response()->json(['message' => 'Operation created successfully'], 201);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create operation', 'details' => $e->getMessage()], 500);
        }
    }
}
