<div>
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Province</th>
                <th>District</th>
                <th>Division</th>
                <th class="disabled-sorting text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($divisions as $division)
                <tr>
                    <td>{{ $division->id}}</td>
                    <td>{{ $division->district->distric_name }}</td>
                    <td>{{ $division->division_name }}</td>
                    <td class="text-right">

                            @can('Division-Edit')
                            <button class="icon-button btn btn-info btn-sm mr-1 editbtn" title="Edit"id="{{ $division->id }}" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">edit</i></button>
                            @endcan
                            
                            @can('Division-Status')
                                @if ( $division->status == 1)

                                        <a href="{{ route('divisionsstatus', ['id' => $division->id, 'status' => 2]) }}" onclick="return deactive_confirm()" target="_self"  title="Deactivate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i></a>
                                @else
                                        <a href="{{ route('divisionsstatus', ['id' => $division->id, 'status' => 1]) }}" onclick="return active_confirm()" target="_self" title="Activate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-warning btn-sm mr-1 "><i class="fas fa-times"></i></a>
                                @endif 
                           @endcan

                           @can('Division-Delete')
                                <a href="{{ route('divisionsstatus', ['id' => $division->id, 'status' => 3]) }}" onclick="return delete_confirm()" target="_self" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-danger btn-sm mr-1 "> <i class="material-icons">delete</i></a>          
                            @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
