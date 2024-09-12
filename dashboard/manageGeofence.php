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

    <!-- bootstrap 5 datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css">
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
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li>
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                    <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i class="bi bi-search"></i> </a> </li> <!--end::Navbar Search--> <!--begin::Messages Dropdown Menu-->

                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <i class="user-image rounded-circle shadow nav-icon bi bi-person-circle"></i> <span class="d-none d-md-inline">USER</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img src="assets/adminlte-v4.0.0-beta2/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer
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
                            <h3 class="mb-0">Manage Geofences</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Manage Geofences
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!--begin::Col-->
                        <!-- place map here -->
                        <div class="col-lg-6 col-6"> <!--begin::Small Box Widget 1-->
                            <div class="card">
                                <table id="manageFence" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Page</th>
                                            <th>High Risk</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded here by DataTables -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Page</th>
                                            <th>High Risk</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6"> <!--begin::Small Box Widget 1-->
                            <div id="map"></div>
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
    <script src="../js/geofenceControlNoInGeoCheck.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../assets/adminlte-v4.0.0-beta2/dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>

    <!-- ../controller/manageGeofence/fetchGeofence.php -->

    <script>
        var table;

        function reloadTable() {
            if (table) {
                table.ajax.reload(null, false); // The second parameter set to false will not reset pagination
                console.log("table true");
            } else {
                console.error('Table is not initialized.');
            }
        }

        $(document).ready(function() {
            table = $('#manageFence').DataTable({
                ajax: {
                    url: '../controller/manageGeofence/fetchGeofence.php', // Adjust this path to your actual PHP script
                    dataSrc: 'data' // This specifies that the actual data is within the 'data' key
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'page'
                    },
                    {
                        data: 'high_risk'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: null,
                        defaultContent: '<button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button>'
                    }
                ]
            });

            // $('#manageFence').on('click', '.edit-btn', function() {
            //     var data = table.row($(this).parents('tr')).data();
            //     Swal.fire({
            //         title: 'Set Geofence Page',
            //         input: 'text',
            //         inputLabel: 'Enter new page value',
            //         inputValue: data.page || '', // Default to current value or empty
            //         showCancelButton: true,
            //         confirmButtonText: 'Set',
            //         cancelButtonText: 'Cancel',
            //         inputValidator: (value) => {
            //             if (!value) {
            //                 return 'You need to enter a value!';
            //             }
            //         }
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             var updatedValue = result.value;
            //             // You can now send this updated value to your server
            //             $.ajax({
            //                 url: '../controller/manageGeofence/updateGeofencepage.php', // Endpoint to handle the update
            //                 type: 'POST',
            //                 data: {
            //                     id: data.id,
            //                     page: updatedValue
            //                 },
            //                 success: function(response) {
            //                     // Optionally handle the response from the server
            //                     table.ajax.reload(); // Reload the table data
            //                 },
            //                 error: function(xhr, status, error) {
            //                     // Handle errors
            //                     Swal.fire('Error', 'Failed to update the page value.', 'error');
            //                 }
            //             });
            //         }
            //     });
            // });

            $('#manageFence').on('click', '.edit-btn', function() {
                var data = table.row($(this).parents('tr')).data();

                Swal.fire({
                    title: `Edit ${data.name} Details`,
                    html: `
                            <div class="form-group">
                                <label for="swal-input-page">Page Value</label>
                                <input id="swal-input-page" class="swal2-input" placeholder="Enter new page value" value="${data.page || ''}">
                            </div>
                            <div class="form-group">
                                <label for="swal-input-high-risk">High Risk</label>
                                <select id="swal-input-high-risk" class="swal2-select">
                                    <option value="Y" ${data.high_risk === 'Y' ? 'selected' : ''}>Y</option>
                                    <option value="N" ${data.high_risk === 'N' ? 'selected' : ''}>N</option>
                                </select>
                            </div>
                        `,
                    showCancelButton: true,
                    confirmButtonText: 'Set',
                    cancelButtonText: 'Cancel',
                    preConfirm: () => {
                        const pageValue = Swal.getPopup().querySelector('#swal-input-page').value;
                        const highRiskValue = Swal.getPopup().querySelector('#swal-input-high-risk').value;

                        if (!pageValue) {
                            Swal.showValidationMessage('You need to enter a page value!');
                            return false;
                        }

                        return {
                            page: pageValue,
                            high_risk: highRiskValue
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var {
                            page,
                            high_risk
                        } = result.value;

                        // Send the updated values to the server
                        $.ajax({
                            url: '../controller/manageGeofence/updateGeofencepage.php', // Endpoint to handle the update
                            type: 'POST',
                            data: {
                                id: data.id,
                                page: page,
                                high_risk: high_risk
                            },
                            success: function(response) {
                                // Optionally handle the response from the server
                                table.ajax.reload(); // Reload the table data
                            },
                            error: function(xhr, status, error) {
                                // Handle errors
                                Swal.fire('Error', 'Failed to update the geofence details.', 'error');
                            }
                        });
                    }
                });
            });


            $('#manageFence').on('click', '.delete-btn', function() {
                var data = table.row($(this).parents('tr')).data();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Implement your delete logic here
                        $.ajax({
                            url: '../controller/manageGeofence/deleteGeofence.php', // Endpoint to handle the deletion
                            type: 'POST',
                            data: {
                                id: data.id
                            },
                            success: function(response) {
                                // Optionally handle the response from the server
                                table.ajax.reload(); // Reload the table data
                                loadGeofences();

                                Swal.fire(
                                    'Deleted!',
                                    'Geofence has been deleted.',
                                    'success'
                                );
                            },
                            error: function(xhr, status, error) {
                                // Handle errors
                                Swal.fire('Error', 'Failed to delete the record.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>



    <script>
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

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script> <!-- ChartJS -->

    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script> <!-- jsvectormap -->

</body>

</html>