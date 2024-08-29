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
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                              <th>Suspect Name</th>
                              <th>NIC</th>
                              <th>Crime</th>
                              <th>Arrested Station</th>
                              <th>Arrested Date</th>
                              <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
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
                                <label class="inputlabel">Arrested Crime</label>
                                <select class="selectpicker" data-style="select-with-transition" title="Arrested Crime"
                                    name="arretedcrime" id="arretedcrime" required>
                                    @foreach($crimelist as $crimel)
                                    <option value="{{ $crimel->id }}">{{$crimel->crime}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 required">
                                <label class="inputlabel">Arrested Date</label>
                                <input type="date" class="form-control" id="arresteddate" name="arresteddate">
                            </div>
                            <div class="col-4 required">
                                <label class="inputlabel">Arrested Station</label>
                                <select class="selectpicker" data-style="select-with-transition"
                                    title="Arrested Station" name="arrestedstation" id="arrestedstation" readonly>
                                    @foreach($stationlist as $station)
                                    <option value="{{ $station->id }}">{{$station->station_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                    <div class="row">
                        <div class="col-4 required">
                            <label class="inputlabel">Arrested Crime</label>
                            <select class="selectpicker" data-style="select-with-transition" title="Arrested Crime" name="arrestedcrime" id="arrestedcrime" required>
                                @foreach($crimelist as $crimel)
                                <option value="{{ $crimel->id }}">{{$crimel->crime}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-4 required">
                            <label class="inputlabel">Arrested Date</label>
                            <input type="date" class="form-control" id="arresteddate" name="arresteddate" required>
                        </div>
                        <div class="col-4 required">
                            <label class="inputlabel">Arrested Station</label>
                            <select class="selectpicker" data-style="select-with-transition" title="Arrested Station" name="arrestedpolice" id="arrestedpolice" required>
                                @foreach($stationlist as $station)
                                <option value="{{ $station->id }}">{{$station->station_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
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
$(document).ready(function () {

    $("#violentlink").addClass('active');
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
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('showviolentcriminal') }}",
        columns: [{
                data: 'namewithintial',
                name: 'namewithintial'
            },
            {
                data: 'idcardno',
                name: 'idcardno'
            },
            {
                data: 'crimecategory',
                name: 'crimecategory'
            },
            {
                data: 'station',
                name: 'station'
            },
            {
                data: 'arresteddate',
                name: 'arresteddate'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-right'
            }
        ]
    });


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

document.addEventListener("DOMContentLoaded", function() {
    const penaltySection = document.getElementById("peneltysection");
    const guiltyRadio = document.getElementById("judconvicted");
    const notGuiltyRadio = document.getElementById("judnotconvicted");

    function togglePenaltySection() {
        if (guiltyRadio.checked) {
            penaltySection.style.display = "block";
        } else {
            penaltySection.style.display = "none";
        }
    }

    guiltyRadio.addEventListener("change", togglePenaltySection);
    notGuiltyRadio.addEventListener("change", togglePenaltySection);

    // Initial check
    togglePenaltySection();
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

    document.addEventListener('click', function (event) {
        if (event.target.closest('.delete-btn')) {
            var deleteButton = event.target.closest('.delete-btn');
            var officerId = deleteButton.getAttribute('data-id');

            Swal.fire({
                title: 'Are you want to Delete this Record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ url("suspectstatus") }}/' + officerId + '/3';
                }
            });
        }
    });
});
</script>

@endsection