<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smart Cop</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- bootstrap 5.3.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- material dashboard styles --}}
    <link rel="stylesheet" href="{{ asset('css/material-dashboard.css?v=2.1.2') }}">
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('css/sidebarstyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/topnavbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sectionnavbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bredcrumplist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bodystyle.css') }}">

     <style>
          .bootstrap-select .dropdown-menu li a:hover,
          .bootstrap-select .dropdown-menu li a:focus,
          .bootstrap-select .dropdown-menu li a.active {
              background-color: rgb(25, 101, 241) !important;
              color: white !important;
          }
                  .bootstrap-select .dropdown-menu .selected {
              background-color: (25, 101, 241);
              color: white !important;
          }
		.required::before {
		  content: '*';
		  color: red;
		  margin-right: 5px;
		}
        .requirednot{
            margin-left: 20px; 
        }
        .inputlabel{
            color: black;
        }
        
  </style>
    @livewireStyles
</head>
<body class="nav-fixed">
    <div id="app">

        @include('layouts.topnavbar')

        <div id="layoutSidenav">
            @include('layouts.sidebar')
        </div>
        <div class="main-panel">

            @yield('content')
            
            {{-- <footer class="footer">
              <div class="container-fluid">
                  <div class="copyright float-right">Copyright &copy; Smart Cop <?php echo date('Y') ?> Made with <i class="fa fa-heart pulse text-danger"></i>
                  </div>
              </div>
          </footer> --}}

        </div>
    </div>
    @livewireScripts

    @vite(['resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-ui/4.12.4/index.js" integrity="sha512-wEnX3bNd/CdyrOFR0KIGlHihK/w9x3/It8Vc18aymEF/F/f1q0Mq8T+GSxF1wYUACLEGECapuIYQdQlKY1LBJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    {{-- material dashboard scripts  --}}
    <script src="{{ url('/js/core/popper.min.js') }}"></script>
    <script src="{{ url('/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ url('/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ url('/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/js/plugins/bootstrap-selectpicker.js') }}"></script>
    <script src="{{ url('/js/plugins/sweetalert2.js') }}"></script>

    <script>

          function toggleFullscreen() {
            const fullscreenIcon = document.getElementById('fullscreen-icon');
            const exitFullscreenIcon = document.getElementById('exit-fullscreen-icon');

            if (fullscreenIcon.style.display === 'none') {
                fullscreenIcon.style.display = 'inline';
                exitFullscreenIcon.style.display = 'none';
                // Exit full-screen mode
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { /* Safari */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { /* IE11 */
                    document.msExitFullscreen();
                }
            } else {
                fullscreenIcon.style.display = 'none';
                exitFullscreenIcon.style.display = 'inline';
                // Enter full-screen mode
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.webkitRequestFullscreen) { /* Safari */
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) { /* IE11 */
                    document.documentElement.msRequestFullscreen();
                }
            }
        }
    </script>
   
  

@yield('script')
</body>
</html>
