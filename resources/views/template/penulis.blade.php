<?php
    use App\User;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="material/assets/images/favicon.png">
    <title>SupiKulupid</title>
    <!-- Bootstrap Core CSS -->
    <link href="material/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="material/assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="material/assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="material/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="material/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="material/lite/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="material/lite/css/colors/blue.css" id="theme" rel="stylesheet">
    @yield('header')
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
   
    <div id="main-wrapper">    
        <header class="topbar fixed">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
               
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <img src="material/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        <span color="white"> SipuKulupid</span> 
                    </a>
                </div>
        
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="material/assets/images/users/1.jpg" alt="user" class="profile-pic m-r-10" />{{ Auth::user()->username }}
                        </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="/home" aria-expanded="false"><i class="mdi mdi-gauge" active></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/postingan_penulis" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Postingan</span></a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="sidebar-footer">
                <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power" ></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form> 
            </div>
        </aside>
       
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        @yield('breadcrumb')
                    </div>
                </div>
                @yield('content')
            </div>
            <footer class="footer"> © 2017 Material Pro Admin by wrappixel.com </footer>
        </div>
      
    </div>

    <script src="material/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="material/assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="material/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="material/lite/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="material/lite/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="material/lite/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <!-- <script src="material/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script> -->
    <!--Custom JavaScript -->
    <script src="material/lite/js/custom.min.js"></script>
    <!-- chartist chart -->
    <!-- <script src="material/assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="material/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script> -->
    <!--c3 JavaScript -->
    <script src="material/assets/plugins/d3/d3.min.js"></script>
    <script src="material/assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <!-- <script src="material/lite/js/dashboard1.js"></script> -->
    @yield('footer')
</body>

</html>
