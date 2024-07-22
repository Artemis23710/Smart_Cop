@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.administrator_navbar')
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
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
                                        @can('Permission-Create')
                                        <a href="{{ route('addpermision', ['id' => $role->id]) }}" class="icon-button btn btn-info btn-sm mr-1 addbtn1"><i class="material-icons">add</i></a>                                      
                                        @endcan
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

    $("#privilegeslink").addClass('active');
    
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