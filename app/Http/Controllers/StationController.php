<?php

namespace App\Http\Controllers;

use App\Models\PoliceDivision;
use App\Models\policestations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{
    public function index(){
        $divisions = PoliceDivision::all();
        return view('Department.Stations.station', compact('divisions'));
    }

    public function store(Request $request){

        $request->validate([
            'divisionid' => 'required',
            'stationname' => 'required|string|max:255',
            'stationaddress' => 'required|string|max:255',
            'stationcontact' => 'required|string|max:255'
        ]);


        if ($request->hiddenid == 1) {

            policestations::create([
                'division_id' => $request->divisionid,
                'station_name' => $request->stationname,
                'station_address' => $request->stationaddress,
                'station_contact' => $request->stationcontact,
                'status' => 1,
                'created_by' => Auth::id(),
                'update_by' => 0
            ]);
    
            $message = 'Police Station Created Successfully.';

        }else{

            $station = policestations::find($request->recordID);
            if ($station) {
                $station->update([
                    'division_id' => $request->divisionid,
                    'station_name' => $request->stationname,
                    'station_address' => $request->stationaddress,
                    'station_contact' => $request->stationcontact,
                    'updated_by' => Auth::id()
                ]);
                
                $message = 'Police Station Updated Successfully.';
            }

        }

        return redirect()->back()->with('message', $message);

    }

    public function edit(Request $request){

        $id = Request('id');
        if (request()->ajax()) {
            $data = policestations::find($id);
            return response()->json(['result' => $data]);
        }
    }

    public function status($requestid, $statusid)

    {
        $user = Auth::user();

        if($statusid == 1){

            $user = policestations::findOrFail($requestid);
            $user->status = 1;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Police Station Activated Succssfully.';
        }elseif($statusid == 2){

            $user = policestations::findOrFail($requestid);
            $user->status = 2;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Police Station Deactivated Succssfully.';

        }else{

            $user = policestations::findOrFail($requestid);
            $user->status = 3;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Police Station Deleted Succssfully.';

        }

        return redirect()->back()->with('message', $message);
    }
}
