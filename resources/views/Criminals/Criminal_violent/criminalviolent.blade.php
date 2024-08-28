@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.criminals_navbar')
    </div>
</div>
<div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                              <th>Suspect Name</th>
                              <th>NIC</th>
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

{{-- Crime Record details add model --}}
<div class="modal fade" id="reportmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Add Suspect Crime Details</h3>
                <button type="button" class="close modelclosebtn" data-dismiss="modal" aria-hidden="true" >
                    <i class="material-icons">close</i>
                </button>
            </div>
            <hr style="width:100%; height:1px; background-color:#000;">
            <div class="modal-body">
                @livewire('violentreport-form')
            </div>
        </div>
    </div>
</div>

    {{-- curt judgement add model --}}
<div class="modal fade" id="judgementmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Add Suspect's Court Judgement Details</h3>
                <button type="button" class="close modelclosebtn" data-dismiss="modal" aria-hidden="true" >
                    <i class="material-icons">close</i>
                </button>
            </div>
            <hr style="width:100%; height:1px; background-color:#000;">
            <div class="modal-body">
                @livewire('violentjudgement-form')
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')

<script>
$(document).ready(function () {

    $("#violentlink").addClass('active');
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
        ajax: "{{ route('showviolentcriminal') }}",
        columns: [{
                data: 'namewithintial',
                name: 'namewithintial'
            },
            {
                data: 'idcardno',
                name: 'idcardno'
            },
            {
                data: 'crimecategory',
                name: 'crimecategory'
            },
            {
                data: 'station',
                name: 'station'
            },
            {
                data: 'arresteddate',
                name: 'arresteddate'
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


    // $(document).on('click', '.report-btn', function () {
    //     var id = $(this).attr('id');
    //     window.Livewire.emit('setRecordID', id); // Access Livewire via the window object
    //     $('#reportmodel').modal('show');
    // });


    $(document).on('click', '.judment-btn', function () {
        var id = $(this).attr('id');
        $('#recordID').val(id);
        $('#judgementmodel').modal('show');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const penaltySection = document.getElementById("peneltysection");
    const guiltyRadio = document.getElementById("judconvicted");
    const notGuiltyRadio = document.getElementById("judnotconvicted");

    function togglePenaltySection() {
        if (guiltyRadio.checked) {
            penaltySection.style.display = "block";
        } else {
            penaltySection.style.display = "none";
        }
    }

    guiltyRadio.addEventListener("change", togglePenaltySection);
    notGuiltyRadio.addEventListener("change", togglePenaltySection);

    // Initial check
    togglePenaltySection();
});


document.addEventListener('DOMContentLoaded', function () {
    @if(session('message'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('
        message ') }}',
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