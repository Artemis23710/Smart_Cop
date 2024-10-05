@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.criminals_navbar')
    </div>
</div>

<div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label id="suspectfrontphoto" class="suspect-photo"> Front Side
                                            @if ($suspectphoto && $suspectphoto->frontside)
                                            <img src="{{ asset('storage/Photos/SuspectFace/' . $suspectphoto->frontside) }}"
                                                id="suspectfrontimg" name="suspectfrontimg"
                                                alt="Suspect Front Side Image" />
                                            @else
                                            <img src="{{ asset('Images/frontside.png') }}" id="suspectfrontimg"
                                                name="suspectfrontimg" alt="Suspect Front Side Image" />
                                            @endif
                                            <input type="file" id="imageofficerupload" accept="image/*"
                                                name="suspectfrontphoto" disabled>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label id="suspectleftphoto" class="suspect-photo"> Left Side
                                            @if ($suspectphoto && $suspectphoto->leftside)
                                            <img src="{{ asset('storage/Photos/SuspectLeft/' . $suspectphoto->leftside) }}"
                                                id="suspectleftimg" name="suspectleftimg"
                                                alt="Suspect Left Side Image" />
                                            @else
                                            <img src="{{ asset('Images/leftside.png') }}" id="suspectleftimg"
                                                name="suspectleftimg" alt="Suspect Left Side Image" />
                                            @endif
                                            <input type="file" id="imageofficerupload" accept="image/*"
                                                name="suspectleftphoto" disabled>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label id="suspectrightphoto" class="suspect-photo"> Right Side
                                            @if ($suspectphoto && $suspectphoto->rightside)
                                            <img src="{{ asset('storage/Photos/SuspectRight/' . $suspectphoto->rightside) }}"
                                                id="suspectrightimg" name="suspectrightimg"
                                                alt="Suspect Right Side Image" />
                                            @else
                                            <img src="{{ asset('Images/right.jpg') }}" id="suspectrightimg"
                                                name="suspectrightimg" alt="Suspect Right Side Image" />
                                            @endif
                                            <input type="file" id="imageofficerupload" accept="image/*"
                                                name="suspectrightphoto" disabled>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3 class="title-style"><span>Suspect Personal Information</span></h6>
                                    <di v class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="inputlabel">Identity Card No</label>
                                                <input type="text" class="form-control" id="idcardno" name="idcardno"
                                                    value="{{ $suspectinfo->idcardno}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="inputlabel">First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname"
                                                    value="{{ $suspectinfo->firstname}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label class="inputlabel">Middle Name</label>
                                                <input type="text" class="form-control" id="middlename"
                                                    name="middlename" value="{{ $suspectinfo->middlename}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="inputlabel">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname"
                                                    value="{{ $suspectinfo->lastname}}" disabled>
                                            </div>
                                        </div>

                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Name with Initial</label>
                                        <input type="text" class="form-control" id="namewithintial"
                                            value="{{ $suspectinfo->namewithintial}}" name="namewithintial" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="inputlabel">Suspect Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            value="{{ $suspectinfo->fullname}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Aliases</label>
                                        <input type="text" class="form-control" id="aliases" name="aliases"
                                            value="{{ $suspectinfo->aliases}}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label class="inputlabel" style="margin-top:10px;">Gender</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="gender" value="Male"
                                                {{ $suspectinfo->gender == 'Male' ? 'checked' : '' }} disabled>
                                            <b class="inputlabel">Male</b>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="gender" value="Female"
                                                {{ $suspectinfo->gender == 'Female' ? 'checked' : '' }}> <b
                                                class="inputlabel" disabled>Female</b>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group ">
                                        <label class="inputlabel">Date Of Birth</label>
                                        <input type="date" class="form-control datepicker" id="officerdob"
                                            value="{{ $suspectinfo->officerdob}}" name="officerdob" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Age</label>
                                        <input type="number" class="form-control" id="suspectage" name="suspectage"
                                            value="{{ $suspectinfo->age}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Nationality</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality"
                                            value="{{ $suspectinfo->nationality}}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label class="inputlabel" style="margin-top:10px;">Citizen</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="citizen" value="Yes"
                                                {{ $suspectinfo->citizenship == 'Yes' ? 'checked' : '' }} disabled>
                                            <b class="inputlabel">Yes</b>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="citizen" value="No"
                                                {{ $suspectinfo->citizenship == 'No' ? 'checked' : '' }} disabled>
                                            <b class="inputlabel">No</b>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label class="inputlabel">Contact No</label>
                                        <input type="text" class="form-control" id="contactno" name="contactno"
                                            value="{{ $suspectinfo->contactno}}" disabled>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="inputlabel">Suspect Address </label>
                                        <input type="text" class="form-control" id="permentaddress"
                                            value="{{ $suspectinfo->permentaddress}}" name="permentaddress" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">City</label>
                                        <input type="text" class="form-control" id="officercity" name="officercity"
                                            value="{{ $suspectinfo->officercity}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <br><br>
                        <div class="col-12">
                            <h3 class="title-style"><span>Suspect Arrested Information</span></h3>
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <th>Arrested Date</th>
                                    <th>Arrested Offense</th>
                                    <th>Arrested Station</th>
                                    <th>Offense Location</th>
                                    <th>City</th>
                                    <th>Offense Date</th>
                                </thead>
                                <tbody>
                                    @foreach($crimedetails as $crimedetail)
                                    <tr>
                                        <td>{{ $crimedetail->arrested_date}}</td>
                                        <td>{{ $crimedetail->crime->crime }}</td>
                                        <td>{{ $crimedetail->station->station_name }}</td>
                                        <td>{{ $crimedetail->incident_location }}</td>
                                        <td>{{ $crimedetail->incident_city }}</td>
                                        <td>{{ $crimedetail->dateofincident }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <br><br>
                        <div class="col-12">
                            <h3 class="title-style"><span>Suspect's Court Judgements Details</span></h3>
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <th>Arrested Date</th>
                                    <th>Arrested Offense</th>
                                    <th>Date of gave Judgement</th>
                                    <th>Verdict</th>
                                    <th>Penalty</th>
                                </thead>
                                <tbody>
                                    @foreach($courtjudements as $courtjudement)
                                    <tr>
                                        <td>{{ $courtjudement->crimedetail->arrested_date}}</td>
                                        <td>{{ $courtjudement->crimedetail->crime->crime }}</td>
                                        <td>{{ $courtjudement->dateofjudgement }}</td>
                                        <td>{{ $courtjudement->verdict }}</td>
                                        <td>{{ $courtjudement->penelty }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
</div>

@endsection
@section('script')

<script>
$(document).ready(function(){
});
    
</script>

@endsection