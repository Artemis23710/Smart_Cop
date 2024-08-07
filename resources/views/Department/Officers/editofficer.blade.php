@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.department_navbar')
    </div>
</div>

<div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('offiersstore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-9">
                            <h3 class="title-style"><span>Personal Information</span></h6>
                            <div class="row">
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Identity Card No</label>
                                  <input type="text" class="form-control" id="idcardno" name="idcardno" value="{{ $officerinfo->idcardno}}" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Officer ID</label>
                                  <input type="text" class="form-control" id="officerid" name="officerid" value="{{ $officerinfo->officerid}}" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label  class="inputlabel">Name with Initial</label>
                                  <input type="text" class="form-control" id="namewithintial" name="namewithintial" value="{{ $officerinfo->namewithintial}}" required>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-4">
                                <div class="form-group required">
                                  <label  class="inputlabel">First Name</label>
                                  <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $officerinfo->firstname}}" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group ">
                                  <label  class="inputlabel">Middle Name</label>
                                  <input type="text" class="form-control" id="middlename" name="middlename" value="{{ $officerinfo->middlename}}" >
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Last Name</label>
                                  <input type="text" class="form-control" id="lastname" name="lastname"  value="{{ $officerinfo->lastname}}" required>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-10">
                                <div class="form-group required">
                                  <label class="inputlabel">Officer Full Name</label>
                                  <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $officerinfo->fullname}}" required>
                                </div>
                              </div>

                              <div class="col-2 required">
                                <label class="inputlabel" style="margin-top:10px;">Gender</label>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" {{ $officerinfo->gender == 'Male' ? 'checked' : '' }} > <b class="inputlabel">Male</b> 
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" {{ $officerinfo->gender == 'Female' ? 'checked' : '' }} > <b class="inputlabel">Female</b>
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Date Of Birth</label>
                                  <input type="date" class="form-control datepicker" id="officerdob" name="officerdob" value="{{ $officerinfo->officerdob}}" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Contact No</label>
                                  <input type="text" class="form-control" id="contactno" name="contactno" value="{{ $officerinfo->contactno}}" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group">
                                  <label class="inputlabel">Officer Email</label>
                                  <input type="email" class="form-control" id="officeremail" name="officeremail" value="{{ $officerinfo->officeremail}}">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="form-group required">
                                  <label class="inputlabel">Employee Permanent Address </label>
                                  <input type="text" class="form-control" id="permentaddress" name="permentaddress" value="{{ $officerinfo->permentaddress}}" required>
                                </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <label class="inputlabel">City</label>
                                  <input type="text" class="form-control" id="officercity" name="officercity" value="{{ $officerinfo->officercity}}" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group">
                                  <label class="inputlabel">Employee Temporary Address </label>
                                  <input type="text" class="form-control" id="temporyaddress" name="temporyaddress" value="{{ $officerinfo->temporyaddress}}">
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="col-3" >
                            <div class="row">
                              <div class="col-sm-4">
                                <label id="officerphoto">
                                  @if ($officerphoto && $officerphoto->photourl)
                                  <!-- Display the current officer's image -->
                                  <img src="{{ asset('storage/Photos/' . $officerphoto->photourl) }}" id="officerimg" name="officerimg" alt="Current Officer Image" />
                                  @else
                                      <!-- Display a default image -->
                                      <img src="{{ asset('Images/default.jpg') }}" id="officerimg" name="officerimg" alt="Default Officer Image" />
                                  @endif
                                  <input type="file" id="imageofficerupload" accept="image/*" name="officerphoto" onchange="previewImage(event)">
                                </label>
                              </div>
                            </div>    
                          </div>
                        </div>
                         <br><br>
                        <div class="col-12">
                          <h3 class="title-style"><span>Service Information</span></h6>

                            <div class="row">
                              <div class="col-3">
                                <div class="form-group required">
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Division" name="divisionid" id="divisionid" >
                                    @foreach($policedivisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->division_name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Station" name="stationid" id="stationid" required>
                                    @foreach($stations as $station)
                                    <option value="{{ $station->id }}" {{ $station->id == $officerinfo->stationid ? 'selected' : '' }}>{{ $station->station_name}}</option>
                                @endforeach
                                  </select>
                              </div>
                              </div>
                              <div class="col-3 ">
                                <div class="form-group required">
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Rank" name="rankid" id="rankid" required>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->id }}" {{ $rank->id == $officerinfo->rankid ? 'selected' : '' }}>{{ $rank->Rank_name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <label class="inputlabel">Officer Join Service Date</label>
                                  <input type="date" class="form-control" id="joinservicedate" name="joinservicedate" value="{{ $officerinfo->joinservicedate}}" required>
                                </div>
                              </div>
                            </div>

                           <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                  <label class="inputlabel">Officer Resign Date</label>
                                  <input type="date" class="form-control" id="resignationdate" name="resignationdate" value="{{ $officerinfo->resignationdate}}">
                                </div>
                            </div>
                           </div>
                        </div>

                        @can('Officer-Create')
                            <div class="col-12 d-flex align-items-center justify-content-center">
                              <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                              <i class="fas fa-save"></i>&nbsp;Save Officer Information</button>
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
                          <input type="hidden" id="recordID" name="recordID" value="{{ $officerinfo->id}}" >
                        </form>
                </div>
            </div>
        </div>
</div>

@endsection
@section('script')

<script>
$(document).ready(function(){

    $("#officerslink").addClass('active');

    // validate user enterd id card no with database
    $('#idcardno').on('blur', function () {
        var idcardno = $(this).val();
        $.ajax({
            url: '{{ route("checkidcardavalibility") }}',
            method: 'POST',
            data: {
                idcardno: idcardno,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.exists) {
                    $('#idcardno').addClass('is-invalid');
                    $('#idcardno-feedback').text('ID card number already exists.');
                    $('#btnsubmituser').prop('disabled', true);
                } else {
                    $('#idcardno').removeClass('is-invalid');
                    $('#idcardno').addClass('is-valid');
                    $('#idcardno-feedback').text('ID card number is available.');
                    $('#btnsubmituser').prop('disabled', false);
                }
            }
        });
    });

    // validate user entered officerid with database
    $('#officerid').on('blur', function () {
        var officerid = $(this).val();
        $.ajax({
            url: '{{ route("checkofficeridavalibility") }}',
            method: 'POST',
            data: {
                officerid: officerid,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.exists) {
                    $('#officerid').addClass('is-invalid');
                    $('#officerid-feedback').text('Officer ID already exists.');
                    $('#btnsubmituser').prop('disabled', true);
                } else {
                    $('#officerid').removeClass('is-invalid');
                    $('#officerid').addClass('is-valid');
                    $('#officerid-feedback').text('Officer ID is available.');
                    $('#btnsubmituser').prop('disabled', false);
                }
            }
        });
    });

    $('#officerForm').on('submit', function (e) {
        if ($('#idcardno').hasClass('is-invalid') || $('#officerid').hasClass('is-invalid')) {
            e.preventDefault();
            alert('Please fix the errors before submitting.');
        }
    });


});

  document.addEventListener('DOMContentLoaded', function () {
      const divisionSelect = document.getElementById('divisionid');
      const stationSelect = document.getElementById('stationid');

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
              stationSelect.innerHTML = '<option value="">Choose Station</option>';
              $('.selectpicker').selectpicker('refresh');
          }
      });
  });

document.addEventListener('DOMContentLoaded', function () {
    @if(session('message'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('message') }}',
        showConfirmButton: false,
        position: "top-end",
        timer: 1000
    });
    @endif
});

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('officerimg').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection