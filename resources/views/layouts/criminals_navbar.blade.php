<div class="row nowrap rowsection">
    <ul class="nav nav-pills nav-pills-info" role="tablist">
      @can('Suspect-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('suspects')}}"  id="suspectslink">
            <i class="material-icons">fingerprint</i> Suspects
          </a>
        </li>
        @endcan
        @can('Station-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('stations')}}" id="stationlink" > 
            <i class="fas fa-exclamation-triangle"></i> &nbsp; Serious Crimes Suspects
          </a>
        </li>
        @endcan
        @can('Station-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('stations')}}" id="stationlink" > 
            <i class="material-icons">attach_money</i>Property and Financial Crimes Suspects
          </a>
        </li>
        @endcan
        @can('Station-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('stations')}}" id="stationlink" > 
            <i class="fas fa-flag"></i>&nbsp; Violent and Public Disorder Suspects
          </a>
        </li>
        @endcan
        @can('Officer-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('offiers')}}" id="officerslink" ><i class="fas fa-gavel navfasicon"></i>
            Convicted Criminals
          </a>
        </li>
        @endcan

      </ul>
</div>