<div class="row nowrap rowsection">
    <ul class="nav nav-pills nav-pills-info" role="tablist">
      @can('User-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('userdashbord')}}"  id="userlink">
            <i class="material-icons">people</i> Users
          </a>
        </li>
        @endcan
        @can('Role-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('rolelists')}}" id="rolelink" ><i class="material-icons">admin_panel_settings</i>  
            Roles
          </a>
        </li>
        @endcan
        @can('Permission-List')
        <li class="nav-item">
          <a class="nav-link navbutton"  href="{{ route('permisionlist')}}" id="privilegeslink" > <i class="material-icons">security</i>
            Privileges
          </a>
        </li>
        @endcan
      </ul>
</div>