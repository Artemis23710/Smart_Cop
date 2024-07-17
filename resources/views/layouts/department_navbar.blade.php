<div class="row nowrap rowsection">
    <ul class="nav nav-pills nav-pills-info" role="tablist">
      @can('Division-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('divisions')}}"  id="divisionlink">
            <i class="material-icons">group</i> Divisions
          </a>
        </li>
        @endcan
        @can('Station-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('stations')}}" id="stationlink" ><i class="material-icons">location_city</i>  
            Stations
          </a>
        </li>
        @endcan
      </ul>
</div>