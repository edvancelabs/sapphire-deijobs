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
<link rel="apple-touch-icon" sizes="180x180" href="http://localhost/buddy/assets/images/icons/icon-192x192.png">
</head>

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">
<?php print_r($all_data) ?>
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div class="page-content header-clear-medium">

        <div class="card card-style">
            <div class="content mb-0">
                <h1 class="text-center font-800 font-40 mb-1 pt-2">Sign Up</h1>
                <p class="color-highlight text-center font-12">Create an Account. It's free!</p>

                <div class="input-style no-borders has-icon validate-field">
                    <i class="fa fa-user"></i>
                    <input type="name" class="form-control validate-name" id="form1a" placeholder="Name">
                    <label for="form1a" class="color-blue-dark font-10 mt-1">Name</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>
                <div class="input-style no-borders has-icon validate-field mt-2">
                    <i class="fa fa-at"></i>
                    <input type="email" class="form-control validate-email" id="form1aa" placeholder="Email">
                    <label for="form1aa" class="color-blue-dark font-10 mt-1">Email</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>
                <div class="input-style no-borders has-icon validate-field mt-2">
                    <i class="fa fa-lock"></i>
                    <input type="password" class="form-control validate-password" id="form3a" placeholder="Choose a Password">
                    <label for="form3a" class="color-blue-dark font-10 mt-1">Choose a Password</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>
                <div class="input-style no-borders has-icon validate-field mt-2">
                    <i class="fa fa-lock"></i>
                    <input type="password" class="form-control validate-password" id="form3a1" placeholder="Confirm your Password">
                    <label for="form3a1" class="color-blue-dark font-10 mt-1">Confirm your Password</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>

                <a href="page-signup-1.html" class="btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-900 mt-4">Create account</a>

                <div class="divider"></div>

                <p class="text-center">
                    <a href="/buddy/" class="color-theme opacity-50 font-12">Already Registered? Sign in Here</a>
                </p>

            </div>
        </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/custom.js"></script>
<script type="text/javascript" src="http://localhost/buddy/assets/js/common.js"></script>
</body>
