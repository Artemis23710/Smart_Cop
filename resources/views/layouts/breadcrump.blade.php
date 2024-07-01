<div id="crumbs">
      <ul>

         @if(request()->route()->getName() == 'home')

          <li><a href="#1"> <i class="material-icons">dashboard</i>Dashboard</a></li>

          {{-- admininstrator section --}}
          
          @elseif(request()->route()->getName() == 'userdashbord')
          <li><a href="#1"><i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="#2"><i class="material-icons">admin_panel_settings</i> Administrator</a></li>
          <li><a href="#3"><i class="material-icons">people</i> Users</a></li>
          @endif
      </ul>
  </div>