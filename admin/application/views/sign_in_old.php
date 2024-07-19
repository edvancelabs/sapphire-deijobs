<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>Login To Buddy App</title>
<link rel="stylesheet" type="text/css" href="http://localhost/buddy/assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="http://localhost/buddy/assets/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://localhost/buddy/assets/css/fontawesome-all.min.css">
<!-- <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js"> -->
<link rel="apple-touch-icon" sizes="180x180" href="http://localhost/buddy/assets/images/icons/icon-192x192.png">
</head>

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div class="page-content pb-0">

        <div data-card-height="cover" class="card">
            <div class="card-top notch-clear">
                <div class="d-flex">
                    <a href="#" data-back-button class="me-auto icon icon-m"><i class="font-14 fa fa-arrow-left color-theme"></i></a>
                    <a href="#" data-toggle-theme class="show-on-theme-light ms-auto icon icon-m"><i class="font-12 fa fa-moon color-theme"></i></a>
                    <a href="#" data-toggle-theme class="show-on-theme-dark ms-auto icon icon-m"><i class="font-12 fa fa-lightbulb color-yellow-dark"></i></a>
                </div>
            </div>
            <div class="card-center">
                <div class="ps-5 pe-5">
                    <h1 class="text-center font-800 font-40 mb-1">Sign In</h1>
                    <p class="color-highlight text-center font-12">Let's get you logged in</p>

                    <div class="input-style no-borders has-icon validate-field">
                        <i class="fa fa-user"></i>
                        <input type="name" class="form-control validate-name user_id" id="form1a" placeholder="Name">
                        <label for="form1a" class="color-blue-dark font-10 mt-1">Name</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>

                    <div class="input-style no-borders has-icon validate-field mt-4">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control validate-password password" id="form3a" placeholder="Password">
                        <label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(required)</em>
                    </div>

                    <div class="d-flex mt-4 mb-4">
                        <div class="w-50 font-11 pb-2 text-start"><a href="http://localhost/buddy/index.php/home/sign_up/">Create Account</a></div>
                        <div class="w-50 font-11 pb-2 text-end"><a href="page-forgot-2.html">Forgot Credentials</a></div>
                    </div>

                    <a href="#" id="login_btn" class="back-button btn btn-full btn-m shadow-large rounded-sm text-uppercase font-700 bg-highlight">LOGIN</a>
                    <!-- <div class="divider mt-4"></div>
                    <a href="#" class="btn btn-icon btn-m btn-full shadow-l rounded-sm bg-facebook text-uppercase font-700 text-start"><i class="fab fa-facebook-f text-center bg-transparent"></i>Sign in with Facebook</a>
                    <a href="#" class="btn btn-icon btn-m btn-full shadow-l rounded-sm bg-twitter text-uppercase font-700 text-start mt-2 "><i class="fab fa-twitter text-center bg-transparent"></i>Sign in with Twitter</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/custom.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/common.js"></script>

</body>
