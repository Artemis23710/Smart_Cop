@extends('layouts.app')

@section('content')
<div class="card" style="margin-top:50px;margin-bottom:50px;  border-radius: 0;">
</div>
<div class="container-fluid">
    <div class="col-12">

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-exclamation-triangle material-icons"></i> &nbsp;
                        </div>
                        <p class="card-category">Serious Crimes Suspects</p>
                        <h3 class="card-title">22</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">warning</i>
                            <a href="#pablo">Get More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <p class="card-category">Property and Financial Crimes Suspects</p>
                        <h3 class="card-title">13</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">attach_money</i>
                            <a href="#pablo">Get More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-flag material-icons"></i>
                        </div>
                        <p class="card-category">Violent and Public Disorder Suspects</p>
                        <h3 class="card-title">15</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="fas fa-flag material-icons"></i>
                            <a href="#pablo">Get More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-question-circle material-icons"></i>
                        </div>
                        <p class="card-category">Suspects of Other Crime</p>
                        <h3 class="card-title">+245</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="fas fa-question-circle material-icons"></i>
                            <a href="#pablo">Get More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons"></i>
                    </div>
                    <h4 class="card-title">Global Sales by Top Locations</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive table-sales">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Colombo</td>
                                            <td class="text-right">500</td>
                                            <td class="text-right">30%</td>
                                        </tr>
                                        <tr>
                                            <td>Kandy</td>
                                            <td class="text-right">300</td>
                                            <td class="text-right">18%</td>
                                        </tr>
                                        <tr>
                                            <td>Galle</td>
                                            <td class="text-right">150</td>
                                            <td class="text-right">10%</td>
                                        </tr>
                                        <tr>
                                            <td>Jaffna</td>
                                            <td class="text-right">120</td>
                                            <td class="text-right">8%</td>
                                        </tr>
                                      
                                        <tr>
                                            <td>Kurunegala</td>
                                            <td class="text-right">220</td>
                                            <td class="text-right">12%</td>
                                        </tr>
                                        <tr>
                                            <td>Ratnapura</td>
                                            <td class="text-right">180</td>
                                            <td class="text-right">9%</td>
                                        </tr>
                 
                                        <tr>
                                            <td>Gampaha</td>
                                            <td class="text-right">240</td>
                                            <td class="text-right">13%</td>
                                        </tr>
                                        <tr>
                                            <td>Anuradhapura</td>
                                            <td class="text-right">200</td>
                                            <td class="text-right">11%</td>
                                        </tr>
                                        <tr>
                                            <td>Polonnaruwa</td>
                                            <td class="text-right">140</td>
                                            <td class="text-right">7%</td>
                                        </tr>
                                        <tr>
                                            <td>Hambantota</td>
                                            <td class="text-right">130</td>
                                            <td class="text-right">8%</td>
                                        </tr>
                                        <tr>
                                            <td>Nuwara Eliya</td>
                                            <td class="text-right">110</td>
                                            <td class="text-right">5%</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Other Districts</td>
                                            <td class="text-right">330</td>
                                            <td class="text-right">28%</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <!-- Sri Lankan Map -->
                        <div class="col-md-6 ml-auto mr-auto">
                            <img src="{{ asset('Images/lk-07.png') }}" alt="Sri Lanka Map" style="height: 100%; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection

@section('script')
