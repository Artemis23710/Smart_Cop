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