@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.investigation_navbar')
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
                                <h3 class="title-style"><span>Crime And Incident Information</span></h6>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Case No.</label>
                                                <input type="text" class="form-control" id="caseno" name="caseno"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Report Date</label>
                                                <input type="date" class="form-control" id="reportdate"
                                                    name="reportdate" required>
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <div class="form-group required">
                                                <label class="inputlabel">Main Crime Category</label><br>
                                                <select class="selectpicker" data-style="select-with-transition"
                                                    title="Choose Crime Category" name="crimecategory"
                                                    id="crimecategory" required>
                                                    @foreach($maincrimecategory as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->main_crime_category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <div class="form-group required">
                                                <label class="inputlabel">Offence</label><br>
                                                <select class="selectpicker" data-style="select-with-transition"
                                                    title="Choose Offence" name="arrestedcrime" id="arrestedcrime"
                                                    required>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Tilte for Incident</label>
                                                <input type="text" class="form-control" id="incidenttitle"
                                                    name="incidenttitle" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Date Of Incident</label>
                                                <input type="date" class="form-control datepicker" id="incidentdate"
                                                    name="incidentdate" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Incident Location</label>
                                                <input type="text" class="form-control" id="incidentlocation"
                                                    name="incidentlocation" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="inputlabel">Incident Area</label>
                                                <input type="text" class="form-control" id="incidentarea"
                                                    name="incidentarea">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Related Division</label><br>
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
                                                <label class="inputlabel">Related Police Station</label><br>
                                                <select class="selectpicker" data-style="select-with-transition"
                                                    title="Choose Police Station" name="arreststationid"
                                                    id="arreststationid" required>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Investigating Officer</label><br>
                                                <select class="selectpicker" data-style="select-with-transition"
                                                    title="Choose officer" name="officerid" id="officerid" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group required">
                                                <label class="inputlabel">Assign Date</label>
                                                <input type="text" class="form-control" id="officerassigndate"
                                                    name="officerassigndate" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label class="inputlabel">Incident Description</label>
                                            <textarea name="incidentdescription" class="form-control" cols="20"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                            </div>
                        </div>
                         <br><br>
                        <div class="col-12">
                            <h3 class="title-style"><span>Victims Information</span></h6>
                                <div class="row victim-row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="inputlabel">Victim Name</label>
                                            <input type="text" class="form-control" id="victimname" name="victimname">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="inputlabel">Gender</label><br>
                                            <select class="selectpicker" data-style="select-with-transition"
                                                title="Choose  Gender" name="victimgender" id="victimgender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="inputlabel">Victim Age</label>
                                            <input type="text" class="form-control" id="victimname" name="victimname">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <br>
                                        <button type="button" onclick="productDelete(this);"
                                            class="deletebtn btn btn-danger btn-sm " disabled><i
                                                class="fas fa-trash-alt"></i></button>
                                        <button class="addRowBtn btn btn-success btn-sm "><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                        </div>
<br><br>
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

    $("#investigationlink").addClass('active');

    $(document).on('click', '.addRowBtn', function(e) {
            e.preventDefault();
            var clonedRow = $(this).closest('.victim-row').clone(); 
            clonedRow.find('input').val('');
            clonedRow.find('select').val('');
            clonedRow.find('.deletebtn').prop('disabled', false);
            $(this).closest('.victim-row').after(clonedRow);
        });

        // Function to delete row
        $(document).on('click', '.deletebtn', function() {
            if ($('.victim-row').length > 1) {
                $(this).closest('.victim-row').remove();
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
</script>

@endsection