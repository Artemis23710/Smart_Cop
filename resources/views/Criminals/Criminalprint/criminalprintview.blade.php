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
                                    <th>Action</th>
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
                                        <td class="text-right">      
                                                <button class="icon-button btn btn-info btn-sm mr-1 report-btn" title="Edit" id="{{ $crimedetail->id }}" data-bs-toggle="tooltip" 
                                                    data-bs-placement="top"><i class="material-icons">edit</i></button>  

                                                <a href="{{ route('divisionsstatus', ['id' => $crimedetail->id, 'status' => 3]) }}"
                                                         onclick="return delete_confirm()" target="_self" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-danger btn-sm mr-1 "> <i class="material-icons">delete</i></a>          
                                        </td>
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
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($courtjudements as $courtjudement)
                                    <tr>
                                        <td>{{ $courtjudement->crimedetail->arrested_date}}</td>
                                        <td>{{ $courtjudement->crimedetail->crime->crime }}</td>
                                        <td>{{ $courtjudement->dateofjudgement }}</td>
                                        <td>{{ $courtjudement->verdict }}</td>
                                        <td>{{ $courtjudement->penelty }}</td>
                                        <td class="text-right">      
                                                <button class="icon-button btn btn-info btn-sm mr-1 judment-btn" title="Edit"id="{{ $courtjudement->id }}" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">edit</i></button>  
                                                <a href="{{ route('divisionsstatus', ['id' => $courtjudement->id, 'status' => 3]) }}" 
                                                    onclick="return delete_confirm()" target="_self" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-danger btn-sm mr-1 "> <i class="material-icons">delete</i></a>          

                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
</div>

{{-- Crime Record details add model --}}
<div class="modal fade" id="reportmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Add Suspect Crime Details</h3>
                <button type="button" class="close modelclosebtn" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <hr style="width:100%; height:1px; background-color:#000;">
            <div class="modal-body">
                <div>
                    <form action="{{ route('criminalviolentstore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4 required">
                                <label class="inputlabel">Incident Location</label>
                                <input type="text" class="form-control" id="incidentlocation" name="incidentlocation"
                                    required>
                            </div>
                            <div class="col-4 required">
                                <label class="inputlabel">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-4 required">
                                <label class="inputlabel">Date Of Incident</label>
                                <input type="date" class="form-control" id="incidentdate" name="incidentdate" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="inputlabel">Incident Description</label>
                            <textarea name="incidentnote" class="form-control" cols="20" rows="5"></textarea>
                        </div>
                        <hr style="width:100%; height:1px; background-color:#000;">
                        <div class="col-12">
                            <label class="inputlabel">Incident Evidences</label>
                            <input class="form-control" type="file" name="incidentevedance">
                        </div>
                        <hr style="width:100%; height:1px; background-color:#000;">
                        <div class="col-12">
                            <label class="inputlabel">Incident Follow Up</label>
                            <textarea name="incidentfalowup" class="form-control" cols="20" rows="5"></textarea>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        </div>
                        @endif
                        <input type="hidden" id="recordID" name="recordID">
                        <hr style="width:100%; height:1px; background-color:#000000;">
                        <div class="modal-footer justify-content-center">
                            @can('User-Create')
                            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                                <i class="fas fa-save"></i>&nbsp;Save Crime Record
                            </button>
                            @endcan

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- curt judgement add model --}}
<div class="modal fade" id="judgementmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Add Suspect's Court Judgement Details</h3>
                <button type="button" class="close modelclosebtn" data-dismiss="modal" aria-hidden="true" >
                    <i class="material-icons">close</i>
                </button>
            </div>
            <hr style="width:100%; height:1px; background-color:#000;">
            <div class="modal-body">
                <form action="{{ route('criminalviolentcrimeverdict') }}" method="POST">
                    @csrf
                    <br>
                    <div class="row">
                        <div class="col-3 required">
                            <label class="inputlabel">Day of Gave Judgment</label>
                            <input type="date" class="form-control" id="datejudgement" name="datejudgement" required>
                        </div>
            
                        <div class="col-3 required">
                            <label class="inputlabel">Verdict</label>
                            
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="judgement" id="judnotconvicted"
                                        value="Not Guilty"><label class="inputlabel" for="judnotconvicted">Not Guilty</label>
                                    <span class="circle"><span class="check"></span></span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="judgement" value="Found Guilty"
                                        id="judconvicted"><label class="inputlabel" for="judconvicted">Found Guilty</label>
                                    <span class="circle"> <span class="check"></span></span>
                                </label>
                            </div>
                            
                            </select>
                        </div>
            
                        <div class="col-6" id="peneltysection">
                            <label class="inputlabel">Penalty</label>
                            <input type="text" class="form-control" id="penelty" name="penelty">
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <label class="inputlabel"> Judgment Summary</label>
                        <textarea name="incidentnote"class="form-control" cols="20" rows="5"></textarea>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                    <input type="hidden" id="suspectID" name="recordID">
                    <input type="hidden" id="crimerecordID" name="crimerecordID" value="1">
                    <hr style="width:100%; height:1px; background-color:#000000;">
                    <div class="modal-footer justify-content-center">
                        @can('User-Create')
                        <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                            <i class="fas fa-save"></i>&nbsp;Save Verdict Record
                        </button>
                        @endcan
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
$(document).ready(function(){

    $("#suspectslink").addClass('active');

    $(document).on('click', '.report-btn', function () {
        var id = $(this).attr('id');
        $('#recordID').val(id);
        $('#reportmodel').modal('show');
    });

    $(document).on('click', '.judment-btn', function () {
        var id = $(this).attr('id');
        $('#suspectID').val(id);
        $('#judgementmodel').modal('show');
    });


});

  document.addEventListener('DOMContentLoaded', function () {
      const divisionSelect = document.getElementById('divisionid');
      const stationSelect = document.getElementById('arreststationid');

      divisionSelect.addEventListener('change', function () {
          const divisionID = this.value;

          if (divisionID) {
              fetch(`/policestations/${divisionID}`)
                  .then(response => response.json())
                  .then(data => {
                      stationSelect.innerHTML = '<option value="">Choose Station</option>';
                      data.forEach(stations => {
                          const option = document.createElement('option');
                          option.value = stations.id;
                          option.textContent = stations.station_name;
                          stationSelect.appendChild(option);
                      });
                      $('.selectpicker').selectpicker('refresh');
                  })
                  .catch(error => console.error('Error fetching districts:', error));
          } else {
              stationSelect.innerHTML = '<option value="">Choose Arrested Police Station</option>';
              $('.selectpicker').selectpicker('refresh');
          }
      });
  });

  document.addEventListener('DOMContentLoaded', function () {
      const categorySelect = document.getElementById('crimecategory');
      const crimeSelect = document.getElementById('arrestedcrime');

      categorySelect.addEventListener('change', function () {
          const maincategoryID = this.value;

          if (maincategoryID) {
              fetch(`/crimelist/${maincategoryID}`)
                  .then(response => response.json())
                  .then(data => {
                    crimeSelect.innerHTML = '<option value="">Choose Crime</option>';
                      data.forEach(crimelist => {
                          const option = document.createElement('option');
                          option.value = crimelist.id;
                          option.textContent = crimelist.crime;
                          crimeSelect.appendChild(option);
                      });
                      $('.selectpicker').selectpicker('refresh');
                  })
                  .catch(error => console.error('Error fetching districts:', error));
          } else {
            crimeSelect.innerHTML = '<option value="">Choose Crime for Arrest</option>';
              $('.selectpicker').selectpicker('refresh');
          }
      });
  });

document.addEventListener('DOMContentLoaded', function () {
    @if(session('message'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('
        message ') }}',
        showConfirmButton: false,
        position: "top-end",
        timer: 1000
    });
    @endif
});
</script>

@endsection