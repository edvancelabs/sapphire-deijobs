<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('includes/head.php'); 

    ?>
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin/css/dashboard.css"> -->
    <script src="<?=base_url()?>assets/grocery_crud/js/jquery-2.2.4.min.js"></script>

</head>

<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <!-- <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div> -->
            </div>
            <!--logo start-->
            <a href="javascript:void(0);" class="logo"><b class="page-header-logo">Developers</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">

                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?=base_url()?>auth/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </header>
        <!--header end-->

        <!--sidebar start-->
        <aside>
            <?php include_once( 'includes/sidebar.php'); ?>
        </aside>
        <!--sidebar end-->

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height" style="font-family: sans-serif;">        
                <div class="container-fulid p-3 bg-white text-dark">
                    <h4><b>Signature Generation and Validation</b></h4>
                    <p class="f14">CityPay uses checksum signature to ensure that API requests and responses shared between your application and CityPay over network have not been tampered with. We use SHA256 hashing.</p>

                    <h5>Overview of signature generation and validation</h5>
                    <hr class="mt-0">
                    <ul class="f14 list-decimal">
                        <li>Signature is used to authenticate that the requests and responses are coming from the trusted source and the information is not tempered with.</li>
                        <li>You need to generate the signature while sending request for the API</li>
                        <li>
                            For signature generation, the request parameters from the API need to be used as explained in the API document.
                        </li>
                        <li>
                            CityPay checks the signature and parameters in the API request. CityPay processes the API request only if the checksum is valid.
                        </li>
                        <li>Once the transaction is processed, CityPay creates a signaturehash with response parameters and sends it in the callback response along with other parameters.</li>
                        <li>
                            You need to validate the signature in the callback and webhook response. For validating the checksum in the response, use the function as explained in validating the checksum.
                        </li>
                    </ul>

                    <h5>Create Signature</h5>
                    <hr class="mt-0">
                    <p class="f14">You need to create the signature for relevant APIs before sending the request. Please refer to the steps below.</p>

                    <ul>
                        <li>
                            <h6><b>Json Request</b></h6>
                            <p class="f14">In Json post create signature using your account's merchant key and complete request body. In this request body is passed as string.Sample signature code for common languages are mentioned below:</p>

                            

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              
                                <a class="nav-item nav-link active" id="home-tab" data-toggle="tab" href="#home">Php</a>
                            
                                <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#profile">Python</a>
                              
                              
                            </ul>
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane active bg-light p-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <!-- php -->
                                  <code class="text-dark">
                                        <span class="text-muted">/* initialize an array */</span><br>
                                        $post = array();<br>

                                        <span class="text-muted">/* add Request parameters in Array */</span><br>
                                        $post[<span class="text-info">'name'</span>] = <span class="text-info">"gautam khanna"</span>;<br>
                                        $post[<span class="text-info">'email'</span>] = <span class="text-info">"gautam@khanna.com"</span>;<br>
                                        $post[<span class="text-info">'contact'</span>] = <span class="text-info">"9000000000"</span>;<br>
                                        $post[<span class="text-info">'type'</span>] = <span class="text-info">"customer"</span>;<br>
                                        $post[<span class="text-info">'reference_id'</span>] = <span class="text-info">"13123123123123123"</span>;<br>
                                        
                                        <br><span class="text-muted">/**
                                        * Generate checksum by parameters we have<br>
                                        * Find your Merchant Secret in your  Dashboard<br>
                                        */</span>

                                        <br>$string = <span class="text-info">json_encode</span>($post); <span class="text-muted">//encode request array to json</span>
                                        <br>$signature = hash(<span class="text-info">'sha512'</span>, $string.<span class="text-info">'MERCHANT_SECRET'</span>);<br>

                                         <span class="text-muted">/* add This signature to Request parameters in Array */</span><br>                                         
                                         $post[<span class="text-info">'signature'</span>] = $signature;<br>





                                  </code>   

                              </div>
                              <div class="tab-pane bg-light p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <code class="text-dark">
                                    <span class="text-warning">import</span> hashlib
                                    <br><span class="text-warning">import</span> json
                                    <br><br><span class="text-muted"># create request object</span>
                                    <br>reqobj = {
                                            <span class="text-info">"name":"gautam khanna",
                                            "email":"gautam@khanna.com",
                                            "contact":"9000000000",
                                            "type":"customer",
                                            "reference_id":"13123123123123123"</span>
                                        }
                                    <br><br><span class="text-muted"># convert it to string</span>
                                    <br>params = json.dumps(reqobj,separators=(',', ':'))

                                    <br><br><span class="text-muted"># add merchant secret at the end of the string</span>
                                    <br>finalString = <span class="text-info">'%s%s'</span> % (params, <span class="text-info">"MERCHANT_SECRET"</span>)

                                    <br><br><span class="text-muted"># create hash signature of the string using sha512</span>
                                    <br>signature = hashlib.sha512(finalString.encode()).hexdigest()
                                    <br><br><span class="text-muted"># add this signature to the request body and post </span>
                                    <br>reqobj[<span class="text-info">'signature'</span>] = signature
                                </code>
                                  


                              </div>
                            </div>
                        </li>
                    </ul>

                    <h5>Validate Signature</h5>
                    <hr class="mt-0">
                    <p class="f14">Validation of signature is required to be done in the required apis to validate the received response.</p>
                    <ul>
                        <li>
                            <h6><b>Json Response</b></h6>
                            <p class="f14">Sample signature validation code for common languages are mentioned below:</p>

                            

                            <ul class="nav nav-tabs" id="myTab1" role="tablist">
                              
                                <a class="nav-item nav-link active" id="home-tab" data-toggle="tab" href="#home1">Php</a>
                            
                                <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#profile1">Python</a>
                              
                              
                            </ul>
                            <div class="tab-content" id="myTabContent1">
                              <div class="tab-pane active bg-light p-3" id="home1" role="tabpanel" aria-labelledby="home-tab">
                                  <!-- php -->
                                  <code class="text-dark">
                                       <span class="text-muted"># covert json response body to array</span>
                                       <br>$resoponse_array = <span class="text-info">json_decode</span>($response_body);

                                       <br>$signature = $resoponse_array[<span class="text-info">'signature'</span>];

                                       <br><br><span class="text-muted">#unset signature param from resoponse_array</span>
                                       <br>unset($resoponse_array[<span class="text-info">'signature'</span>]);

                                       <br>$string = <span class="text-info">json_encode</span>($resoponse_array);

                                       <br><br><span class="text-muted">#create hash</span>
                                       <br>$hash = hash(<span class="text-info">'sha512'</span>, $string.<span class="text-info">'MERCHANT_SECRET'</span>);

                                       <br><br><span class="text-muted"># match it with signature received in response</span>
                                        <br>if($hash == $signature){
                                        <br>&emsp;<span class="text-primary">return true</span>;
                                        <br>}else{
                                        <br>&emsp;<span class="text-primary">return false</span>;
                                        <br>}

                                  </code>   

                              </div>
                              <div class="tab-pane bg-light p-3" id="profile1" role="tabpanel" aria-labelledby="profile-tab">
                                <code class="text-dark">
                                    <span class="text-warning">import</span> hashlib
                                    <br><span class="text-warning">import</span> json
                                    <br>
                                    <br><span class="text-muted"># convert response body to dictionary</span>
                                    <br>params = json.loads(response_body)
                                    <br>
                                    <br><span class="text-muted"># get signature from response body</span>
                                    <br>signature = params[<span class="text-info">'signature'</span>]
                                    <br>
                                    <br><span class="text-muted"># remove signature param from response body</span>
                                    <br>del params[<span class="text-info">'signature'</span>]

                                    <br>params = json.dumps(params,separators=(<span class="text-info">','</span>, <span class="text-info">':'</span>))
                                    <br>
                                    <br><span class="text-muted"># add merchant secret at the end of the string</span>
                                    <br>finalString = <span class="text-info">'%s%s'</span> % (params, <span class="text-info">"MERCHANT_SECRET"</span>)
                                    <br>
                                    <br><span class="text-muted">#create hash signature of the string using sha512</span>
                                    <br>new_signature = hashlib.sha512(finalString.encode()).hexdigest()
                                    <br><br><span class="text-muted"># match both the signatures</span>
                                    <br>if signature == new_signature:
                                    <br>&emsp;print(<span class="text-info">"match"</span>)
                                    <br>else:
                                    <br>&emsp;print(<span class="text-info">"un match"</span>)
                                </code>
                                  


                              </div>
                            </div>
                        </li>
                    </ul>

                    
                </div>  
             
                


                
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>

    <?php include_once( 'includes/site_bottom_scripts.php'); ?>
    
    <script>
    $('.sidebar-menu li a').removeClass('active');
    $('#menu_developers').addClass('active');
    // $('#myTab a').on('click', function (e) {        
    //   e.preventDefault()
    //   $(this).tab('show')
    // });
  </script>

</body>

</html>