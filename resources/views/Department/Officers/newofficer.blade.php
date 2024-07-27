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
                    <form action="" method="POST" >
                        @csrf
                        <div class="row">
                          <div class="col-9">
                            <h3 class="title-style"><span>Personal Information</span></h6>
                            <div class="row">
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Identity Card No</label>
                                  <input type="text" class="form-control" id="idcardno" name="idcardno" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Officer ID</label>
                                  <input type="text" class="form-control" id="officerid" name="officerid" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label  class="inputlabel">Name with Initial</label>
                                  <input type="text" class="form-control" id="namewithintial" name="namewithintial" required>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-4">
                                <div class="form-group required">
                                  <label  class="inputlabel">First Name</label>
                                  <input type="text" class="form-control" id="firstname" name="firstname" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group ">
                                  <label  class="inputlabel">Middle Name</label>
                                  <input type="text" class="form-control" id="middlename" name="middlename" >
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Last Name</label>
                                  <input type="text" class="form-control" id="lastname" name="lastname" required>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-10">
                                <div class="form-group required">
                                  <label class="inputlabel">Officer Full Name</label>
                                  <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>
                              </div>

                              <div class="col-2 required">
                                <label class="inputlabel" style="margin-top:10px;">Gender</label>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" > <b class="inputlabel">Male</b> 
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" > <b class="inputlabel">Female</b>
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
                                  <input type="date" class="form-control datepicker" id="officerdob" name="officerdob" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group required">
                                  <label class="inputlabel">Contact No</label>
                                  <input type="text" class="form-control" id="contactno" name="contactno" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group">
                                  <label class="inputlabel">Officer Email</label>
                                  <input type="email" class="form-control" id="contactno" name="contactno">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="form-group required">
                                  <label class="inputlabel">Employee Permanent Address </label>
                                  <input type="text" class="form-control" id="permentaddress" name="permentaddress" required>
                                </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <label class="inputlabel">City</label>
                                  <input type="text" class="form-control" id="officercity" name="officercity" required>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group">
                                  <label class="inputlabel">Employee Temporary Address </label>
                                  <input type="text" class="form-control" id="temporyaddress" name="temporyaddress">
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="col-3" >
                            <div class="row">
                              <div class="col-sm-4">
                                <label id="officerphoto">
                                  <img src="{{ asset('Images/marc.jpg') }}" id="officerimg" alt="Current Officer Image" />
                                  <input type="file" id="imageofficerupload" accept="image/*" onchange="previewImage(event)">
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
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Division" name="divisionid" id="divisionid" required>
                                  </select>
                              </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Station" name="stationid" id="stationid" required>
                                  </select>
                              </div>
                              </div>
                              <div class="col-3 ">
                                <div class="form-group required">
                                  <select class="selectpicker" data-style="select-with-transition"  title="Choose Rank" name="rankid" id="rankid" required>
                                  </select>
                              </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group required">
                                  <label class="inputlabel">Officer Join Service Date</label>
                                  <input type="date" class="form-control" id="joinservicedate" name="joinservicedate" required>
                                </div>
                              </div>
                            </div>

                           <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                  <label class="inputlabel">Officer Resign Date</label>
                                  <input type="date" class="form-control" id="resignationdate" name="resignationdate">
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
                          <input type="hidden" id="hiddenid" name="hiddenid" value="1">
                          <input type="hidden" id="recordID" name="recordID">
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
    
    var table = $('#datatable').DataTable();
    $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
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
        reader.onload = function(e) {
          document.getElementById('officerimg').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
</script>

@endsection