<?php

namespace App\Services;

use App\Models\Officers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Officerprofilephoto;
use App\Models\Suspect;
use App\Models\Suspectphoto;


class SuspectService
{
    
    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'idcardno' => 'required|string|max:255',
            'namewithintial' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'aliases' => 'string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'officerdob' => 'required|date',
            'suspectage' => 'required',
            'nationality' => 'required|string',
            'citizen' => 'required|string|in:Yes,No',
            'contactno' => 'required|string|max:15',
            'permentaddress' => 'required|string|max:255',
            'officercity' => 'required|string|max:255',
            'arreststationid' => 'required|integer',
            'crimecategory' => 'required|integer',
            'arrestedcrime' => 'required|integer',
            'arrestdate' => 'required|date',
            'suspectfrontphoto' => 'nullable|image',
            'suspectleftphoto' => 'nullable|image',
            'suspectrightphoto' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        $keywords = $request->idcardno . ' ' . $request->firstname . ' ' . $request->middlename . ' ' . $request->lastname;

        if ($request->hiddenid == 1) {
            $suspect = Suspect::create([
                'Keywords' => $keywords,
                'idcardno' => $request->idcardno,
                'namewithintial' => $request->namewithintial,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'fullname' => $request->fullname,
                'aliases' => $request->aliases,
                'gender' => $request->gender,
                'officerdob' => $request->officerdob,
                'age' => $request->suspectage,
                'nationality' => $request->nationality,
                'citizenship' => $request->citizen,
                'contactno' => $request->contactno,
                'permentaddress' => $request->permentaddress,
                'officercity' => $request->officercity,
                'stationid' => $request->arreststationid,
                'maincategoryid' => $request->crimecategory,
                'crimeid' => $request->arrestedcrime,
                'arresteddate' => $request->arrestdate,
                'status' => 1,
                'convictedstatus' => 0,
                'created_by' => Auth::id(),
                'updated_by' => 0
            ]);

            $savedSuspectId = $suspect->id;

            if ($request->hasFile('suspectfrontphoto') && $request->hasFile('suspectleftphoto') && $request->hasFile('suspectrightphoto')) {

                $file = $request->file('suspectfrontphoto');
                $fileNameface = now()->year . '-' . $request->idcardno .'.'. $savedSuspectId . '.' . $file->getClientOriginalExtension();
                $officerPhotoPathface = $file->storeAs('SuspectFace', $fileNameface, 'SuspectFace');

                $file = $request->file('suspectleftphoto');
                $fileNameleft = now()->year . '-' . $request->idcardno .'.'. $savedSuspectId . '.' . $file->getClientOriginalExtension();
                $officerPhotoPathleft = $file->storeAs('SuspectLeft', $fileNameleft, 'SuspectLeft');


                $file = $request->file('suspectrightphoto');
                $fileNameright = now()->year . '-' . $request->idcardno .'.'. $savedSuspectId . '.' . $file->getClientOriginalExtension();
                $officerPhotoPathright = $file->storeAs('SuspectRight', $fileNameright, 'SuspectRight');

                Suspectphoto::create([
                    'suspect_id' => $savedSuspectId,
                    'frontside' => $fileNameface,
                    'leftside' => $fileNameleft,
                    'rightside' => $fileNameright,
                    'status' => 1
                ]);
            }

            return [
                'status' => 'success',
                'message' => 'Suspect Information Saved Successfully.',
            ];

        } else {
            $suspects = Suspect::find($request->recordID);

            if ($suspects) {
                $suspects->update([
                    'Keywords' => $keywords,
                    'idcardno' => $request->idcardno,
                    'namewithintial' => $request->namewithintial,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'fullname' => $request->fullname,
                    'aliases' => $request->aliases,
                    'gender' => $request->gender,
                    'officerdob' => $request->officerdob,
                    'age' => $request->suspectage,
                    'nationality' => $request->nationality,
                    'citizenship' => $request->citizen,
                    'contactno' => $request->contactno,
                    'permentaddress' => $request->permentaddress,
                    'officercity' => $request->officercity,
                    'stationid' => $request->arreststationid,
                    'maincategoryid' => $request->crimecategory,
                    'crimeid' => $request->arrestedcrime,
                    'arresteddate' => $request->arrestdate,
                    'updated_by' => Auth::id()
                ]);


                if ($request->hasFile('suspectfrontphoto') && $request->hasFile('suspectleftphoto') && $request->hasFile('suspectrightphoto')) {
                   
                    $file = $request->file('suspectfrontphoto');
                    $fileNameface = now()->year . '-' . $request->idcardno . '.' . $request->recordID . '.' . $file->getClientOriginalExtension();
                    $officerPhotoPathface = $file->storeAs('SuspectFace', $fileNameface, 'SuspectFace');
                  
                    $file = $request->file('suspectleftphoto');
                    $fileNameleft = now()->year . '-' . $request->idcardno . '.' . $request->recordID . '.' . $file->getClientOriginalExtension();
                    $officerPhotoPathleft = $file->storeAs('SuspectLeft', $fileNameleft, 'SuspectLeft');
                
                    $file = $request->file('suspectrightphoto');
                    $fileNameright = now()->year . '-' . $request->idcardno . '.' . $request->recordID . '.' . $file->getClientOriginalExtension();
                    $officerPhotoPathright = $file->storeAs('SuspectRight', $fileNameright, 'SuspectRight');
                
                    $suspectPhoto = Suspectphoto::where('suspect_id', $request->recordID)->first();
                
                    if ($suspectPhoto) {

                        $suspectPhoto->update([
                            'frontside' => $fileNameface,
                            'leftside' => $fileNameleft,
                            'rightside' => $fileNameright,
                            'status' => 1
                        ]);
                    } else {
                        Suspectphoto::create([
                            'suspect_id' => $request->recordID,
                            'frontside' => $fileNameface,
                            'leftside' => $fileNameleft,
                            'rightside' => $fileNameright,
                            'status' => 1
                        ]);
                    }
                }

                return [
                    'status' => 'success',
                    'message' => 'Suspect Information Updated Successfully.',
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Failed to save or update Suspect information.',
        ];
    }

    public function updateStatus($requestid, $statusid)

    {
     
        $suspect = Suspect::findOrFail($requestid);
        
        switch ($statusid) {
            case 1:
                $suspect->status = 1;
                $message = 'Suspect Activated Successfully.';
                break;
                
            case 2:
                $suspect->status = 2;
                $message = 'Suspect Deactivated Successfully.';
                break;
                
            default:
                $suspect->status = 3;
                $message = 'Suspect Deleted Successfully.';
                break;
        }
        
        $suspect->updated_by = Auth::id();
        $suspect->save();

        return $message;
    }

}
