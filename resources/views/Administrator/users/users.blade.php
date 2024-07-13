@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.administrator_navbar')
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('storeuser') }}" method="POST" >
                      @csrf
                        <div class="form-group">
                          <label for="accountname" class="bmd-label-floating">Account Name</label>
                          <input type="text" class="form-control" id="accountname" name="accountname">
                        </div>
                        <div class="form-group">
                            <label for="useremail" class="bmd-label-floating">User Name</label>
                            <input type="email" class="form-control" id="useremail" name="useremail">
                          </div>
                        <div class="form-group">
                          <label for="password" class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="bmd-label-floating">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <select class="selectpicker" data-style="select-with-transition"  title="Choose Role" name="roleid" id="roleid">
                                @foreach($roles as $role)
                                   <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                             <i class="fas fa-save"></i>&nbsp;Save </button>
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
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Account Name</th>
                                  <th>User Name</th>
                                  <th>Role</th>
                                  <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td class="text-right">  

                                        <button class="icon-button btn btn-info btn-sm mr-1 editbtn" title="Edit"id="{{ $user->id }}"><i class="material-icons">edit</i></button>
                                       @if ( $user->status == 1)
                                            <a href="{{ route('userstatus', ['id' => $user->id, 'status' => 2]) }}" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i></a>
                                       @else
                                             <a href="{{ route('userstatus', ['id' => $user->id, 'status' => 1]) }}" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1 "><i class="fas fa-times"></i></a>
                                       @endif 
                                            <a href="{{ route('userstatus', ['id' => $user->id, 'status' => 3]) }}" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm mr-1 "> <i class="material-icons">delete</i></a>          
                                    </td>
                                </tr>
                            @endforeach
                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>

   
</div>
@endsection


@section('script')

<script>


$(document).ready(function(){

    $("#userlink").addClass('active');

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

      
      // edit function 
      $(document).on('click', '.editbtn', function () {
          var id = $(this).attr('id');

          $('#form_result').html('');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          })

          $.ajax({
              url: '{!! route("edituser") !!}',
              type: 'POST',
              dataType: "json",
              data: {
                  id: id
              },
              success: function (data) {
                  $('#accountname').val(data.result.name);
                  $('#useremail').val(data.result.email);
                  $('#roleid').val(data.result.role_id);
                  $('#roleid').selectpicker('refresh');
                  $('#recordID').val(id);
                  $('#hiddenid').val(2);
              }
          })
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