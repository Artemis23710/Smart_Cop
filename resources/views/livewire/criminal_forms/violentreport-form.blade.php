<div>
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-4 required">
                <label class="inputlabel">Arrested Crime</label>
                <select class="selectpicker" data-style="select-with-transition" title="Arrested Crime" name="arretedcrime" id="arretedcrime" readonly>
                    @foreach($crimelist as $crimel)
                    <option value="{{ $crimel->id }}">{{$crimel->crime}}</option>
                @endforeach
            </select>
            </div>
            <div class="col-4 required">
                <label class="inputlabel">Arrested Date</label>
                <input type="date" class="form-control" id="arresteddate" name="arresteddate" readonly>
            </div>
            <div class="col-4 required">
                <label class="inputlabel">Arrested Station</label>
                <select class="selectpicker" data-style="select-with-transition" title="Arrested Station" name="arrestedstation" id="arrestedstation" readonly>
                    @foreach($stationlist as $station)
                    <option value="{{ $station->id }}">{{$station->station_name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4 required">
                <label class="inputlabel">Incident Location</label>
                <input type="text" class="form-control" id="incidentlocation" name="incidentlocation" required>
            </div>
            <div class="col-4 required">
                <label class="inputlabel">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="col-4 required">
                <label class="inputlabel">Date Of Incident</label>
                <input type="date" class="form-control" id="incidentdate" name="incidentdate" required>
            </div>
        </div>
        <div class="col-12">
            <label class="inputlabel">Incident Description</label>
            <textarea name="incidentnote"class="form-control" cols="20" rows="5"></textarea>
        </div>
        <hr style="width:100%; height:1px; background-color:#000;">
            <div class="col-12">
                <label class="inputlabel">Incident Evidences</label>
                <input class="form-control" type="file" id="incidentevedance" name="incidentevedance" multiple>
            </div>
            <hr style="width:100%; height:1px; background-color:#000;">
        <div class="col-12">
            <label class="inputlabel">Incident Follow Up</label>
            <textarea name="incidentfalowup"class="form-control" cols="20" rows="5"></textarea>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif

        <hr style="width:100%; height:1px; background-color:#000000;">
        <div class="modal-footer justify-content-center">
            @can('User-Create')
            <button type="submit" name="btnsubmituser" id="btnsubmituser" class="btn btn-info">
                <i class="fas fa-save"></i>&nbsp;Save Crime Record
            </button>
            @endcan
            <input type="hidden" id="recordID" name="recordID">
        </div>
    </form>
</div>
