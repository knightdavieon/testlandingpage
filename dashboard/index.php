<?php include('../controller/auth/manageSessions.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>FissionFlux Navigator | Dashboard</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../assets/adminlte-v4.0.0-beta2/dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet Draw CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
    <style>
        /* Responsive map container */
        /* html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        } */

        /* Ensure the map container is positioned correctly */
        #map {
            height: 700px;
            /* or whatever height is appropriate */
            width: 100%;
            position: relative;
            /* Ensure it’s positioned within its parent container */
            z-index: 1;
            /* Ensure it's above other elements */
        }


        /* Change color for warning icon */
        .swal2-warning .swal2-icon-content {
            color: #e30707;
            /* Set your desired color here */
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <script>
        var sessionUserType = <?php echo json_encode($_SESSION['userType']) ?>;
    </script>
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li>
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                    <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i class="bi bi-search"></i> </a> </li> <!--end::Navbar Search-->

                    <!--begin::Messages Dropdown Menu-->

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-chat-text"></i>
                            <span id="notification-badge" class="navbar-badge badge text-bg-danger">0</span>
                        </a>
                        <div id="notification-dropdown" class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <i class="user-image rounded-circle shadow nav-icon bi bi-person-circle"></i> <span class="d-none d-md-inline">USER</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img src="assets/adminlte-v4.0.0-beta2/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    USER - Web Developer
                                    <small>Member since Nov. 2023</small>
                                </p>
                            </li>
                            <!--end::User Image-->

                            <!--begin::Menu Body-->
                            <li class="user-footer">
                                <a href="#" id="logoutBtn" class="btn btn-default btn-flat float-end">Sign out</a>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li> <!--end::User Menu Dropdown-->
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="#" class="brand-link"> <!--begin::Brand Image <img src="assets/adminlte-v4.0.0-beta2/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> --> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">Navigator</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item"> <a href="/dashboard/" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a> </li>
                        <li class="nav-item"> <a href="/dashboard/" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                                <p>User</p>
                            </a> </li>
                        <li class="nav-item"> <a href="/dashboard/manageGeofence.php" class="nav-link"> <i class="nav-icon bi bi-link"></i>
                                <p>Manage Geofence</p>
                            </a> </li>
                        <li class="nav-item"> <a href="/dashboard/manageUser.php" class="nav-link"> <i class="nav-icon bi bi-link"></i>
                                <p>Manage Users</p>
                            </a> </li>
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->

                    <div class="row"> <!--begin::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>New Task</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z" />
                                    <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z" />
                                    <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z" />
                                </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i> </a>
                            </div> <!--end::Small Box Widget 1-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    <h3>53</h3>
                                    <p>Completed Task</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z" />
                                    <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z" />
                                    <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z" />
                                </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i> </a>
                            </div> <!--end::Small Box Widget 2-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                            <div class="small-box text-bg-warning">
                                <div class="inner">
                                    <h3>44<sup class="fs-5">%</sup></h3>
                                    <p>Task Completion Percentage</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg> <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i> </a>
                            </div> <!--end::Small Box Widget 3-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
                            <div class="small-box text-bg-danger">
                                <div class="inner">
                                    <h3>65</h3>
                                    <p>Unique Visitors</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"></path>
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"></path>
                                </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i> </a>
                            </div> <!--end::Small Box Widget 4-->
                        </div> <!--end::Col-->
                    </div>

                    <div class="row"> <!--begin::Col-->
                        <!-- place map here -->
                        <div class="col-lg-6 col-6"> <!--begin::Small Box Widget 1-->
                            <div id="map"></div>
                        </div>
                        <div class="col-lg-6 "> <!-- Info Boxes Style 2 -->
                            <div class="info-box mb-3 text-bg-warning"> <span class="info-box-icon"> <i class="bi bi-tag-fill"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Inventory</span> <span class="info-box-number">5,200</span> </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                            <div class="info-box mb-3 text-bg-success"> <span class="info-box-icon"> <i class="bi bi-heart-fill"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Mentions</span> <span class="info-box-number">92,050</span> </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                            <div class="info-box mb-3 text-bg-danger"> <span class="info-box-icon"> <i class="bi bi-cloud-download"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Downloads</span> <span class="info-box-number">114,381</span> </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                            <div class="info-box mb-3 text-bg-info"> <span class="info-box-icon"> <i class="bi bi-chat-fill"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Direct Messages</span> <span class="info-box-number">163,921</span> </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Geofence Usage</h3>
                                    <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button> </div>
                                </div> <!-- /.card-header -->
                                <div class="card-body"> <!--begin::Row-->
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="pie-chart" style="min-height: 355.7px;">
                                                <div id="apexchartsej12nzlw" class="apexcharts-canvas apexchartsej12nzlw apexcharts-theme-light" style="width: 488px; height: 355.7px;"><svg id="SvgjsSvg1889" width="488" height="355.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                                        <g id="SvgjsG1891" class="apexcharts-inner apexcharts-graphical" transform="translate(22, 0)">
                                                            <defs id="SvgjsDefs1890">
                                                                <clipPath id="gridRectMaskej12nzlw">
                                                                    <rect id="SvgjsRect1893" width="359" height="377" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                                </clipPath>
                                                                <clipPath id="forecastMaskej12nzlw"></clipPath>
                                                                <clipPath id="nonForecastMaskej12nzlw"></clipPath>
                                                                <clipPath id="gridRectMarkerMaskej12nzlw">
                                                                    <rect id="SvgjsRect1894" width="357" height="379" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                                </clipPath>
                                                            </defs>
                                                            <g id="SvgjsG1895" class="apexcharts-pie">
                                                                <g id="SvgjsG1896" transform="translate(0, 0) scale(1)">
                                                                    <circle id="SvgjsCircle1897" r="108.0268292682927" cx="176.5" cy="176.5" fill="transparent"></circle>
                                                                    <g id="SvgjsG1898" class="apexcharts-slices">
                                                                        <g id="SvgjsG1899" class="apexcharts-series apexcharts-pie-series" seriesName="Chrome" rel="1" data:realIndex="0">
                                                                            <path id="SvgjsPath1900" d="M 176.5 10.304878048780466 A 166.19512195121953 166.19512195121953 0 0 1 341.4833723927839 196.53260827462856 L 283.73919205530956 189.52119537850857 A 108.0268292682927 108.0268292682927 0 0 0 176.5 68.4731707317073 L 176.5 10.304878048780466 z" fill="rgba(13,110,253,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="96.92307692307692" data:startAngle="0" data:strokeWidth="2" data:value="700" data:pathOrig="M 176.5 10.304878048780466 A 166.19512195121953 166.19512195121953 0 0 1 341.4833723927839 196.53260827462856 L 283.73919205530956 189.52119537850857 A 108.0268292682927 108.0268292682927 0 0 0 176.5 68.4731707317073 L 176.5 10.304878048780466 z" stroke="#ffffff"></path>
                                                                        </g>
                                                                        <g id="SvgjsG1901" class="apexcharts-series apexcharts-pie-series" seriesName="Edge" rel="2" data:realIndex="1">
                                                                            <path id="SvgjsPath1902" d="M 341.4833723927839 196.53260827462856 A 166.19512195121953 166.19512195121953 0 0 1 216.27309601110787 337.86579375466147 L 202.3525124072201 281.3877659405299 A 108.0268292682927 108.0268292682927 0 0 0 283.73919205530956 189.52119537850857 L 341.4833723927839 196.53260827462856 z" fill="rgba(32,201,151,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="69.23076923076921" data:startAngle="96.92307692307692" data:strokeWidth="2" data:value="500" data:pathOrig="M 341.4833723927839 196.53260827462856 A 166.19512195121953 166.19512195121953 0 0 1 216.27309601110787 337.86579375466147 L 202.3525124072201 281.3877659405299 A 108.0268292682927 108.0268292682927 0 0 0 283.73919205530956 189.52119537850857 L 341.4833723927839 196.53260827462856 z" stroke="#ffffff"></path>
                                                                        </g>
                                                                        <g id="SvgjsG1903" class="apexcharts-series apexcharts-pie-series" seriesName="FireFox" rel="3" data:realIndex="2">
                                                                            <path id="SvgjsPath1904" d="M 216.27309601110787 337.86579375466147 A 166.19512195121953 166.19512195121953 0 0 1 66.29224894505427 300.8988350740948 L 104.86496181428527 257.35924279816163 A 108.0268292682927 108.0268292682927 0 0 0 202.3525124072201 281.3877659405299 L 216.27309601110787 337.86579375466147 z" fill="rgba(255,193,7,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="55.38461538461539" data:startAngle="166.15384615384613" data:strokeWidth="2" data:value="400" data:pathOrig="M 216.27309601110787 337.86579375466147 A 166.19512195121953 166.19512195121953 0 0 1 66.29224894505427 300.8988350740948 L 104.86496181428527 257.35924279816163 A 108.0268292682927 108.0268292682927 0 0 0 202.3525124072201 281.3877659405299 L 216.27309601110787 337.86579375466147 z" stroke="#ffffff"></path>
                                                                        </g>
                                                                        <g id="SvgjsG1905" class="apexcharts-series apexcharts-pie-series" seriesName="Safari" rel="4" data:realIndex="3">
                                                                            <path id="SvgjsPath1906" d="M 66.29224894505427 300.8988350740948 A 166.19512195121953 166.19512195121953 0 0 1 39.7240960439176 82.09041014082702 L 87.59566242854645 115.13376659153755 A 108.0268292682927 108.0268292682927 0 0 0 104.86496181428527 257.35924279816163 L 66.29224894505427 300.8988350740948 z" fill="rgba(214,51,132,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="83.07692307692307" data:startAngle="221.53846153846152" data:strokeWidth="2" data:value="600" data:pathOrig="M 66.29224894505427 300.8988350740948 A 166.19512195121953 166.19512195121953 0 0 1 39.7240960439176 82.09041014082702 L 87.59566242854645 115.13376659153755 A 108.0268292682927 108.0268292682927 0 0 0 104.86496181428527 257.35924279816163 L 66.29224894505427 300.8988350740948 z" stroke="#ffffff"></path>
                                                                        </g>
                                                                        <g id="SvgjsG1907" class="apexcharts-series apexcharts-pie-series" seriesName="Opera" rel="5" data:realIndex="4">
                                                                            <path id="SvgjsPath1908" d="M 39.7240960439176 82.09041014082702 A 166.19512195121953 166.19512195121953 0 0 1 136.72690398889208 15.13420624533859 L 150.64748759277984 71.61223405947008 A 108.0268292682927 108.0268292682927 0 0 0 87.59566242854645 115.13376659153755 L 39.7240960439176 82.09041014082702 z" fill="rgba(111,66,193,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-4" index="0" j="4" data:angle="41.53846153846155" data:startAngle="304.6153846153846" data:strokeWidth="2" data:value="300" data:pathOrig="M 39.7240960439176 82.09041014082702 A 166.19512195121953 166.19512195121953 0 0 1 136.72690398889208 15.13420624533859 L 150.64748759277984 71.61223405947008 A 108.0268292682927 108.0268292682927 0 0 0 87.59566242854645 115.13376659153755 L 39.7240960439176 82.09041014082702 z" stroke="#ffffff"></path>
                                                                        </g>
                                                                        <g id="SvgjsG1909" class="apexcharts-series apexcharts-pie-series" seriesName="IE" rel="6" data:realIndex="5">
                                                                            <path id="SvgjsPath1910" d="M 136.72690398889208 15.13420624533859 A 166.19512195121953 166.19512195121953 0 0 1 176.4709934793592 10.304880580076912 L 176.4811457615835 68.47317237704999 A 108.0268292682927 108.0268292682927 0 0 0 150.64748759277984 71.61223405947008 L 136.72690398889208 15.13420624533859 z" fill="rgba(173,181,189,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-5" index="0" j="5" data:angle="13.846153846153868" data:startAngle="346.15384615384613" data:strokeWidth="2" data:value="100" data:pathOrig="M 136.72690398889208 15.13420624533859 A 166.19512195121953 166.19512195121953 0 0 1 176.4709934793592 10.304880580076912 L 176.4811457615835 68.47317237704999 A 108.0268292682927 108.0268292682927 0 0 0 150.64748759277984 71.61223405947008 L 136.72690398889208 15.13420624533859 z" stroke="#ffffff"></path>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                            <line id="SvgjsLine1911" x1="0" y1="0" x2="353" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                            <line id="SvgjsLine1912" x1="0" y1="0" x2="353" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                                        </g>
                                                        <g id="SvgjsG1892" class="apexcharts-annotations"></g>
                                                    </svg>
                                                    <div class="apexcharts-legend apexcharts-align-center apx-legend-position-right" style="position: absolute; left: auto; top: 24px; right: 5px;">
                                                        <div class="apexcharts-legend-series" rel="1" seriesname="Chrome" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(13, 110, 253) !important; color: rgb(13, 110, 253); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Chrome" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Geofence 1</span></div>
                                                        <div class="apexcharts-legend-series" rel="2" seriesname="Edge" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(32, 201, 151) !important; color: rgb(32, 201, 151); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Edge" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Geofence 2</span></div>
                                                        <div class="apexcharts-legend-series" rel="3" seriesname="FireFox" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgb(255, 193, 7) !important; color: rgb(255, 193, 7); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="FireFox" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Geofence 3</span></div>
                                                        <div class="apexcharts-legend-series" rel="4" seriesname="Safari" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="4" data:collapsed="false" style="background: rgb(214, 51, 132) !important; color: rgb(214, 51, 132); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="4" i="3" data:default-text="Safari" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Geofence 4</span></div>
                                                        <div class="apexcharts-legend-series" rel="5" seriesname="Opera" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="5" data:collapsed="false" style="background: rgb(111, 66, 193) !important; color: rgb(111, 66, 193); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="5" i="4" data:default-text="Opera" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Geofence 5</span></div>
                                                        <div class="apexcharts-legend-series" rel="6" seriesname="IE" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="6" data:collapsed="false" style="background: rgb(173, 181, 189) !important; color: rgb(173, 181, 189); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="6" i="5" data:default-text="IE" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Geofence 6</span></div>
                                                    </div>
                                                    <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(13, 110, 253);"></span>
                                                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(32, 201, 151);"></span>
                                                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 193, 7);"></span>
                                                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="apexcharts-tooltip-series-group" style="order: 4;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(214, 51, 132);"></span>
                                                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="apexcharts-tooltip-series-group" style="order: 5;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(111, 66, 193);"></span>
                                                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="apexcharts-tooltip-series-group" style="order: 6;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(173, 181, 189);"></span>
                                                            <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                                                                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                                                                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /.col -->
                                    </div> <!--end::Row-->
                                </div> <!-- /.card-body -->
                                <div class="card-footer p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item"> <a href="#" class="nav-link">
                                                United States of America
                                                <span class="float-end text-danger"> <i class="bi bi-arrow-down fs-7"></i>
                                                    12%
                                                </span> </a> </li>
                                        <li class="nav-item"> <a href="#" class="nav-link">
                                                Philippines
                                                <span class="float-end text-success"> <i class="bi bi-arrow-up fs-7"></i> 4%
                                                </span> </a> </li>
                                    </ul>
                                </div> <!-- /.footer -->
                            </div> <!-- /.card --> <!-- PRODUCT LIST -->

                        </div>
                    </div> <!--end::Row--> <!--begin::Row-->

                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->
        <footer class="app-footer"> <!--begin::To the end-->
            <!-- <div class="float-end d-none d-sm-inline">Anything you want</div> end::To the end begin::Copyright  -->
            <strong>
                Copyright &copy; 2024&nbsp;
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> <!--end::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->



    <!-- 
    <h1>Geofencing Example with Drawing and Real-time Location Tracking</h1>
    <div id="map"></div> -->
    <!-- <button onclick="checkGeofence()">Check Geofence</button>
    <button onclick="displayGeofences()">Display Geofences</button> -->

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Draw JS -->
    <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
    <!-- Turf.js JS -->
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- geofence controls JavaScript -->
    <script src="../js/geofenceControlNoMapDraw.js"></script>
    <!-- logout controls JavaScript -->
    <script src="../js/logout.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../assets/adminlte-v4.0.0-beta2/dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to fetch notifications from the PHP backend
            function fetchNotifications() {
                fetch('../controller/notification/fetchNotifications.php') // Replace with your PHP file path
                    .then(response => response.json())
                    .then(data => {
                        console.log('Fetched data:', data); // Debugging line

                        const notificationBadge = document.getElementById('notification-badge');
                        const notificationDropdown = document.getElementById('notification-dropdown');

                        if (!data.data || !Array.isArray(data.data)) {
                            console.error('Unexpected data format:', data);
                            return;
                        }

                        // Clear existing notifications
                        notificationDropdown.innerHTML = '<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>';

                        // Update badge count
                        notificationBadge.textContent = data.data.length;

                        // Populate dropdown with notifications
                        data.data.forEach(data => {
                            const notificationItem = document.createElement('a');
                            notificationItem.href = '#';
                            notificationItem.classList.add('dropdown-item');
                            notificationItem.innerHTML = `
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="user-image rounded-circle shadow nav-icon bi bi-person-circle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    ${data.notif_from}
                                    <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                                </h3>
                                <p class="fs-7">${data.message}</p>
                                <p class="fs-7 text-secondary"><i class="bi bi-clock-fill me-1"></i>${data.timestamp}</p>
                            </div>
                        </div>
                    `;
                            notificationDropdown.insertBefore(notificationItem, notificationDropdown.firstChild);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching notifications:', error);
                    });
            }

            // Fetch notifications on page load
            fetchNotifications();
        });



        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script> <!-- sortablejs -->
    <script>
        const connectedSortables =
            document.querySelectorAll(".connectedSortable");
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: "shared",
                handle: ".card-header",
            });
        });

        const cardHeaders = document.querySelectorAll(
            ".connectedSortable .card-header",
        );
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = "move";
        });
    </script> <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script> <!-- ChartJS -->

    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script> <!-- jsvectormap -->

</body>

</html>