@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.department_navbar')
    </div>
</div>
<div class="container-fluid">

    
</div>

@endsection


@section('script')

<script>


$(document).ready(function(){
    $("#divisionlink").addClass('active');
});

</script>

@endsection