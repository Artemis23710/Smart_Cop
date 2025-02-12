<div class="sidebar no-scrollbar" data-color="rose" data-background-color="black" id="sidemenu">
    <div class="sidebar-wrapper" id="sidebarwrapper">
        <div id="userlogin">
            <div id="userphoto">
                <img src="{{ asset('Images/avatar.jpg') }}" id="imguser" alt="User Image">
            </div>
            <div class="userinfo">
                <p class="username">{{ Auth::user()->name }}</p>
                <p class="designation">{{ Auth::user()->role->name }}</p>
            </div>
        </div>

        <table style="margin-left:45px;">
            <tr>
                <td><a href="{{ route('userprofile') }}"> <i class="material-icons" style="font-size:25px;">account_circle</i></a></td>
                <td><a href="{{ route('usersettings') }}"><i class="material-icons" style=" margin-left:40px; font-size:25px;">settings</i></a>
                </td>
                <td> <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        style="margin-left:40px;">
                        <i class="material-icons" style="font-size:25px;">logout</i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                </td>
            </tr>
        </table>
        <hr>
        <ul class="nav">
            <li class="list-nav">
                <a class="dashbordlink nav-link" href="{{ route('home')}}" id="dashbordlinks">
                    <i class="material-icons" id="sidebaricons">dashboard</i>
                    <p id="listtext"> Dashboard </p>
                </a>
            </li>
            @can('Access-Department')
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="{{ route('departmentdashboard')}}" id="departmentlink">
                    <i class="material-icons"  id="sidebaricons">groups</i>
                    <p id="listtext">Units & Personnel</p>
                </a>
            </li>
            @endcan
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="{{ route('crimedashboard')}}" id="crimelink">
                    <i class="material-icons " id="sidebaricons">gavel</i>
                    <p id="listtext"> Investigations </p>
                </a>
            </li>
            @can('Access-Criminal')
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="{{ route('criminaldashboard')}}" id="criminallink">
                    <i class="material-icons" id="sidebaricons">person_outline</i>
                    <p id="listtext"> Criminal </p>
                </a>
            </li>
            @endcan
          
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="{{ route('complaindashboard')}}" id="complainlink">
                    <i class="material-icons" id="sidebaricons">feedback</i>
                    <p id="listtext"> Complaints</p>
                </a>
            </li>

            @can('Access-Administrator')
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="{{ route('userdashbord')}}" id="adminlink">
                    <i class="material-icons" id="sidebaricons">admin_panel_settings</i>
                    <p id="listtext"> Administrator </p>
                </a>
            </li>
            @endcan
        
            
        </ul>
    </div>
</div>