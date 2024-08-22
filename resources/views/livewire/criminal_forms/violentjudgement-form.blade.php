<div>
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-4 required">
                <label class="inputlabel">Arrested Crime</label>
                <select class="selectpicker" data-style="select-with-transition" title="Arrested Crime" name="arrestedcrime" id="arrestedcrime" required>
                    @foreach($crimelist as $crimel)
                    <option value="{{ $crimel->id }}">{{$crimel->crime}}</option>
                @endforeach
            </select>
            </div>
            <div class="col-4 required">
                <label class="inputlabel">Arrested Date</label>
                <input type="date" class="form-control" id="arresteddate" name="arresteddate" required>
            </div>
            <div class="col-4 required">
                <label class="inputlabel">Arrested Station</label>
                <select class="selectpicker" data-style="select-with-transition" title="Arrested Station" name="arrestedpolice" id="arrestedpolice" required>
                    @foreach($stationlist as $station)
                    <option value="{{ $station->id }}">{{$station->station_name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3 required">
                <label class="inputlabel">Day of Gave Judgment</label>
                <input type="date" class="form-control" id="datejudgement" name="datejudgement" required>
            </div>

            <div class="col-3 required">
                <label class="inputlabel">Verdict</label>
                
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="judgement" id="judnotconvicted"
                            value="Not Guilty"><label class="inputlabel" for="judnotconvicted">Not Guilty</label>
                        <span class="circle"><span class="check"></span></span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="judgement" value="Found Guilty"
                            id="judconvicted"><label class="inputlabel" for="judconvicted">Found Guilty</label>
                        <span class="circle"> <span class="check"></span></span>
                    </label>
                </div>
                
                </select>
            </div>

            <div class="col-6" id="peneltysection">
                <label class="inputlabel">Penalty</label>
                <input type="text" class="form-control" id="penelty" name="penelty">
            </div>
        </div>
        <br>
        <div class="col-12">
            <label class="inputlabel"> Judgment Summary</label>
            <textarea name="incidentnote"class="form-control" cols="20" rows="5"></textarea>
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
                <i class="fas fa-save"></i>&nbsp;Save Verdict Record
            </button>
            @endcan
            <input type="hidden" id="recordID" name="recordID">
            <input type="hidden" id="crimerecordID" name="crimerecordID">
        </div>
    </form>
</div>
