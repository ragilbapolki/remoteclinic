<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <title>Webkit | Responsive Bootstrap 4 Admin Dashboard Template</title> -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="../theme/new/images/logosmallcobra.png" />
    <link rel="stylesheet" href="../theme/new/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../theme/new/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../theme/new/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../theme/new/vendor/remixicon/fonts/remixicon.css">

    <link rel="stylesheet" href="../theme/new/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../theme/new/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../theme/new/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
</head>

<?php
require_once "../pre-includes/all.php";

$invalid = false;
$expired = false;
$error = false;
$blocked = false;
$revoked = false;
$password = false;
$signout = false;

soft_singout();

if (isset($_GET['status'])) {
    $show_status = $_GET['status'];

    if ($show_status == "invalid") {
        $invalid = true;
    } else if ($show_status == "error") {
        $error = true;
    } else if ($show_status == "expired") {
        $expired = true;
    } else if ($show_status == "blocked") {
        $blocked = true;
    } else if ($show_status == "revoked") {
        $revoked = true;
    } else if ($show_status == "password") {
        $password = true;
    } else if ($show_status == "signout") {
        $signout = true;
    } else { /* action */
    }
}

//include "../theme/htmlhead.php";
echo "<title>" . get_global('portal_name') . "</title>";
//include "../theme/header.php";


?>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->

<div class="wrapper">


    <section class="login-content">
        <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">

                    <?php
                    if ($invalid == true) { ?><div class="alert alert-danger" role="alert">Invalid User/Password.</div>
                    <?php
                    }
                    if ($expired == true) { ?>
                    <?php
                    }
                    if ($error == true) { ?><div class="alert alert-danger" role="alert">Sorry, we were unable to log
                            you in.
                            Please
                            contact
                            your administrator.</div>
                    <?php
                    }
                    if ($blocked == true) { ?><div class="alert alert-danger" role="alert">Access Denied! - Please
                            contact your
                            administrator.
                        </div>
                    <?php
                    }
                    if ($revoked == true) { ?><div class="alert alert-danger" role="alert">Access Denied! - All offices
                            are
                            closed.
                        </div>

                    <?php
                    }
                    if ($password == true) { ?><div class="alert alert-success" role="alert">Password successfully
                            updated.
                            Please
                            singin using
                            your new password.</div>
                    <?php
                    }
                    if ($signout == true) { ?><div class="alert alert-success" role="alert">You have successfully
                            logged out.
                        </div>
                    <?php } ?>

                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                                <div class="col-lg-6 bg-primary content-left">
                                    <div class="p-3">
                                        <h2 class="mb-2 text-white">Remote Clinic</h2>
                                        <p>Login to stay connected.</p>
                                        <form method="post" action="process.php">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" type="email" id="user_id" name="user_id" placeholder=" ">
                                                        <label>Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" type="password" id="password" name="password" placeholder=" ">
                                                        <label>Password</label>


                                                    </div>
                                                </div>
                                                <!-- <div class="col-lg-6">
                                                    <div class="custom-control custom-checkbox mb-3">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1">
                                                        <label class="custom-control-label control-label-1 text-white"
                                                            for="customCheck1">Remember Me</label>
                                                    </div>
                                                </div> -->
                                                <!-- <div class="col-lg-6">
                                                    <a href="auth-recoverpw.html" class="text-white float-right">Forgot
                                                        Password?</a>
                                                </div> -->
                                            </div>
                                            <input id="extra_key" name="extra_key" type="hidden" value="<?php echo md5(date('A  D, M jS, Y')); ?>">
                                            <button type="submit" class="btn btn-white" input name="submit">Login
                                            </button>
                                            <!-- 
											<input id="extra_key" name="extra_key" type="hidden" value="<?php echo md5(date('A  D, M jS, Y')); ?>">
											<input name="submit" class="btn btn-default formbutton theme-portal" type="submit" value="Login"> -->
                                            <!-- 
                                            <p class="mt-3">
                                                Create an Account <a href="auth-sign-up.html"
                                                    class="text-white text-underline">Sign Up</a>
                                            </p> -->
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 content-right">
                                    <img src="../theme/new/images/logocobra.png" class="img-fluid image-right" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Backend Bundle JavaScript -->
<script src="../theme/new/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="../theme/new/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="../theme/new/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="../theme/new/js/chart-custom.js"></script>
<!-- Chart Custom JavaScript -->
<script async src="../theme/new/js/slider.js"></script>

<!-- app JavaScript -->
<script src="../theme/new/js/app.js"></script>

<script src="../theme/new/vendor/moment.min.js"></script>



</body>

</html>