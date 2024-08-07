<?php

namespace App\Services;

use App\Models\Officers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Officerprofilephoto;

class OfficerService
{
    
    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'idcardno' => 'required|string|max:255',
            'officerid' => 'required|string|max:255',
            'namewithintial' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'officerdob' => 'required|date',
            'contactno' => 'required|string|max:15',
            'officeremail' => 'nullable|email|max:255',
            'permentaddress' => 'required|string|max:255',
            'officercity' => 'required|string|max:255',
            'temporyaddress' => 'nullable|string|max:255',
            'stationid' => 'required|integer',
            'rankid' => 'required|integer',
            'joinservicedate' => 'required|date',
            'resignationdate' => 'nullable|date',
            'officerphoto' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        $keywords = $request->idcardno . ' ' . $request->officerid . ' ' . $request->firstname . ' ' . $request->middlename . ' ' . $request->lastname;

        if ($request->hiddenid == 1) {
            $officer = Officers::create([
                'Keywords' => $keywords,
                'idcardno' => $request->idcardno,
                'officerid' => $request->officerid,
                'namewithintial' => $request->namewithintial,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'fullname' => $request->fullname,
                'gender' => $request->gender,
                'officerdob' => $request->officerdob,
                'contactno' => $request->contactno,
                'officeremail' => $request->officeremail,
                'permentaddress' => $request->permentaddress,
                'officercity' => $request->officercity,
                'temporyaddress' => $request->temporyaddress,
                'joinservicedate' => $request->joinservicedate,
                'resignationdate' => $request->resignationdate,
                'stationid' => $request->stationid,
                'rankid' => $request->rankid,
                'status' => 1,
                'created_by' => Auth::id(),
                'updated_by' => 0
            ]);

            $savedOfficerId = $officer->id;

            if ($request->hasFile('officerphoto')) {
                $file = $request->file('officerphoto');
                $fileName = now()->year . '-' . $request->officerid . '.' . $file->getClientOriginalExtension();
                $officerPhotoPath = $file->storeAs('Officers', $fileName, 'Officers');

                Officerprofilephoto::create([
                    'officer_id' => $savedOfficerId,
                    'photourl' => $officerPhotoPath,
                    'status' => 1
                ]);
            }

            return [
                'status' => 'success',
                'message' => 'Officer Information Saved Successfully.',
            ];
        } else {
            $policeofficers = Officers::find($request->recordID);
            if ($policeofficers) {
                $policeofficers->update([
                    'Keywords' => $keywords,
                    'idcardno' => $request->idcardno,
                    'officerid' => $request->officerid,
                    'namewithintial' => $request->namewithintial,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'fullname' => $request->fullname,
                    'gender' => $request->gender,
                    'officerdob' => $request->officerdob,
                    'contactno' => $request->contactno,
                    'officeremail' => $request->officeremail,
                    'permentaddress' => $request->permentaddress,
                    'officercity' => $request->officercity,
                    'temporyaddress' => $request->temporyaddress,
                    'joinservicedate' => $request->joinservicedate,
                    'resignationdate' => $request->resignationdate,
                    'stationid' => $request->stationid,
                    'rankid' => $request->rankid,
                    'updated_by' => Auth::id()
                ]);

                if ($request->hasFile('officerphoto')) {
                    $file = $request->file('officerphoto');
                    $fileName = now()->year . '-' . $request->officerid . '.' . $file->getClientOriginalExtension();
                    $officerPhotoPath = $file->storeAs('Officers', $fileName, 'Officers');

                    $officerPhoto = Officerprofilephoto::where('officer_id', $request->recordID)->first();
                    if ($officerPhoto) {
                        $officerPhoto->update([
                            'photourl' => $officerPhotoPath,
                            'status' => 1
                        ]);
                    } else {
                        Officerprofilephoto::create([
                            'officer_id' => $request->recordID,
                            'photourl' => $officerPhotoPath,
                            'status' => 1
                        ]);
                    }
                }
                return [
                    'status' => 'success',
                    'message' => 'Officer Information Updated Successfully.',
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Failed to save or update officer information.',
        ];
    }

    public function updateStatus($requestid, $statusid)

    {
     
        $officer = Officers::findOrFail($requestid);
        
        switch ($statusid) {
            case 1:
                $officer->status = 1;
                $message = 'Officer Activated Successfully.';
                break;
                
            case 2:
                $officer->status = 2;
                $message = 'Officer Deactivated Successfully.';
                break;
                
            default:
                $officer->status = 3;
                $message = 'Officer Deleted Successfully.';
                break;
        }
        
        $officer->updated_by = Auth::id();
        $officer->save();

        return $message;
    }

    public function createOfficerLogin($request)
        {
            $validator = Validator::make($request->all(), [
                'accountname' => 'required|string|max:255',
                'useremail' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed',
                'roleid' => 'required|exists:roles,id',
                'recordID' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::create([
                'emp_id' => $request->input('recordID'),
                'role_id' => $request->input('roleid'),
                'name' => $request->input('accountname'),
                'email' => $request->input('useremail'),
                'password' => Hash::make($request->input('password')),
                'status' => 1,
                'created_by' => Auth::id(),
                'update_by' => 0
            ]);

            $role = Role::findById($request->input('roleid'));
            $user->assignRole($role);

            return 'Officer User Access successfully created.';
        }
}
