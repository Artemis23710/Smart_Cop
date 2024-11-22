@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.complain_navbar')
    </div>
</div>

<div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('suspectsstore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <h3 class="title-style"><span>Complaint Information</span></h6>
                                  <div class="row">
                                      <div class="col-3">
                                          <div class="form-group required">
                                              <select class="selectpicker" data-style="select-with-transition"
                                                  title="Choose Division" name="divisionid" id="divisionid" required>
                                                  @foreach($policedivisions as $division)
                                                  <option value="{{ $division->id }}">{{ $division->division_name}}
                                                  </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-3">
                                          <div class="form-group required">
                                              <select class="selectpicker" data-style="select-with-transition"
                                                  title="Choose Arrested Police Station" name="arreststationid"
                                                  id="arreststationid" required>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-3">
                                          <div class="form-group required">
                                              <label class="inputlabel">Date of Complaint</label>
                                              <input type="date" class="form-control" id="dateofcomplaint" name="dateofcomplaint" required>
                                          </div>
                                      </div>

                                      <div class="col-3">
                                        <div class="form-group required">
                                            <label class="inputlabel">Type Of Complaint</label>
                                            <input type="text" class="form-control" id="typeofcomplaint" name="typeofcomplaint" required>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-8">
                                        <div class="form-group required">
                                            <label class="inputlabel">Description of Complaint</label>
                                           <textarea name="discription" class="form-control" id="" cols="50" rows="3"></textarea>
                                        </div>
                                    </div>
                                  </div>
                              </div>

                            <div class="col-12">
                                <h3 class="title-style"><span>Person Posted the Complaint Information</span></h6>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Identity Card No</label>
                                                <input type="text" class="form-control" id="idcardno" name="idcardno"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group required">
                                                <label class="inputlabel"> Full Name</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group required">
                                                <label class="inputlabel">Contact No</label>
                                                <input type="text" class="form-control" id="contactno" name="contactno"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel"> Address </label>
                                                <input type="text" class="form-control" id="permentaddress"
                                                    name="permentaddress" required>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info"> <i class="fas fa-save"></i>&nbsp;Save Complaint Information</button>
                        </div>

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

    $("#othercomplainslink").addClass('active');
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