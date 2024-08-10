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

          @endif
      </ul>
  </div>