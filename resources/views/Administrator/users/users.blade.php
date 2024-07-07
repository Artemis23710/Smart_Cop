@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px; border-radius: 0;">
    <div class="card-body">
        @include('layouts.administrator_navbar')
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <form method="#" action="#">
                        <div class="form-group">
                          <label for="accountname" class="bmd-label-floating">Account Name</label>
                          <input type="text" class="form-control" id="accountname">
                        </div>
                        <div class="form-group">
                            <label for="useremail" class="bmd-label-floating">User Name</label>
                            <input type="email" class="form-control" id="useremail">
                          </div>
                        <div class="form-group">
                          <label for="password" class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" id="examplePass">
                        </div>
                        <div class="form-group">
                            <label for="examplePass" class="bmd-label-floating">Confirm Password</label>
                            <input type="password" class="form-control" id="examplePass">
                        </div>
                        <div class="form-group">
                            <select class="selectpicker" data-style="select-with-transition"  title="Choose Role">
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                              </select>
                        </div>
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                             <i class="fas fa-save"></i>&nbsp;Save </button>
                        </div>
                        
                          
                      </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Position</th>
                                  <th>Office</th>
                                  <th>Age</th>
                                  <th>Date</th>
                                  <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Tiger Nixon</td>
                                  <td>System Architect</td>
                                  <td>Edinburgh</td>
                                  <td>61</td>
                                  <td>2011/04/25</td>
                                  <td class="text-right">
                                    <a href="#" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">favorite</i></a>
                                    <a href="#" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">dvr</i></a>
                                    <a href="#" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Garrett Winters</td>
                                  <td>Accountant</td>
                                  <td>Tokyo</td>
                                  <td>63</td>
                                  <td>2011/07/25</td>
                                  <td class="text-right">
                                    <a href="#" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">favorite</i></a>
                                    <a href="#" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">dvr</i></a>
                                    <a href="#" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Ashton Cox</td>
                                  <td>Junior Technical Author</td>
                                  <td>San Francisco</td>
                                  <td>66</td>
                                  <td>2009/01/12</td>
                                  <td class="text-right">
                                    <a href="#" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">favorite</i></a>
                                    <a href="#" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">dvr</i></a>
                                    <a href="#" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
                                  </td>
                                </tr>
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

    $("#userlink").addClass('active');
    
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
</script>

@endsection