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
                            <h3 class="mb-0">Manage Users</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Manage Users
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
                                <form action="" id="createUser">
                                    <div class="card-header">
                                        <h4>Create User</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Type</label>
                                            <select class="form-select" aria-label="Default select example" id="type" name="type">

                                                <option value="admin">Admin</option>
                                                <option value="sme">SME</option>
                                                <option value="employee">Employee</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6"> <!--begin::Small Box Widget 1-->
                            <div class="card">
                                <table id="manageUser" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded here by DataTables -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
    <!-- logout controls JavaScript -->
    <script src="../js/logout.js"></script>

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

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('createUser');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to submit this form?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData(form);

                        fetch('../controller/manageUser/addUser.php', { // Replace with your server endpoint
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                table.ajax.reload();
                                form.reset();
                                Swal.fire('Success!', 'Your form has been submitted.', 'success');
                                // Optionally, handle response here
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'There was an error submitting your form.', 'error');
                            });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire('Cancelled', 'Your form submission was cancelled.', 'error');
                    }
                });
            });
        });

        $(document).ready(function() {
            table = $('#manageUser').DataTable({
                ajax: {
                    url: '../controller/manageUser/fetchUser.php', // Adjust this path to your actual PHP script
                    dataSrc: 'data' // This specifies that the actual data is within the 'data' key
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'firstname'
                    },
                    {
                        data: 'lastname'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'usertype'
                    },
                    {
                        data: null,
                        defaultContent: '<button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button>'
                    }
                ]
            });

            $('#manageUser').on('click', '.edit-btn', function() {
                var data = table.row($(this).parents('tr')).data();

                Swal.fire({
                    title: `Edit ${data.name} Details`,
                    html: `
                            <div class="form-group">
                                <label for="swal-input-email">Page Value</label>
                                <input id="swal-input-email" class="swal2-input" placeholder="Enter new page value" value="${data.email || ''}">
                            </div>
                            <div class="form-group">
                                <label for="swal-input-usertype">High Risk</label>
                                <select id="swal-input-usertype" class="swal2-select">
                                    <option value="admin" ${data.usertype === 'admin' ? 'selected' : ''}>Admin</option>
                                    <option value="sme" ${data.usertype === 'sme' ? 'selected' : ''}>SME</option>
                                    <option value="employee" ${data.usertype === 'employee' ? 'selected' : ''}>Employee</option>
                                </select>
                            </div>
                        `,
                    showCancelButton: true,
                    confirmButtonText: 'Set',
                    cancelButtonText: 'Cancel',
                    preConfirm: () => {
                        const emailValue = Swal.getPopup().querySelector('#swal-input-email').value;
                        const usertypeValue = Swal.getPopup().querySelector('#swal-input-usertype').value;

                        if (!emailValue) {
                            Swal.showValidationMessage('You need to enter a page value!');
                            return false;
                        }

                        return {
                            email: emailValue,
                            usertype: usertypeValue
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var {
                            email,
                            usertype
                        } = result.value;

                        // Send the updated values to the server
                        $.ajax({
                            url: '../controller/manageUser/updateUser.php', // Endpoint to handle the update
                            type: 'POST',
                            data: {
                                id: data.id,
                                email: email,
                                usertype: usertype
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


            $('#manageUser').on('click', '.delete-btn', function() {
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
                            url: '../controller/manageUser/deleteUser.php', // Endpoint to handle the deletion
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
                                    'User has been deleted.',
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