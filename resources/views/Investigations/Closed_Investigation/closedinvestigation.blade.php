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
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                              <th>Case No</th>
                              <th>Crime Category</th>
                              <th>Crime</th>
                              <th>Title Incident</th>
                              <th>Incident Date</th>
                              <th>Incident Location</th>
                              <th>Incident Area</th>
                              <th>Approve Status</th>
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

    $("#closedinvestigationlink").addClass('active');

    $('#datatable').DataTable();
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
        ajax: "{{ route('showclosedinvestigations') }}",
        columns: [{
                data: 'case_no',
                name: 'case_no'
            },
            {
                data: 'crimemain',
                name: 'crimemain'
            },
            {
                data: 'crime',
                name: 'crime'
            },
            {
                data: 'title_incident',
                name: 'title_incident'
            },
            {
                data: 'incident_date',
                name: 'incident_date'
            },
            {
                data: 'incident_location',
                name: 'incident_location'
            },
            {
                data: 'incident_area',
                name: 'incident_area'
            },
            {
                data: 'approve_status',
                name: 'approve_status'
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

        $(document).on('click', '.printdocuments-btn', function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var newTab = window.open('', '_blank');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{!! route("printinvestigationdocument") !!}',
                type: 'POST',
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (data) {
                    var pdfBlob = base64toBlob(data.pdf, 'application/pdf');
                    var pdfUrl = URL.createObjectURL(pdfBlob);

                    newTab.document.write('<html><body><embed width="100%" height="100%" type="application/pdf" src="' + pdfUrl + '"></body></html>');
                },
                error: function () {
                    console.log('PDF request failed.');
                    newTab.document.write('<html><body><p>Failed to load PDF. Please try again later.</p></body></html>');
                }
            });
        });

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
                            window.location.href = '{{ url("investigationstatus") }}/' + officerId + '/3';
                        }
                    });
                }
            });
        });


    function base64toBlob(base64Data, contentType) {
        var byteCharacters = atob(base64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += 512) {
            var slice = byteCharacters.slice(offset, offset + 512);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }

        return new Blob(byteArrays, {
            type: contentType
        });
    }

</script>

@endsection