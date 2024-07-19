<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>StickyMobile BootStrap</title>
<link rel="stylesheet" type="text/css" href="http://localhost/buddy/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="http://localhost/buddy/assets/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://localhost/buddy/assets/css/fontawesome-all.min.css">
<link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
</head>

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">
<div class="alert alert-danger fade" role="alert" id="error-msg" style="text-align: center;">
  <strong>You should check in on some of those fields below.</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    <!-- <div class="header header-fixed header-logo-center">
        <a href="index.html" class="header-title">Sticky Mobile</a>
        <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-4"><i class="fas fa-lightbulb"></i></a>
    </div> -->

<!--     <div id="footer-bar" class="footer-bar-1">
        <a href="index.html"><i class="fa fa-home"></i><span>Home</span></a>
        <a href="index-components.html"><i class="fa fa-star"></i><span>Features</span></a>
        <a href="index-pages.html" class="active-nav"><i class="fa fa-heart"></i><span>Pages</span></a>
        <a href="index-search.html"><i class="fa fa-search"></i><span>Search</span></a>
        <a href="#" data-menu="menu-settings"><i class="fa fa-cog"></i><span>Settings</span></a>
    </div> -->

    <div class="page-content header-clear-medium">

        <div class="card card-style">
            <div class="content mt-4 mb-1">
                <h1 class="text-center font-800 font-40 pt-2 mb-1">Sign In</h1>
                <p class="color-highlight text-center font-12 mb-3">Let's get you logged in</p>

                <div class="input-style no-borders has-icon validate-field mb-4">
                    <i class="fa fa-user"></i>
                    <input type="name" class="form-control validate-name user_id" id="form1a" placeholder="Name">
                    <label for="form1a" class="color-blue-dark font-10 mt-1">Name</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>

                <div class="input-style no-borders has-icon validate-field mb-4">
                    <i class="fa fa-lock"></i>
                    <input type="password" class="form-control validate-password password" id="form3a" placeholder="Password">
                    <label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>

                <a href="#" id="login_btn" class="btn btn-m rounded-sm mt-4 mb-4 btn-full bg-green-dark text-uppercase font-900">Login</a>

                <div class="divider"></div>

<!--                 <a href="#" class="btn btn-icon btn-m rounded-sm btn-full shadow-l bg-facebook text-uppercase font-900 text-start"><i class="fab bg-transparent fa-facebook-f text-center"></i>Login with Facebook</a>
                <a href="#" class="btn btn-icon btn-m rounded-sm mt-2 btn-full shadow-l bg-twitter text-uppercase font-900 text-start"><i class="fab bg-transparent fa-twitter text-center"></i>Login with Twitter</a> -->

                <div class="divider mt-4 mb-3"></div>

                <div class="d-flex">
                    <div class="w-50 font-11 pb-2 color-theme opacity-60 pb-3 text-start"><a href="http://localhost/buddy/index.php/home/sign_up/" class="color-theme">Create Account</a></div>
                    <div class="w-50 font-11 pb-2 color-theme opacity-60 pb-3 text-end"><a href="page-forgot-1.html" class="color-theme">Forgot Credentials</a></div>
                </div>
            </div>

        </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/custom.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/common.js"></script></body>
