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
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                              <th>Case No</th>
                              <th>Crime Category</th>
                              <th>Crime</th>
                              <th>Title Incident</th>
                              <th>Incident Date</th>
                              <th>Incident Location</th>
                              <th>Incident Area</th>
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


{{-- Crime Investigation Note add model --}}

<div class="modal fade" id="reportmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Add Crime Investigation Note</h3>
                <button type="button" class="close modelclosebtn" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <hr style="width:100%; height:1px; background-color:#000;">
            <div class="modal-body">
                <div>
                    <form action="{{ route('saveinvestigationnote') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-5 required">
                                <label class="inputlabel">Investigation Note Tilte</label>
                                <input type="text" class="form-control" id="notetitle" name="notetitle" required>
                            </div>
                            <div class="col-4 required">
                                <label class="inputlabel">Date Of Investigation Note</label>
                                <input type="date" class="form-control" id="notedate" name="notedate" required>
                            </div>
                            <div class="col-3">
                                <label class="inputlabel">Related Location</label>
                                <input type="text" class="form-control" id="relatedlocation" name="relatedlocation">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="inputlabel">Investigation Description</label>
                            <textarea name="investigtionnote" id="investigtionnote" class="form-control" cols="20"
                                rows="5"></textarea>
                        </div>

                        <hr style="width:100%; height:1px; background-color:#000;">

                        <div class="row victim-row">
                            <div class="col-4">
                                <label class="inputlabel">Evidences</label>
                                <input class="form-control" type="file" name="incidentevidance[]" id="incidentevidance">
                            </div>
                            <div class="col-3">
                                <label class="inputlabel">Evidences Title</label>
                                <input class="form-control" type="text" name="evidancetitle[]" id="evidancetitle">
                            </div>
                            <div class="col-3">
                                <label class="inputlabel">Evidences Description</label>
                                <input class="form-control" type="text" name="evidancediscrption[]"
                                    id="evidancediscrption">
                            </div>
                            <div class="col-2">
                                <button type="button" onclick="productDelete(this);"
                                    class="deletebtn btn btn-danger btn-sm " disabled>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button class="addRowBtn btn btn-success btn-sm ">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
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

                            @can('Investigation-Crime-Note-Add')
                            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                                <i class="fas fa-save"></i>&nbsp;Save Investigation Note
                            </button>
                            @endcan

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Investigation Close add model --}}
<div class="modal fade" id="judgementmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Closing Criminal Investigation</h3>
                <button type="button" class="close modelclosebtn" data-dismiss="modal" aria-hidden="true" >
                    <i class="material-icons">close</i>
                </button>
            </div>
            <hr style="width:100%; height:1px; background-color:#000;">
            <div class="modal-body">
                <form action="{{ route('saveinvestigationclose') }}" method="POST">
                    @csrf
                    <br>

                    <div class="row">
                        <div class="col-5 required">
                            <label class="inputlabel">Day of Closing Investigation</label>
                            <input type="date" class="form-control" id="dateclosing" name="dateclosing" required>
                        </div>
                        <div class="col-7 required">
                            <label class="inputlabel">Reason for Closing Investigation</label>
                            <input type="text" class="form-control" id="reason" name="reason" required>
                        </div>
                    </div>

                    <br>

                    <div class="col-12">
                        <label class="inputlabel"> Closing Summary</label>
                        <textarea name="closingnote" id="closingnote" class="form-control" cols="20" rows="5"></textarea>
                    </div>


                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif

                    <input type="hidden" id="investigtionID" name="investigtionID">

                    <hr style="width:100%; height:1px; background-color:#000000;">
                    <div class="modal-footer justify-content-center">
                        @can('Investigation-Closing-Add')
                        <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                            <i class="fas fa-save"></i>&nbsp;Close Investigation 
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

    $("#ongoinginvetigationlink").addClass('active');

    $('#datatable').DataTable();
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
        ajax: "{{ route('showongoinginvestigations') }}",
        columns: [{
                data: 'case_no',
                name: 'case_no'
            },
            {
                data: 'crimemain',
                name: 'crimemain'
            },
            {
                data: 'crime',
                name: 'crime'
            },
            {
                data: 'title_incident',
                name: 'title_incident'
            },
            {
                data: 'incident_date',
                name: 'incident_date'
            },
            {
                data: 'incident_location',
                name: 'incident_location'
            },
            {
                data: 'incident_area',
                name: 'incident_area'
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

    $(document).on('click', '.addRowBtn', function(e) {
            e.preventDefault();
            var clonedRow = $(this).closest('.victim-row').clone(); 
            clonedRow.find('input').val('');
            clonedRow.find('.deletebtn').prop('disabled', false);
            $(this).closest('.victim-row').after(clonedRow);
        });

        // Function to delete row
        $(document).on('click', '.deletebtn', function() {
            if ($('.victim-row').length > 1) {
                $(this).closest('.victim-row').remove();
            }
        });


    $(document).on('click', '.incident-btn', function () {
        var id = $(this).attr('id');
        $('#recordID').val(id);
        $('#reportmodel').modal('show');
    });

    // open crime Judgement edit model
    $(document).on('click', '.closeinvestigation-btn', function () {
        var id = $(this).attr('id');
        $('#investigtionID').val(id);
         $('#judgementmodel').modal('show');
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
                    window.location.href = '{{ url("investigationstatus") }}/' + officerId + '/3';
                }
            });
        }
    });
});

</script>

@endsection