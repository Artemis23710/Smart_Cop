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
              <div class="col-12">
                @can('Suspect-Create')
                <a href="{{ route('newmissingcomplains') }}"   class="btn btn-info fa-pull-right"><i class="fas fa-plus mr-2"></i>Add New Missing Persion Complaints</a>
                @endcan
            </div>
            <br>
            <br>
            <hr style="width:100%; height:1px; background-color:#000;">
            <br>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                            <th>Date of Complaint</th>
                              <th>Person Name</th>
                              <th>Gender</th>
                              <th>Last Seen at</th>
                              <th>Person Posted the Complaint</th>
                              <th>Person Posted the Complaint ID</th>
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

    $("#missingpersonlink").addClass('active');
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
        ajax: "{{ route('showmissingpersioncomplain') }}",
        columns: [
            {
                data: 'id',
                name: 'id'
            },{
                data: 'dateofcomplain',
                name: 'dateofcomplain'
            },
            {
                data: 'missingperson_fullname',
                name: 'missingperson_fullname'
            },
            {
                data: 'missingperson_gender',
                name: 'missingperson_gender'
            },
            {
                data: 'missingperson_lastseen',
                name: 'missingperson_lastseen'
            },
            {
                data: 'poctperson_name',
                name: 'poctperson_name'
            },
            {
                data: 'poctperson_idnumber',
                name: 'poctperson_idnumber'
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
                    window.location.href = '{{ url("missingpersioncomplainsdelete") }}/' + officerId ;
                }
            });
        }
    });
        });

</script>

@endsection