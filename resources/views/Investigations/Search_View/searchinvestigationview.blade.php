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
                <div class="row">
                    <div class="col-12">
                        <h3 class="title-style"><span>Crime And Incident Information</span></h6>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Case No.</label>
                                        <input type="text" class="form-control" id="caseno" name="caseno"
                                            value="{{ $investigationinfo->case_no}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Report Date</label>
                                        <input type="date" class="form-control" id="reportdate" name="reportdate"
                                            value="{{ $investigationinfo->report_date}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="form-group">
                                        <label class="inputlabel">Main Crime Category</label><br>
                                        <select class="selectpicker" data-style="select-with-transition"
                                            title="Choose Crime Category" name="crimecategory" id="crimecategory"
                                            disabled>
                                            @foreach($maincrimecategory as $category)
                                            <option value="{{ $category->id }}"
                                                {{$category->id == $investigationinfo->arrested_crime_category ? 'selected' : '' }}>
                                                {{ $category->main_crime_category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="form-group">
                                        <label class="inputlabel">Offence</label><br>
                                        <select class="selectpicker" data-style="select-with-transition"
                                            title="Choose Offence" name="arrestedcrime" id="arrestedcrime" disabled>
                                            @foreach($crimelists as $crime)
                                            <option value="{{ $crime->id }}"
                                                {{ $crime->id == $investigationinfo->arrested_crime ? 'selected' : '' }}>
                                                {{ $crime->crime}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Tilte for Incident</label>
                                        <input type="text" class="form-control" id="incidenttitle" name="incidenttitle"
                                            value="{{ $investigationinfo->title_incident}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Date Of Incident</label>
                                        <input type="date" class="form-control datepicker" id="incidentdate"
                                            name="incidentdate" value="{{ $investigationinfo->incident_date}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Incident Location</label>
                                        <input type="text" class="form-control" id="incidentlocation"
                                            name="incidentlocation" value="{{ $investigationinfo->incident_location}}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Incident Area</label>
                                        <input type="text" class="form-control" id="incidentarea"
                                            value="{{ $investigationinfo->incident_area}}" name="incidentarea">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="inputlabel">Related Division</label><br>
                                        <select class="selectpicker" data-style="select-with-transition"
                                            title="Choose Division" name="divisionid" id="divisionid" disabled>
                                            @foreach($policedivisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ $division->id == $divisionID ? 'selected' : '' }}>
                                                {{ $division->division_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group ">
                                        <label class="inputlabel">Related Police Station</label><br>
                                        <select class="selectpicker" data-style="select-with-transition"
                                            title="Choose Police Station" name="arreststationid" id="arreststationid"
                                            disabled>
                                            @foreach($stations as $station)
                                            <option value="{{ $station->id }}"
                                                {{ $station->id == $investigationinfo->arrested_station ? 'selected' : '' }}>
                                                {{ $station->station_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group ">
                                        <label class="inputlabel">Investigating Officer</label><br>
                                        <select class="selectpicker" data-style="select-with-transition"
                                            title="Choose officer" name="officerid" id="officerid" disabled>
                                            @foreach($officers as $officer)
                                            <option value="{{ $officer->id }}"
                                                {{ $officer->id == $investigationinfo->investigating_officer ? 'selected' : '' }}>
                                                {{ $officer->officerid}} - {{ $officer->namewithintial}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group ">
                                        <label class="inputlabel">Assign Date</label>
                                        <input type="date" class="form-control" id="officerassigndate"
                                            name="officerassigndate" value="{{ $investigationinfo->assigndate}}"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="inputlabel">Incident Description</label>
                                    <textarea name="incidentdescription" class="form-control" cols="20" rows="5"
                                        disabled>{{$investigationinfo->incident_description}}</textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <br><br>
                <div class="col-12">
                    <h3 class="title-style"><span>Victims Information</span></h6>
                        @foreach($victims as $victim)
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="inputlabel">Victim Name</label>
                                    <input type="text" class="form-control" id="victimname" name="victimname[]"
                                        value="{{ $victim->victim_name}}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="inputlabel">Gender</label><br>
                                    <input type="text" class="form-control" id="victimgender" name="victimgender[]"
                                        value="{{ $victim->victim_gender}}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="inputlabel">Victim Age</label>
                                    <input type="text" class="form-control" id="victimage" name="victimage[]"
                                        value="{{ $victim->victim_age}}" disabled>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div><br><br>

                <div class="col-12">
                    <h3 class="title-style"><span>Suspects Information Related to the Investigation</span></h6>
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                            width="100%" style="width:100%">
                            <thead>
                                <th>Suspect Name</th>
                                <th>Suspect NIC</th>
                                <th>Arrested Date</th>
                                <th>Arrested Location</th>
                                <th>Date Of Incident</th>
                            </thead>
                            <tbody>
                                @foreach($suspects as $suspect)
                                <tr>
                                    <td>{{ $suspect->suspect->fullname}}</td>
                                    <td>{{ $suspect->suspect->idcardno }}</td>
                                    <td>{{ $suspect->arrested_date }}</td>
                                    <td>{{ $suspect->incident_location }}</td>
                                    <td>{{ $suspect->dateofincident }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div><br><br>

                <div class="col-12">
                    <h3 class="title-style"><span>Investigation Closing Details</span></h6><br>
                        <div class="row">
                            <div class="col-2">
                                <label class="inputlabel">Day of Closing Investigation</label>
                                <input type="date" class="form-control" id="dateclosing" name="dateclosing" value="{{$investigationcolse->dayofclosing}}" disabled>
                            </div>
                            <div class="col-4">
                                <label class="inputlabel">Reason for Closing Investigation</label>
                                <input type="text" class="form-control" id="reason" name="reason" value="{{$investigationcolse->reason_closing}}" disabled>
                            </div>
                            <div class="col-6">
                                <label class="inputlabel"> Closing Summary</label>
                                <textarea name="closingnote" id="closingnote" class="form-control" cols="20" rows="5" disabled>{{$investigationcolse->closing_summary}}</textarea>
                            </div>
                        </div>
                </div><br><br>
                <div class="col-12">
                    <h3 class="title-style"><span>Investigation Notes</span></h6>
                        <div class="col-12">
                            <ul class="nav nav-pills nav-pills-info" role="tablist">
                                @foreach($crimenotes as $index => $noteGroup)
                                <li class="nav-item">
                                    <a class="nav-link {{ $index === 1 ? 'active' : '' }}" data-toggle="tab" href="#tab{{ $index }}"
                                        role="tablist">
                                        {{ $noteGroup->first()->investigation_title }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content tab-space">
                                @foreach($crimenotes as $index => $noteGroup)
                                <div class="tab-pane {{ $index === 1 ? 'active' : '' }}" id="tab{{ $index }}">
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="inputlabel">Investigation Note Tilte</label>
                                            <input type="text" class="form-control" id="notetitle" name="notetitle" value="{{ $noteGroup->first()->investigation_title }}" disabled>
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Date Of Investigation Note</label>
                                            <input type="date" class="form-control" id="notedate" name="notedate" value="{{ $noteGroup->first()->day_investigation_note }}"  required>
                                        </div>
                                        <div class="col-4">
                                            <label class="inputlabel">Related Location</label>
                                            <input type="text" class="form-control" id="relatedlocation" value="{{ $noteGroup->first()->related_location }}" name="relatedlocation">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="inputlabel">Investigation Description</label>
                                            <textarea name="investigtionnote" id="investigtionnote" class="form-control" cols="20" rows="5">{{ $noteGroup->first()->description }}</textarea>
                                        </div>
                                    </div>
                                    @php
                                    $evidenceExists = false;
                                    @endphp

                                    <h3>Evidences For Crime Note :</h3>
                                    <ul>
                                        @foreach($noteGroup as $evidence)
                                        @if($evidence->evidence_id)
                                        @php
                                        $evidenceExists = true;
                                        @endphp
                                        <li>
                                           <div class="row">
                                                @if(!empty($evidence->evidence))
                                                <img src="{{ asset('storage/Investigation_Evidance/Evidances/' . $evidence->evidence) }}" class="evidanceviewimage"  alt="Evidence Image" />
                                                @else
                                                    <p>No image available</p>
                                                @endif

                                                <div class="col-4">
                                                    <label class="inputlabel">Evidences Title</label>
                                                    <input class="form-control" type="text" value="{{ $evidence->evidence_title }}" disabled>
                                                </div>
                                                <div class="col-4">
                                                    <label class="inputlabel">Evidences Description</label>
                                                    <input class="form-control" type="text" value="{{ $evidence->evidence_desription }}" disabled>
                                                </div>
                                           </div>
                                        </li>
                                        @endif
                                        @endforeach
                                        @if(!$evidenceExists)
                                        <p>No evidence available for this Investigation note.</p>
                                        @endif
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div><br><br>

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection