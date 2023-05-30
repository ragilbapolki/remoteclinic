<!-- <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
<!-- <title>Webkit | Responsive Bootstrap 4 Admin Dashboard Template</title> -->

<!-- Favicon -->
<link rel="shortcut icon" href="../theme/new/images/logosmallcobra.png" />
<link rel="stylesheet" href="../theme/new/css/backend-plugin.min.css">
<link rel="stylesheet" href="../theme/new/css/backend.css?v=1.0.0">
<link rel="stylesheet" href="../theme/new/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
<link rel="stylesheet" href="../theme/new/vendor/remixicon/fonts/remixicon.css">

<link rel="stylesheet" href="../theme/new/vendor/fontawesome-free-6.3.0-web/css/all.min.css">


<link rel="stylesheet" href="../theme/new/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
<link rel="stylesheet" href="../theme/new/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
<link rel="stylesheet" href="../theme/new/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">

<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="../theme/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="../theme/css/bootstrap-theme.min.css"> -->
<link rel="stylesheet" href="../theme/css/main.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- <script src="../theme/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->

</head>


<body class="  ">
    <?php
    $rerer = $global_permission->portal_name;
    if (if_logged_in() == true) :
    ?>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>


    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        <?php include "../theme/sidebar.php"; ?>
        <div class="iq-top-navbar">


            <div class="iq-navbar-custom mt-2">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="../dashboard" class="header-logo">
                            <h4 class="logo-title text-uppercase"> <img src="../theme/new/images/logocobra.png"
                                    class="img-fluid image-right" alt=""></h4>

                        </a>
                    </div>
                    <!-- <div class="navbar-breadcrumb">
            <h5>Dashboard</h5>
        </div> -->
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li>
                                    <div class="iq-search-bar device-search">
                                        <form action="../search" method="GET" class="searchbox">
                                            <!-- <a class="search-link" name="searchme" href="../search"><i class="ri-search-line"></i></a> -->
                                            <input type="text" class="text search-input" name="searchme"
                                                placeholder="Enter untuk pencarian...">
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon search-content">
                                    <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-search-line"></i>
                                    </a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu"
                                        aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12"
                                                    placeholder="type here to search...">
                                                <a href="#" class="search-link"><i class="las la-search"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </li>


                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center"
                                        id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <!-- <img src="" class="img-fluid rounded-circle" alt="user"> -->
                                        <!-- <img src="../media/<?php echo staff_info("id"); ?>.png"> -->
                                        <div class="caption ml-3">
                                            <h6 class="mb-0 line-height"> <?php echo staff_info("full_name"); ?> <i
                                                    class="las la-angle-down ml-2"></i>
                                            </h6>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right border-none"
                                        aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-item d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <a href="../staff/my-profile.php">My Profile</a>
                                        </li>



                                        <li class="dropdown-item  d-flex svg-icon border-top">
                                            <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <a href="../login/signout.php">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                </nav>

            </div>

            <?php endif; ?>