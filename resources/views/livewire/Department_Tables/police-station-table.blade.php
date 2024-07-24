<div>
    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>District</th>
                <th>Division</th>
                <th>Station</th>
                <th>Address</th>
                <th>Contact</th>
                <th class="disabled-sorting text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stations as $station)
                <tr>
                    <td>{{ $station->policedivision->district->distric_name}}</td>
                    <td>{{ $station->policedivision->division_name }}</td>
                    <td>{{ $station->station_name }}</td>
                    <td>{{ $station->station_address }}</td>
                    <td>{{ $station->station_contact }}</td>
                    <td class="text-right">

                        @can('Station-Edit')
                        <button class="icon-button btn btn-info btn-sm mr-1 editbtn" title="Edit"id="{{ $station->id }}"><i class="material-icons">edit</i></button>
                        @endcan
                        @can('Station-Status')
                            @if ( $station->status == 1)
                                    <a href="{{ route('stationsstatus', ['id' => $station->id, 'status' => 2]) }}" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i></a>
                            @else
                                    <a href="{{ route('stationsstatus', ['id' => $station->id, 'status' => 1]) }}" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1 "><i class="fas fa-times"></i></a>
                            @endif 
                       @endcan
                       @can('Station-Delete')
                            <a href="{{ route('stationsstatus', ['id' => $station->id, 'status' => 3]) }}" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm mr-1 "> <i class="material-icons">delete</i></a>          
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>