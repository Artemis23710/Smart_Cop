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
                    <form action="{{ route('suspectsstore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label id="suspectfrontphoto" class="suspect-photo"> Front Side
                                            @if ($suspectphoto && $suspectphoto->frontside)
                                            <img src="{{ asset('storage/Photos/SuspectFace/' . $suspectphoto->frontside) }}" id="suspectfrontimg" name="suspectfrontimg" alt="Suspect Front Side Image" />
                                            @else
                                            <img src="{{ asset('Images/frontside.png') }}" id="suspectfrontimg" name="suspectfrontimg" alt="Suspect Front Side Image" />
                                            @endif
                                            <input type="file" id="imageofficerupload" accept="image/*" name="suspectfrontphoto"
                                                onchange="previewImagefront(event)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label id="suspectleftphoto" class="suspect-photo"> Left Side
                                            @if ($suspectphoto && $suspectphoto->leftside)
                                            <img src="{{ asset('storage/Photos/SuspectLeft/' . $suspectphoto->leftside) }}" id="suspectleftimg" name="suspectleftimg" alt="Suspect Left Side Image" />
                                            @else
                                            <img src="{{ asset('Images/leftside.png') }}" id="suspectleftimg" name="suspectleftimg" alt="Suspect Left Side Image" />
                                            @endif
                                            <input type="file" id="imageofficerupload" accept="image/*" name="suspectleftphoto"
                                                onchange="previewImageleft(event)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label id="suspectrightphoto" class="suspect-photo"> Right Side
                                            @if ($suspectphoto && $suspectphoto->rightside)
                                            <img src="{{ asset('storage/Photos/SuspectRight/' . $suspectphoto->rightside) }}" id="suspectrightimg" name="suspectrightimg" alt="Suspect Right Side Image" />
                                            @else
                                            <img src="{{ asset('Images/right.jpg') }}" id="suspectrightimg" name="suspectrightimg" alt="Suspect Right Side Image" />
                                            @endif
                                            <input type="file" id="imageofficerupload" accept="image/*" name="suspectrightphoto"
                                                onchange="previewImageright(event)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3 class="title-style"><span>Suspect Personal Information</span></h6>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Identity Card No</label>
                                                <input type="text" class="form-control" id="idcardno" name="idcardno" value="{{ $suspectinfo->idcardno}}"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $suspectinfo->firstname}}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group ">
                                                <label class="inputlabel">Middle Name</label>
                                                <input type="text" class="form-control" id="middlename" name="middlename" value="{{ $suspectinfo->middlename}}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $suspectinfo->lastname}}"
                                                    required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Name with Initial</label>
                                                <input type="text" class="form-control" id="namewithintial" value="{{ $suspectinfo->namewithintial}}"
                                                    name="namewithintial" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group required">
                                                <label class="inputlabel">Suspect Full Name</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $suspectinfo->fullname}}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="inputlabel">Aliases</label>
                                                <input type="text" class="form-control" id="aliases" name="aliases" value="{{ $suspectinfo->aliases}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3 required">
                                            <label class="inputlabel" style="margin-top:10px;">Gender</label>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender" value="Male" {{ $suspectinfo->gender == 'Male' ? 'checked' : '' }}>
                                                    <b class="inputlabel">Male</b>
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                    value="Female" {{ $suspectinfo->gender == 'Female' ? 'checked' : '' }} > <b class="inputlabel">Female</b>
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Date Of Birth</label>
                                                <input type="date" class="form-control datepicker" id="officerdob" value="{{ $suspectinfo->officerdob}}"
                                                    name="officerdob" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Age</label>
                                                <input type="number" class="form-control" id="suspectage" name="suspectage" value="{{ $suspectinfo->age}}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Nationality</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $suspectinfo->nationality}}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3 required">
                                            <label class="inputlabel" style="margin-top:10px;">Citizen</label>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="citizen" value="Yes" {{ $suspectinfo->citizenship == 'Yes' ? 'checked' : '' }}>
                                                    <b class="inputlabel">Yes</b>
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="citizen" value="No" {{ $suspectinfo->citizenship == 'No' ? 'checked' : '' }}>
                                                    <b class="inputlabel">No</b>
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group required">
                                                <label class="inputlabel">Contact No</label>
                                                <input type="text" class="form-control" id="contactno" name="contactno" value="{{ $suspectinfo->contactno}}"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group required">
                                                <label class="inputlabel">Suspect Address </label>
                                                <input type="text" class="form-control" id="permentaddress" value="{{ $suspectinfo->permentaddress}}"
                                                    name="permentaddress" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">City</label>
                                                <input type="text" class="form-control" id="officercity" name="officercity" value="{{ $suspectinfo->officercity}}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                         <br><br>
                        <div class="col-12">
                          <h3 class="title-style"><span>Suspect Arrested Information</span></h6>
                            <div class="row">
                                <div class="col-3 ">
                                    <div class="form-group required">
                                      <select class="selectpicker" data-style="select-with-transition"  title="Choose Crime Category" name="crimecategory" id="crimecategory" required>
                                        @foreach($maincrimecategory as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $suspectinfo->maincategoryid ? 'selected' : '' }}>{{ $category->main_crime_category}}</option>
                                    @endforeach
                                      </select>
                                  </div>
                                  </div>

                                  <div class="col-3 ">
                                    <div class="form-group required">
                                      <select class="selectpicker" data-style="select-with-transition"  title="Choose Crime for Arrest" name="arrestedcrime" id="arrestedcrime" required>
                                     
                                      </select>
                                  </div>
                                  </div>

                              <div class="col-3">
                                <div class="form-group required">
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Division" name="divisionid" id="divisionid" required>
                                    @foreach($policedivisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->division_name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Arrested Police Station" name="arreststationid" id="arreststationid" required>
                                    @foreach($stations as $station)
                                    <option value="{{ $station->id }}" {{ $station->id == $suspectinfo->stationid ? 'selected' : '' }}>{{ $station->station_name}}</option>
                                @endforeach  
                                </select>
                              </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <label class="inputlabel">Arrest Date</label>
                                  <input type="date" class="form-control" id="arrestdate" name="arrestdate" required value="{{ $suspectinfo->arresteddate}}">
                                </div>
                              </div>
                            </div>
                        </div>

                        @can('Suspect-Create')
                            <div class="col-12 d-flex align-items-center justify-content-center">
                              <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                              <i class="fas fa-save"></i>&nbsp;Save Suspect Information</button>
                          </div>
                        @endcan

                          @if ($errors->any())
                              <div class="alert alert-danger">
                                      @foreach ($errors->all() as $error)
                                        {{ $error }}
                                      @endforeach
                              </div>
                          @endif
                          <input type="hidden" id="hiddenid" name="hiddenid" value="2">
                          <input type="hidden" id="recordID" name="recordID" value="{{ $suspectinfo->id}}">
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

    // validate user enterd id card no with database
    // $('#idcardno').on('blur', function () {
    //     var idcardno = $(this).val();
    //     $.ajax({
    //         url: '{{ route("checkidcardavalibility") }}',
    //         method: 'POST',
    //         data: {
    //             idcardno: idcardno,
    //             _token: '{{ csrf_token() }}'
    //         },
    //         success: function (response) {
    //             if (response.exists) {
    //                 $('#idcardno').addClass('is-invalid');
    //                 $('#idcardno-feedback').text('ID card number already exists.');
    //                 $('#btnsubmituser').prop('disabled', true);
    //             } else {
    //                 $('#idcardno').removeClass('is-invalid');
    //                 $('#idcardno').addClass('is-valid');
    //                 $('#idcardno-feedback').text('ID card number is available.');
    //                 $('#btnsubmituser').prop('disabled', false);
    //             }
    //         }
    //     });
    // });

    // validate user entered officerid with database
  

    $('#officerForm').on('submit', function (e) {
        if ($('#idcardno').hasClass('is-invalid') || $('#officerid').hasClass('is-invalid')) {
            e.preventDefault();
            alert('Please fix the errors before submitting.');
        }
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

function previewImagefront(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('suspectfrontimg').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
function previewImageleft(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('suspectleftimg').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
function previewImageright(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('suspectrightimg').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection