<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-03-30 19:00:27 --> 404 Page Not Found: Developers/index
ERROR - 2023-03-30 19:00:31 --> 404 Page Not Found: Appapi/index
ERROR - 2023-03-30 19:00:36 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:00:40 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:00:47 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:00:50 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:01:19 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:01:49 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:01:52 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:02:01 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-30 19:02:24 --> order req: {
    "txnid": "txn_LE0000CC0010",
    "amount": 2.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "4506fc68b7df579796fca079ce6145d4ee87608a8b21c422904bc6021f213599d5ccc7b14692f0377d4b27bbf763f1b72d4e65664261d2da498493f2dc976f7a"
}
ERROR - 2023-03-30 19:02:24 --> EaseBuzz res payment/initiateLink : {"status": 0, "error_desc": "Invalid value for furl.Invalid value for surl.Invalid value for key.Invalid merchant key.", "data": "Parameter validation failed"}
ERROR - 2023-03-30 19:02:24 --> Order res: {"code":801,"error":"Invalid value for furl.Invalid value for surl.Invalid value for key.Invalid merchant key.","message":"Invalid requests params","signature":"537d93f2d02ede5c769b8ca6408620ff8f90dd6dc9054f35d7cd7f3a3e67cda951ccbf30791514fbf87b2a292a6cd2f6a32e277d7149190879bfb173df82a492"}
ERROR - 2023-03-30 19:04:42 --> order req: {
    "txnid": "txn_LE0000CC0010",
    "amount": 2.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "4506fc68b7df579796fca079ce6145d4ee87608a8b21c422904bc6021f213599d5ccc7b14692f0377d4b27bbf763f1b72d4e65664261d2da498493f2dc976f7a"
}
ERROR - 2023-03-30 19:04:43 --> EaseBuzz res payment/initiateLink : {"status": 1, "data": "a87193ec8485d58a0164d446ca38c0aeda5f7c3d9cd8e5e3fbb83621029f5e0a"}
ERROR - 2023-03-30 19:04:43 --> Order res: {"code":200,"txnid":"txn_LE0000CC0010","status":"success","message":"Success","signature":"e61d338c29c75d724ec41298fab4543ccf7c77e630b54366149875793930c9c95c14b416ffde6cc893d104efdabbf485ce4027e53bc89721df39391f15b1d352"}

ERROR - 2023-03-30 19:11:40 --> EaseBuzz res https://pay.easebuzz.in/initiate_seamless_payment/ : 
ERROR - 2023-03-30 19:12:06 --> EaseBuzz res https://testpay.easebuzz.in/initiate_seamless_payment/ : 
ERROR - 2023-03-30 19:15:32 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-03-30 19:16:25 --> EaseBuzz res initiate_seamless_payment/ : 






ERROR - 2023-03-30 19:17:48 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-03-30 19:18:05 --> EaseBuzz res initiate_seamless_payment : <!DOCTYPE html>


<html>
    <head>
        <link rel="icon" type="image/png"  href="/static/gateway/favicon/eb-favicon.png">

        
<title>Pay with Easebuzz</title>


        
<link rel="stylesheet" href="/static/gateway/css/semantic.min.css">

<link rel="stylesheet" href="/static/gateway/css/base_colors.css">
<!--
<link rel="stylesheet" href="/static/gateway/css/button.min.css">
<link rel="stylesheet" href="/static/gateway/css/dropdown.min.css">
<link rel="stylesheet" href="/static/gateway/css/input.min.css">
<link rel="stylesheet" href="/static/gateway/css/menu.min.css">-->


        <link rel="stylesheet" href="/static/gateway/css/base_colors.css">
        <link rel="stylesheet" href="/static/gateway/css/font-awesome.min.css">
        <style>
            .hidden.menu {
                display: none;
            }

            .masthead.segment {
                min-height: 500px;
                padding: 2%;
            }
            .masthead .logo.item img {
                margin-right: 1em;
            }
            .masthead .ui.menu .ui.button {
                margin-left: 0.5em;
            }
            .masthead h1.ui.header {
                margin-top: 3em;
                margin-bottom: 0em;
                font-size: 4em;
                font-weight: normal;
            }
            .masthead h2 {
                font-size: 1.7em;
                font-weight: normal;
            }
            @media only screen and (max-width: 700px) {
                .ui.fixed.menu {
                    display: none !important;
                }
                .secondary.pointing.menu .item,
                .secondary.pointing.menu .menu {
                    display: none;
                }
                .secondary.pointing.menu .toc.item {
                    display: block;
                }
                .masthead.segment {
                    min-height: 350px;
                }
                .masthead h1.ui.header {
                    font-size: 2em;
                    margin-top: 1.5em;
                }
                .masthead h2 {
                    margin-top: 0.5em;
                    font-size: 1.5em;
                }
            }
        </style>
        
<style type="text/css">
            header{
                position: absolute;
                height: 50px;
                width: 100%;
                z-index: 999;
            }
            .customNav{
                background-color: rgba(1, 1, 15, 0);
                box-shadow: none;
            }
            @media only screen and (min-width: 500px) {
                .minheightmedia {
                    min-height:500px;
                }
            }
        </style>
    <div class="ui secondary pointing menu" style="margin:0%;padding-left:20px;padding-right:20px;background: #F5F5F5 !important;">
        <a class="item" href="https://pay.easebuzz.in">
            <img src="/static/gateway/images/easebuzz_logo.png" style="width:100px;">
        </a>

    </div>

        

        


    </head>

    <body>
        <div class="minheightmedia" >
            <div class="row">

                
<style>
    .errorheader{
        font-size:7em;
        font-weight:500;
        padding-top:6% !important;
    }
    .errorsecondline
    {
        font-size:4em;
    }
</style>


<div class="container">
    <div align="center">
        <h1 class="errorheader primary-font">4<span class="secondary-font">0</span>4</h1>
        <h2 class="errorsecondline">Page Not Found.</h2>
        <h3>The page you were looking for does not exist.</h3>
        <h5>For any queries please contact +91 9765643995</h5>
    </div>
</div>



            </div>
        </div>
        <!--
<footer>
    <div class="ui inverted vertical primary-bg footer segment">
        <div class="ui container">
            <div class="ui stackable inverted divided equal height stackable grid">


                <div class="sixteen wide column aligned center floated " align="center">
                    <a href="https://crossbowlabs.com/certificates/SRV2361610308NMDEZBWEB" target="_blank"> <img src="/static/gateway/images/certificates/pcidss.png" style="display: inline-block;height: 50px;margin: 0px 15px 0px 0px;" class="img-responsive" alt=""></a>
                    <img src="/static/gateway/images/certificates/comodo-secure-icon.png" style="display: inline-block;height: 50px;margin: 0px 0px 0px 15px;" class="img-responsive" alt="">
                </div>
            </div>
        </div>
    </div>
</footer>-->
        
<script src="/static/gateway/js/jquery-2.2.0.min.js"></script>
<script src="/static/gateway/js/semantic.min.js"></script>
<script src="/static/gateway/js/angular.js"></script>
<script src="/static/gateway/js/jquery.payment.js"></script>






        

        
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67009256-1', 'auto');
  ga('send', 'pageview');

</script>
    </body>

</html>
ERROR - 2023-03-30 19:18:05 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 132
ERROR - 2023-03-30 19:38:36 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-03-30 19:45:02 --> order req: {
    "txnid": "txn_LE0000CC0011",
    "amount": 2.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "1c0f9f00a45f7c60178e75c0d18b8612ab2d919ed9e9d28a091052ca6e3962ff5d9c8b51ec3c641d1aac1826699716ed9e4160881cd5df52c887861856bbdea9"
}
ERROR - 2023-03-30 19:45:03 --> EaseBuzz res payment/initiateLink : {"status": 1, "data": "c40ec34c4edf78755a1f598f8cf8eb72a3bca97f6eef35e0298de8d70b692d7b"}
ERROR - 2023-03-30 19:45:03 --> Order res: {"code":200,"txnid":"txn_LE0000CC0011","status":"success","message":"Success","signature":"9ca62d2224bcc8e3931dfd0d98d2c67c2cbf3819db214aea37ffd685d4e48f1bd1290439f696750a5a01c720ab5ae8c65736020184ab173627ebb20818dc3b03"}
