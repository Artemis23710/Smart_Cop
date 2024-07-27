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
                    <form action="{{ route('divisionstore') }}" method="POST">
                        @csrf
                        <div class="form-group required">
                            <select class="selectpicker" data-style="select-with-transition" title="Choose Province"
                                name="provinceid" id="provinceid" required>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->province_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <select class="selectpicker" data-style="select-with-transition" title="Choose District"
                                name="districtid" id="districtid">
                            </select>
                        </div>
                        <div class="form-group required">
                            <label class="inputlabel">Division Name</label>
                            <input type="text" class="form-control" id="divisionname" name="divisionname" required>
                        </div>

                        @can('Division-Create')
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
                        <input type="hidden" id="recordID" name="recordID">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="material-datatables">
                        @livewire('division-table')
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
    $("#divisionlink").addClass('active');
    $('.selectpicker').selectpicker();
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
                url: '{!! route("divisionsedit") !!}',
                type: 'POST',
                dataType: "json",
                data: {
                    id: id
                },
                success: function (data) {
                    $('#divisionname').val(data.result.division_name);
                    $('#provinceid').val(data.province_id); 
                    $('#provinceid').selectpicker('refresh');
                    $('#districtid').empty(); 
                    
                    $('#districtid').empty();
                    $.each(data.districts, function (key, value) {
                        $('#districtid').append('<option value="' + value.id + '">' + value.distric_name + '</option>');
                    });

                    $('#districtid').val(data.result.district_id);
                    $('#districtid').selectpicker('refresh');

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

        document.addEventListener('DOMContentLoaded', function () {
            const provinceSelect = document.getElementById('provinceid');
            const districtSelect = document.getElementById('districtid');

            provinceSelect.addEventListener('change', function () {
                const provinceId = this.value;

                if (provinceId) {
                    fetch(`/districts/${provinceId}`)
                        .then(response => response.json())
                        .then(data => {
                            districtSelect.innerHTML = '<option value="">Choose District</option>';
                            data.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.distric_name;
                                districtSelect.appendChild(option);
                            });
                            $('.selectpicker').selectpicker('refresh');
                        })
                        .catch(error => console.error('Error fetching districts:', error));
                } else {
                    districtSelect.innerHTML = '<option value="">Choose District</option>';
                    $('.selectpicker').selectpicker('refresh');
                }
            });
        });


</script>

@endsection