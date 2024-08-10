<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navtop" style=" position: fixed;  top: 0; width: 100%; z-index: 1000;">
    <div class="container-fluid" id="topnav_container">

      <div class="logo" id="systemlogo">
        <a href="#" class="simple-text logo-mini" id="sidebartext"><img src="{{ asset('Images/Logo.png') }}" id="systemlogoicon"></a>
    <a href="#" class="simple-text logo-normal " id="sidebartext">
        Smart Cop
    </a></div>
      <div class="navbar-wrapper">
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
          </button>
        </div>
      </div>


      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>

      @include('layouts.breadcrump')

      <div class="collapse navbar-collapse  justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item">
                <button  class="nav-link">
                   <i class="material-icons"  id="fullscreen-icon" onclick="toggleFullscreen()">fullscreen</i>
                   <i class="material-icons" style="display: none;" id="exit-fullscreen-icon" onclick="toggleFullscreen()">fullscreen_exit</i>
                 </button>
             </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">notifications</i>
              <p class="d-lg-none d-md-block">
                Some Actions
              </p>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Mike John responded to your email</a>
              <a class="dropdown-item" href="#">You have 5 new tasks</a>
              <a class="dropdown-item" href="#">You're now friend with Andrew</a>
              <a class="dropdown-item" href="#">Another Notification</a>
              <a class="dropdown-item" href="#">Another One</a>
            </div>
          </li>
          <li class="nav-item dropdown" id="loginuser_section">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="usernametext">{{ Auth::user()->name }}</span>
                    <img src="{{ asset('Images/avatar.jpg') }}" id="userimage">
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                <a class="dropdown-item" href="#"> <i class="material-icons" style="font-size:25px;">account_circle</i> <span style=" margin-left:5px;">Account </span></a>
                <a class="dropdown-item" href="#"><i class="material-icons" style="font-size:25px;">settings</i> <span style=" margin-left:5px;">Settings </span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons" style="font-size:25px;">logout</i> <span style=" margin-left:5px;">Logout
                    </span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
            </div>
          </li>

         
        </ul>
      </div>

    </div>
  </nav>