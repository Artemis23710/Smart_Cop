@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.department_navbar')
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('stationsstore') }}" method="POST" >
                        @csrf
                        <div class="form-group required">
                            <select class="selectpicker" data-style="select-with-transition"  title="Choose Division" name="divisionid" id="divisionid" required>
                                @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->division_name}}</option>
                                @endforeach
                            </select>
                        </div>
                          <div class="form-group required">
                            <label class="inputlabel">Station Name</label>
                            <input type="text" class="form-control" id="stationname" name="stationname" required>
                          </div>
                          <div class="form-group required">
                            <label class="inputlabel">Station Address</label>
                            <textarea class="form-control" name="stationaddress" id="stationaddress" cols="10" rows="2"></textarea>
                          </div>
                          <div class="form-group required">
                            <label class="inputlabel" >Station Contact</label>
                            <input type="text" class="form-control" id="stationcontact" name="stationcontact" required>
                          </div>

                          @can('Station-Create')
                          <div class="col-12 d-flex align-items-center justify-content-center">
                              <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                               <i class="fas fa-save"></i>&nbsp;Save </button>
                          </div>
                          @endcan
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                      @foreach ($errors->all() as $error)
                                        {{ $error }}
                                      @endforeach
                              </div>
                          @endif
                          <input type="hidden" id="hiddenid" name="hiddenid" value="1">
                          <input type="hidden" id="distrrictid" name="distrrictid">
                          <input type="hidden" id="recordID" name="recordID">
                        </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="material-datatables">
                        @livewire('police-station-table')
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')

<script>
    $(document).ready(function () {

        $("#stationlink").addClass('active');

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


        $(document).on('click', '.editbtn', function () {
            var id = $(this).attr('id');

            $('#form_result').html('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{!! route("stationsedit") !!}',
                type: 'POST',
                dataType: "json",
                data: {
                    id: id
                },
                success: function (data) {

                    $('#divisionid').val(data.result.division_id);
                    $('#divisionid').selectpicker('refresh');
                    $('#stationname').val(data.result.station_name);
                    $('#stationaddress').val(data.result.station_address);
                    $('#stationcontact').val(data.result.station_contact);

                    $('#recordID').val(id);
                    $('#hiddenid').val(2);


                }
            });
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