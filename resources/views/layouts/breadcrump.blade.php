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



           @elseif(request()->route()->getName() == 'criminalproperty')
           <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
           <li><a href="#2"><i class="material-icons">person_outline</i> Criminals</a></li>
           <li><a href="#3"><i class="material-icons">attach_money</i>Property and Financial Crimes Suspects</a></li>



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
          @endif
      </ul>
  </div>