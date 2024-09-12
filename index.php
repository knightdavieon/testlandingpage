<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FissionFlux Navigator | Login Page</title>
    <meta name="description" content="Login page for FissionFlux Navigator">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">

    <!-- Third-Party Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">

    <!-- AdminLTE Styles -->
    <link rel="stylesheet" href="assets/adminlte-v4.0.0-beta2/dist/css/adminlte.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .loginAlert {
            display: none; /* Initially hide the alert */
        }
    </style>
</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>FissionFlux</b> Navigator</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in</p>
                <form id="loginForm" method="POST">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mt-3 loginAlert" id="loginAlert">
                    <div class="alert alert-danger" role="alert">
                        <strong>Session Invalid:</strong> Please enter valid credentials
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="assets/adminlte-v4.0.0-beta2/dist/js/adminlte.js"></script>
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- OverlayScrollbars Configuration -->
    <script>
        // Pass the PHP session variable to JavaScript $_SESSION['user_id']
        var triedToAccess = <?php echo json_encode(isset($_SESSION['triedToAccess'])  ? $_SESSION['triedToAccess'] : ''); ?>;
        var loggedIn = <?php echo json_encode(isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : ''); ?>

        // JavaScript logic to show the alert based on the session variable
        document.addEventListener('DOMContentLoaded', function() {
            if (triedToAccess == true  && loggedIn == false) {
                var alertElement = document.getElementById('loginAlert');
                if (alertElement) {
                    alertElement.style.display = 'block';
                }
            }
        });
        <?php $_SESSION['triedToAccess'] = false; ?>

        document.addEventListener("DOMContentLoaded", function() {
            // Initialize OverlayScrollbars
            const sidebarWrapper = document.querySelector(".sidebar-wrapper");
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined") {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: "os-theme-light",
                        autoHide: "leave",
                        clickScroll: true,
                    },
                });
            }

            // Form submission handling
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                const formData = new FormData(document.getElementById('loginForm'));

                fetch('controller/auth/login.php', {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'dashboard/'; // Redirect to a secure page
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'Try Again'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while processing your request.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    });
            });
        });
    </script>

</body>

</html>