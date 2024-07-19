<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['pg_env'] = "test";

$config['payu']['test']['status_url'] = "https://test.payu.in/merchant/postservice.php?form=2";
$config['payu']['test']['url'] = "https://test.payu.in/_payment";
$config['payu']['test']['key'] = "eE5XQM";
$config['payu']['test']['salt'] = "FK77sanHUdVZbSbIirKK8kkvKegOhojx";

$config['payu']['prod']['status_url'] = "https://info.payu.in/merchant/postservice.php?form=2";
$config['payu']['prod']['url'] = "https://secure.payu.in/_payment";
$config['payu']['prod']['key'] = "GBAfVw";
$config['payu']['prod']['salt'] = "bbIRmX3gum8bGYIbKbBnLGgmHH7jO8CV";




$config['razorpay']['test']['key'] = "rzp_test_GIvR9HhLYQbCNL";
$config['razorpay']['test']['secret'] = "Z5rdaPi0hJdteR51iufqF28Y";

$config['razorpay']['prod']['key'] = "rzp_live_oodGu7ciHAM0Dd";
$config['razorpay']['prod']['secret'] = "WGZERnKpnpXr06JHdB1eKFhG";


$config['cashfree']['test']['url'] = "https://sandbox.cashfree.com/";
$config['cshfree']['test']['key'] = "599849edc21d81dec42ad668f48995";
$config['cshfree']['test']['secret'] = "315e0c23d1418ea331a40281ed9f560463aab68f";

$config['cashfree']['prod']['url'] = "https://api.cashfree.com/";
$config['cashfree']['prod']['key'] = "10563910723ce4c82191fc7c6c936501";
$config['cashfree']['prod']['secret'] = "9df377705689b10ffecad44581de4474d8c4bc38";






