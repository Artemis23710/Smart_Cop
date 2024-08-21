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

{{-- officer login permission create modole --}}
    <div class="modal fade" id="usermodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel"> Create Officer Login</h3>
                    <button type="button" class="close modelclosebtn" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <hr style="width:100%; height:1px; background-color:#000;">
                <div class="modal-body">

                    <form action="{{ route('offierslogincreate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="inputlabel">Account Name</label>
                            <input type="text" class="form-control" id="accountname" name="accountname">
                        </div>
                        <div class="form-group">
                            <label class="inputlabel">User Name</label>
                            <input type="email" class="form-control" id="useremail" name="useremail">
                        </div>
                        <div class="form-group">
                            <label class="inputlabel">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label class="inputlabel">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword"
                                name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <select class="selectpicker" data-style="select-with-transition" title="Choose Role"
                                name="roleid" id="roleid">
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        </div>
                        @endif


                </div>
                <hr style="width:100%; height:1px; background-color:#000;">
                <div class="modal-footer justify-content-center">
                    @can('User-Create')
                    <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info"><i
                            class="fas fa-save"></i>&nbsp;Save </button>
                    @endcan
                    <input type="hidden" id="recordID" name="recordID">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

<script>
$(document).ready(function () {

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
        columns: [{
                data: 'namewithintial',
                name: 'namewithintial'
            },
            {
                data: 'officerid',
                name: 'officerid'
            },
            {
                data: 'rank',
                name: 'rank'
            },
            {
                data: 'policedivision',
                name: 'policedivision'
            },
            {
                data: 'station',
                name: 'station'
            },
            {
                data: 'contactno',
                name: 'contactno'
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

    // set employee id in the model recordid feild
    $(document).on('click', '.useraccbtn', function () {
        var id = $(this).attr('id');
        $('#recordID').val(id);
        $('#usermodel').modal('show');
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
                    window.location.href = '{{ url("offiersstatus") }}/' + officerId + '/3';
                }
            });
        }
    });
        });

</script>

@endsection