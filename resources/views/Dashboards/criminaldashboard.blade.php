@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.criminals_navbar')
    </div>
</div>
<style>
    .search-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 50px 0;
    }

    .search-logo {
        width: 200px;
        margin-bottom: 20px;
    }

    .search-bar {
        display: flex;
        align-items: center;
        position: relative;
    }

    .search-left-btn {
        padding: 10px;
        border: none;
        background: transparent;
        cursor: pointer;
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .search-left-btn i {
        width: 10px;
        height: 10px;
    }

    .search-input {
        width: 500px;
        max-width: 100%;
        padding: 12px 20px 12px 50px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-right: none; /* Remove the border on the right to merge with button */
        outline: none;
        border-radius: 25px 0 0 25px; /* Rounded corners for the left side */
        transition: box-shadow 0.3s ease-in-out;
    }

    .search-input:focus {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-color: #4285f4;
    }

    .search-btn {
        padding: 12px 20px;
        background-color: #4285f4;
        color: white;
        border-radius: 0 25px 25px 0; /* Rounded corners for the right side */
        border: 1px solid #4285f4;
        border-left: none; /* Remove left border to join with input */
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .search-btn svg {
        width: 20px;
        height: 20px;
        fill: white;
    }

    .search-btn:hover {
        background-color: #357ae8;
    }

    @media (max-width: 768px) {
        .search-input {
            width: 100%;
            padding-left: 50px;
        }

        .search-btn {
            margin-top: 10px;
            border-radius: 25px;
            width: 100%;
        }

        .search-bar {
            flex-direction: column;
        }

        .search-logo {
            width: 120px;
        }
    }
        .image-search-wrapper {
            width: 580px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }

        /* Header section with title and close icon */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .close-icon {
            cursor: pointer;
            color: #333;
        }

        /* Drag-and-drop box for file upload */
        .upload-box {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .upload-box.highlight {
            background-color: #e0f7fa;
        }

        .icon-box {
            font-size: 48px;
            color: #8e8e8e;
            margin-bottom: 10px;
        }

        .upload-text {
            font-size: 14px;
            color: #666;
        }

        .upload-link {
            color: #4285f4;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .upload-link:hover {
            text-decoration: underline;
        }

        /* File input element hidden */
        .input-file {
            display: none;
        }

        .input-section {
            margin-top: 20px;
            margin-left: 40%;
        }

        .submit-btn {
            background-color: #4285f4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .submit-btn i.material-icons {
            font-size: 30px;

            color: #fff;

        }
        .submit-btn:hover {
            background-color: #357ae8;
            align-items: center;
        }
</style>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" style=" height:78vh; max-height: 100%;">
                <div class="card-body">

                    <div class="search-container" >
                        <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="search-logo">
                        <div class="search-bar" id="search-container">
                            <button class="search-left-btn" id="imageupload">
                                <i class="material-icons" style="font-size: 25px; margin-top:5px;margin-right:5px;">camera_alt</i>
                            </button>
                            <input type="text" id="search-field" class="search-input" placeholder="Search A Criminal by keyword...">
                            <button id="search-button" class="search-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zm-5.44 1.528a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                
                    <div class="image-search-wrapper" id="image-search-wrapper" style="display: none;">
                        <div class="header-section">
                            <h2 class="header-title">Search Criminal with Image</h2>
                            <i class="close-icon material-icons" id="close-btn" style="font-size:35px;">close</i>
                        </div>
                        <form action="{{ route('criminalsearchimage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="upload-box" id="drop-area">
                                <div class="icon-box">
                                    <i class="material-icons">image</i>
                                </div>
                                <p class="upload-text">Drag an image here or
                                    <label for="file-input" class="upload-link">select a file</label>
                                </p>
                            </div>
                            <input type="file" id="file-input" name="criminalimage" required>
                            <div class="input-section">
                               
                                <button type="submit" class="submit-btn" id="upload-btn"><i
                                        class="material-icons">search</i>Search</button>
                            </div>
                        </form>
                    </div>

                    <br><br><hr>

                    <div id="results-container" style="display: none;">
                        <div class="material-datatables" >
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" >
                                <thead>
                                    <tr>
                                      <th>Suspect Name</th>
                                      <th>NIC</th>
                                      <th>Aliases</th>
                                      <th>Gender</th>
                                      <th>Crime Category</th>
                                      <th>Last Arrested Crime</th>
                                      <th>Last Arrested</th>
                                      <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody id="results-body">
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

$(document).ready(function() {

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

    $('#search-button').on('click', function() {
        let keyword = $('#search-field').val();

        $.ajax({
            url: '{{ route("criminalsearch") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                keyword: keyword
            },
            success: function(response) {
                let resultsContainer = $('#results-container');
                let resultsBody = $('#results-body');

                resultsBody.html(response.html); 
                if (response.html) {
                    resultsContainer.show();
                } else {
                    resultsContainer.hide();
                    Swal.fire({
                        icon: 'info',
                        title: 'No Record Found',
                        text: 'There is No Record Matching Your Search.',
                    });
                }
            }
        });
    });


    });

     document.getElementById('imageupload').addEventListener('click', function() {
        document.getElementById('search-container').style.display = 'none';
        document.getElementById('image-search-wrapper').style.display = 'block';
    });

    document.getElementById('close-btn').addEventListener('click', function() {
        document.getElementById('image-search-wrapper').style.display = 'none';
        document.getElementById('search-container').style.display = 'block';
    });

    document.addEventListener('DOMContentLoaded', function () {
            @if(session('message'))
                Swal.fire({
                    icon: 'error',
                    title: 'Not Found',
                    text: '{{ session('message') }}',
                    showConfirmButton: false,
                    position: "top-end",
                    timer: 1000
                });
            @endif
        });

</script>

<script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file-input');
        let selectedFile = null;

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Highlight drop area on dragover
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.classList.add('highlight');
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.classList.remove('highlight');
        });

        // Handle file drop
        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        // Handle file select
        fileInput.addEventListener('change', (e) => {
            const files = e.target.files;
            handleFiles(files);
        });

        // Handle files
        function handleFiles(files) {
            selectedFile = files[0];
            previewFile(selectedFile);
        }

        // Preview the selected image directly in the drop area
        function previewFile(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = () => {
                    // Replace the content of the drop area with the image
                    dropArea.innerHTML = `<img src="${reader.result}" style="max-width: 100%; max-height: 150px; border-radius: 8px;">`;
                };
            }
        }
</script>

@endsection