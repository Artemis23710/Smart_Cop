<div class="row nowrap rowsection">
    <ul class="nav nav-pills nav-pills-info" role="tablist">
      @can('Investigation-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('missingpersioncomplains')}}"  id="missingpersonlink">
            <i class="material-icons">person_search</i>Missing Person Complaints
          </a>
        </li>
        @endcan
        
        @can('Ongoing-Investigation-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('othercomplains')}}" id="othercomplainslink" ><i class="material-icons">report_problem</i>  
           Other Complaints
          </a>
        </li>
        @endcan
      </ul>
</div>