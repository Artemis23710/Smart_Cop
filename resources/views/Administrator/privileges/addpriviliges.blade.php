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
                    <form action="{{ route('saveprivilegies') }}" method="POST">
                        @csrf
                        <input type="hidden" name="requestid" value="{{ $requestid }}">
                        <input type="hidden" name="role_name" value="{{ $role->name }}">
                        <div class="row col-4">
                            <div class="form-group">
                                <label class="inputlabel">Role Name:</label>
                                <input type="text" class="form-control" id="roleName" value="{{ $role->name }}" disabled>
                            </div>
                        </div>
                        <label>
                            <input type="checkbox" name="selectAll" id="selectAllDomainList" />
                            <label class="form-check-label" style="color: black;" for="selectAllDomainList">Check All</label>
                        </label>
                        <br><hr>
                        <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <tbody>
                                @foreach($permsWithModules as $module)
                                    <tr>
                                        <td><b>{{ $module['module_name'] }}</b></td>
                                            @foreach($permissions->where('module_name', $module['module_name']) as $permission)
                                            <td>
                                                    <input type="checkbox" class="form-check-input" style="border-color: black;"  name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label" style="color: black;"><b>{{ $permission->name }}</b></label>
                                            </td>
                                            @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class=" col-md-12 text-center">
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp; Submit</button>
                    </div>
                    </form>
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
    
    $(':checkbox[name=selectAll]').click(function () {
        $(':checkbox').prop('checked', this.checked);
    });
});
</script>

@endsection