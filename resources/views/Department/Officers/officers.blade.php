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
              <div class="col-12">
                @can('Officer-Create')
                <a href="{{ route('newoffiers') }}"   class="btn btn-info fa-pull-right"><i class="fas fa-plus mr-2"></i>Add New Officer</a>
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
                              <th>Officer Name</th>
                              <th>Officer ID</th>
                              <th>Rank</th>
                              <th>Division</th>
                              <th>Assigned Station</th>
                              <th>Contact</th>
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
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('showofficers') }}",
        columns: [
            {data: 'namewithintial', name: 'namewithintial'},
            {data: 'officerid', name: 'officerid'},
            {data: 'rank', name: 'rank'},
            {data: 'policedivision', name: 'policedivision'},
            {data: 'station', name: 'station'},
            {data: 'contactno', name: 'contactno'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right'}
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
        });

</script>

@endsection