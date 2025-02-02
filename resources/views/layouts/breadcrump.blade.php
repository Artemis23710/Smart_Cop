<div id="crumbs">
      <ul>

         @if(request()->route()->getName() == 'home')

          <li><a href="#1"> <i class="material-icons">dashboard</i>Dashboard</a></li>

          {{-- admininstrator section --}}
          
          @elseif(request()->route()->getName() == 'userdashbord')
          <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="#2"><i class="material-icons">admin_panel_settings</i> Administrator</a></li>
          <li><a href="#3"><i class="material-icons">people</i> Users</a></li>

          @elseif(request()->route()->getName() == 'rolelists')
          <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="#2"><i class="material-icons">admin_panel_settings</i> Administrator</a></li>
          <li><a href="#3"><i class="material-icons">admin_panel_settings</i> Roles</a></li>

          @elseif(request()->route()->getName() == 'permisionlist')
          <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="#2"><i class="material-icons">admin_panel_settings</i> Administrator</a></li>
          <li><a href="#3"><i class="material-icons">security</i> Privileges</a></li>
          @elseif(request()->route()->getName() == 'addpermision')
          <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="#2"><i class="material-icons">admin_panel_settings</i> Administrator</a></li>
          <li><a href="#3"><i class="material-icons">security</i> Privileges</a></li>
          <li><a href="#3"><i class="material-icons">add</i>Add Privileges</a></li>
          

           {{-- Department section --}}
           @elseif(request()->route()->getName() == 'departmentdashboard')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">groups</i> Units & Personnel</a></li>

           @elseif(request()->route()->getName() == 'divisions')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">groups</i> Units & Personnel</a></li>
           <li><a href="#3"><i class="material-icons">group</i> Divisions</a></li>

           @elseif(request()->route()->getName() == 'stations')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">groups</i> Units & Personnel</a></li>
           <li><a href="#3"><i class="material-icons">location_city</i> Stations</a></li>

           @elseif(request()->route()->getName() == 'offiers')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">groups</i> Units & Personnel</a></li>
           <li><a href="#3"><i class="fas fa-user-tie fasicons" ></i> Officers</a></li>
           @elseif(request()->route()->getName() == 'newoffiers')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">groups</i> Units & Personnel</a></li>
           <li><a href="#3"><i class="fas fa-user-tie fasicons" ></i> Officers</a></li>
           <li><a href="#3"><i class="fas fa-plus fasicons" ></i> Add New Officers</a></li>

           @elseif(request()->route()->getName() == 'viewofficer')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">groups</i> Units & Personnel</a></li>
           <li><a href="#3"><i class="fas fa-user-tie fasicons" ></i> Officers</a></li>
           <li><a href="#3"><i class="material-icons">visibility</i> View Officers Information</a></li>

           @elseif(request()->route()->getName() == 'offieredit')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">groups</i> Units & Personnel</a></li>
           <li><a href="#3"><i class="fas fa-user-tie fasicons" ></i> Officers</a></li>
           <li><a href="#3"><i class="material-icons">edit</i> Edit Officers Information</a></li>

           {{-- Criminal section --}}
           @elseif(request()->route()->getName() == 'criminaldashboard')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>

           @elseif(request()->route()->getName() == 'suspects')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"> <i class="material-icons">fingerprint</i> Suspects</a></li>

           @elseif(request()->route()->getName() == 'newsuspects')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"> <i class="material-icons">fingerprint</i> Suspects</a></li>
           <li><a href="#3"><i class="fas fa-plus fasicons" ></i> Add New Suspects</a></li>

           @elseif(request()->route()->getName() == 'suspectsedit')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"> <i class="material-icons">fingerprint</i> Suspects</a></li>
           <li><a href="#3"><i class="material-icons">edit</i> Edit Suspects Information</a></li>



          @elseif(request()->route()->getName() == 'criminalserious')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"> <i class="fas fa-exclamation-triangle"></i> Serious Crimes Suspects</a></li>

           @elseif(request()->route()->getName() == 'criminalseriousview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"> <i class="fas fa-exclamation-triangle"></i> Serious Crimes Suspects</a></li>
           <li><a href="#4"> <i class="fas fa-eye"></i>&nbsp;View Serious Crimes Suspects</a></li>



           @elseif(request()->route()->getName() == 'criminalproperty')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="material-icons">attach_money</i>Property and Financial Crimes Suspects</a></li>

           @elseif(request()->route()->getName() == 'criminalpropertyview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="material-icons">attach_money</i>Property and Financial Crimes Suspects</a></li>
           <li><a href="#4"> <i class="fas fa-eye"></i>&nbsp;View Property and Financial Crimes Suspects</a></li>


           @elseif(request()->route()->getName() == 'criminalviolent')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3">  <i class="fas fa-flag"></i>&nbsp;Violent and Public Disorder Suspects</a></li>

           @elseif(request()->route()->getName() == 'criminalviolentview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"> <i class="fas fa-flag"></i>&nbsp;Violent and Public Disorder Suspects</a></li>
           <li><a href="#4"> <i class="fas fa-eye"></i>&nbsp;View Violent and Public Disorder Suspects</a></li>


           @elseif(request()->route()->getName() == 'criminalother')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="fas fa-question-circle"></i> Suspects of Other Crime</a></li>

           @elseif(request()->route()->getName() == 'criminalotherview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="fas fa-question-circle"></i> Suspects of Other Crime</a></li>
           <li><a href="#4"> <i class="fas fa-eye"></i>&nbsp;View Other Crime Suspects</a></li>

           @elseif(request()->route()->getName() == 'convictedcriminals')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="fas fa-gavel navfasicon"></i> Convicted Criminals</a></li>

           @elseif(request()->route()->getName() == 'convictedcriminalsview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="fas fa-gavel navfasicon"></i> Convicted Criminals</a></li>
           <li><a href="#3"><i class="fas fa-eye"></i>&nbsp; View Convicted Criminals</a></li>

           @elseif(request()->route()->getName() == 'criminalview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="fas fa-eye"></i>&nbsp; View Criminal</a></li>
           
           {{-- Investigation section --}}
           @elseif(request()->route()->getName() == 'crimedashboard')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">search_off</i> Investigation</a></li>

           @elseif(request()->route()->getName() == 'investigations')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">search_off</i> Investigation</a></li>

           @elseif(request()->route()->getName() == 'newinvestigation')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">search_off</i> Investigation</a></li>
           <li><a href="#3"><i class="fas fa-plus fasicons" ></i> New Investigation</a></li>

           @elseif(request()->route()->getName() == 'investigationsedit')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">search_off</i> Investigation</a></li>
           <li><a href="#3"><i class="material-icons">edit</i> Edit Investigation</a></li>

           @elseif(request()->route()->getName() == 'ongoinginvestigations')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">hourglass_top</i> Ongoing Investigations</a></li>

           @elseif(request()->route()->getName() == 'ongoinginvestigationview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">hourglass_top</i> Ongoing Investigations</a></li>
           <li><a href="#3"><i class="fas fa-eye"></i>&nbsp; View Ongoing Investigation</a></li>

           @elseif(request()->route()->getName() == 'closedinvestigations')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">check_circle</i> Closed Investigations</a></li>

           @elseif(request()->route()->getName() == 'closedinvestigationsviewapprove')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">check_circle</i> Closed Investigations</a></li>
           <li><a href="#3"><i class="fas fa-eye"></i>&nbsp; View Approve Investigation</a></li>

           @elseif(request()->route()->getName() == 'closedinvestigationsview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#3"><i class="material-icons">check_circle</i> Closed Investigations</a></li>
           <li><a href="#3"><i class="fas fa-eye"></i>&nbsp; View Closed Investigation</a></li>

           @elseif(request()->route()->getName() == 'crimeview')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">search_off</i> Investigation</a></li>
           <li><a href="#3"><i class="fas fa-eye"></i>&nbsp; View Investigation</a></li>

           @elseif(request()->route()->getName() == 'crimeanalizer')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">gavel</i> Investigations</a></li>
           <li><a href="#2"><i class="material-icons">insights</i>Crime Analizer</a></li>

           @elseif(request()->route()->getName() == 'complaindashboard')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">feedback</i> Complaints</a></li>

           @elseif(request()->route()->getName() == 'missingpersioncomplains')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">feedback</i> Complaints</a></li>
           <li><a href="#2"><i class="material-icons">person_search</i>Missing Person Complaints</a></li>

           @elseif(request()->route()->getName() == 'othercomplains')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">feedback</i> Complaints</a></li>
           <li><a href="#2"><i class="material-icons">report_problem</i>  Other Complaints</a></li>

           @elseif(request()->route()->getName() == 'newmissingcomplains')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">feedback</i> Complaints</a></li>
           <li><a href="#2"><i class="material-icons">person_search</i>Missing Person Complaints</a></li>
           <li><a href="#3"><i class="fas fa-plus fasicons" ></i> New Missing Person Complaints</a></li>

           @elseif(request()->route()->getName() == 'newothercomplains')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">feedback</i> Complaints</a></li>
           <li><a href="#2"><i class="material-icons">report_problem</i>  Other Complaints</a></li>
           <li><a href="#3"><i class="fas fa-plus fasicons" ></i> New Other Complaints</a></li>

           @elseif(request()->route()->getName() == 'missingpersioncomplainsedit')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">feedback</i> Complaints</a></li>
           <li><a href="#2"><i class="material-icons">person_search</i>Missing Person Complaints</a></li>
           <li><a href="#3"><i class="material-icons">edit</i> Edit Missing Person Complaints</a></li>

           @elseif(request()->route()->getName() == 'othercomplainsedit')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">feedback</i> Complaints</a></li>
           <li><a href="#2"><i class="material-icons">report_problem</i>  Other Complaints</a></li>
           <li><a href="#3"><i class="material-icons">edit</i> Edit Other Complaints</a></li>
          @endif
      </ul>
  </div>