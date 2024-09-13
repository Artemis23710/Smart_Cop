<div class="row nowrap rowsection">
    <ul class="nav nav-pills nav-pills-info" role="tablist">
      @can('Division-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('investigations')}}"  id="investigationlink">
            <i class="material-icons">search_off</i>Investigation
          </a>
        </li>
        @endcan
        @can('Station-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('stations')}}" id="ongoinginvetigationlink" ><i class="material-icons">hourglass_top</i>  
            Ongoing Investigations
          </a>
        </li>
        @endcan
        @can('Officer-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('offiers')}}" id="closedinvestigationlink" ><i class="material-icons">check_circle  </i>  
            Closed Investigations
          </a>
        </li>
        @endcan

        @can('Officer-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('offiers')}}" id="crimeanalizelink" ><i class="material-icons">insights</i>  
          Crime Analizer
          </a>
        </li>
        @endcan

      </ul>
</div>