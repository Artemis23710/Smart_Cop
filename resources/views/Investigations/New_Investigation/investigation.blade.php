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
              <div class="col-12">
                @can('Suspect-Create')
                <a href="{{ route('newinvestigation') }}"   class="btn btn-info fa-pull-right"><i class="fas fa-plus mr-2"></i>Add New Investigation Details</a>
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
                              <th>Suspect Name</th>
                              <th>NIC</th>
                              <th>Crime Category</th>
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
@endsection
@section('script')

<script>
$(document).ready(function () {

    $("#investigationlink").addClass('active');
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
                    window.location.href = '{{ url("suspectstatus") }}/' + officerId + '/3';
                }
            });
        }
    });
        });

</script>

@endsection