<div class="sidebar no-scrollbar" data-color="rose" data-background-color="black" style="background-color:white;">
    <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-mini" id="sidebartext">
            SC
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal " id="sidebartext">
            Smart Cop
        </a></div>
    <div class="sidebar-wrapper">
        <div id="userlogin">
            <div id="userphoto">
                <img src="{{ asset('Images/avatar.jpg') }}" id="imguser" alt="User Image">
            </div>
            <div class="userinfo">
                <p class="username">John Doe</p>
                <p class="designation">Administrator</p>
            </div>
        </div>

        <table style="margin-left:45px;">
            <tr>
                <td><a href="#"> <i class="material-icons" style="font-size:25px;">account_circle</i></a></td>
                <td><a href="#"><i class="material-icons" style=" margin-left:40px; font-size:25px;">settings</i></a>
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
                <a class="dashbordlink nav-link" href="#" id="dashbordlinks">
                    <i class="material-icons" id="sidebaricons">dashboard</i>
                    <p id="listtext"> Dashboard </p>
                </a>
            </li>
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="../examples/widgets.html" id="departmentlink">
                    <i class="material-icons" id="sidebaricons">business</i>
                    <p id="listtext">Departments</p>
                </a>
            </li>
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="../examples/charts.html" id="criminallink">
                    <i class="material-icons" id="sidebaricons">person_outline</i>
                    <p id="listtext"> Criminal </p>
                </a>
            </li>
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="../examples/charts.html" id="crimelink">
                    <i class="material-icons " id="sidebaricons">gavel</i>
                    <p id="listtext"> Crime </p>
                </a>
            </li>
            <li class="list-nav">
                <a class="nav-link dashbordlink" href="../examples/calendar.html" id="adminlink">
                    <i class="material-icons" id="sidebaricons">admin_panel_settings</i>
                    <p id="listtext"> Administrator </p>
                </a>
            </li>
        </ul>


    </div>
</div>