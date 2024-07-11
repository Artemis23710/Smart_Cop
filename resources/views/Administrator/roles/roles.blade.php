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
                    <form action="{{ route('insertrole') }}" method="POST" >
                        @csrf
                        <div class="form-group">
                          <label for="accountname" class="bmd-label-floating">Role Name</label>
                          <input type="text" class="form-control" id="accountname" name="accountname" >
                        </div>
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                             <i class="fas fa-save"></i>&nbsp;Save </button>
                        </div>
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
                                  <th>Role</th>
                                  <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                              <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-right">  
                                        <button class="icon-button btn btn-success btn-sm mr-1 editbtn" title="Edit"id="{{ $role->id }}"><i class="material-icons">edit</i></button>
                                        
                                        <form action="{{ route('roledelete', $role->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-button btn btn-danger btn-sm mr-1 delete-btn" title="Delete">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>                                        
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
@endsection


@section('script')
<script>


$(document).ready(function(){

    $("#rolelink").addClass('active');
    
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
      var table = $('#datatable').DataTable();


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
              url: '{!! route("editrole") !!}',
              type: 'POST',
              dataType: "json",
              data: {
                  id: id
              },
              success: function (data) {
                  $('#accountname').val(data.result.name);
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
//         document.addEventListener('DOMContentLoaded', () => {
//     const deleteButtons = document.querySelectorAll('.delete-btn');

//     deleteButtons.forEach(button => {
//         button.addEventListener('click', (e) => {
//             e.preventDefault();

//             Swal.fire({
//                 title: 'Are you sure?',
//                 text: "You won't be able to revert this!",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#d33',
//                 cancelButtonColor: '#3085d6',
//                 confirmButtonText: 'Yes, delete it!'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     // Get the form data
//                     const form = e.target.closest('form');
//                     const formData = new FormData(form);

//                     // Submit the form via AJAX using jQuery
//                     $.ajax({
//                         url: form.action,
//                         method: 'DELETE',
//                         data: formData,
//                         headers: {
//                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         },
//                         success: function (response) {
//                             // Handle success response
//                             Swal.fire(
//                                 'Deleted!',
//                                 'Your item has been deleted.',
//                                 'success'
//                             );
//                             // Optionally, update the UI or reload the page
//                             window.location.reload();
//                         },
//                         error: function (xhr, status, error) {
//                             // Handle error response
//                             Swal.fire(
//                                 'Error!',
//                                 'There was an error deleting your item.',
//                                 'error'
//                             );
//                             console.error(error);
//                         }
//                     });
//                 }
//             });
//         });
//     });
// });
</script>

@endsection