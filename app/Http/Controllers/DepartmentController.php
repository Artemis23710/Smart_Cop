<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){

        return view('Dashboards.departmentdashboard');

    }

    public function stationlist(){
        return view('Department.Stations.station');
    }

    public function offiersist(){
        return view('Department.Officers.officers');
    }
    

}
