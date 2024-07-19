<!DOCTYPE html>
<html lang="en">
<script src="<?=base_url()?>assets/admin/js/jquery.js"></script>
<head>
    <?php include_once('includes/head.php'); ?>
</head>
<style>
    .abc_merchant_secret td{
        position: relative;
    }
    .view_more{
        top: 0;
        position: absolute;
        height: 100%;
        width: 100%;
        background: white;
        left: 0;
    }
    .view_more button{
        width: 100px;        
        height: 25px;
        margin: 8px;
        padding: 0;
    }
</style>
<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
            <!--     <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div> -->
            </div>
            <!--logo start-->
            <a href="javascript:void(0);" class="logo"><b class="page-header-logo">Profile</b></a>
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
            <section class="wrapper site-min-height">

                <div class="container-fluid py-3 bg-offwhite">
                
                    <div class="row mt">
                        <div class="col-sm-6 ">
                            <form action="">
                                <h4><b>Account Profile Details</b></h4>
                            <div class="row">
                            <!-- <div class="card "> -->
                            <!-- <table class="table table-hover  bg-white mb-1">
                                    <tbody> -->
                                        
                                <?php
                                    $i=0;
                                    foreach ($info as $key => $value) {
                                ?>
                                    <div class="col-sm-12 mb-3">
                                        <label for="" class="d-block mb-0 font-weight-normal text-uppercase"><?=$key?></label>
                                        <div class="abc_<?=$key?> position-relative">
                                            <input type="text" class="w-100 bg-cityg p-2 text-black f16" readonly value="<?=$value?>">
                                        </div>
                                    </div>

                                   <!--  <tr class="abc_<?=$key?> ">
                                      <th scope="row" class="text-capitalize"><?=$key?></th>
                                      <td><?=$value?></td>
                                    </tr> -->
                                <?php
                                        if($i == 5){ echo "</div></form></div><div class='col-sm-6'><form action=''><h4><b>Settlement Bank Account Details</b></h4><div class='row'>";}
                                        $i++;
                                    }
                                    
                                ?>
                                  <!-- </tbody>
                                </table> -->
                            <!-- </div> -->
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                  <!--   <div class="col-lg-6">
                        
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Signature Integration Guide</h5>
                            <p>Required to verify request and response from data temperring</p>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card" >
                                        <a href="">
                                      <img class="card-img-top px-3 py-1" src="<?=base_url()?>/assets/admin/img/logo_php.png" alt="Card image cap">
                                      <div class="card-body">
                                        <h5 class="card-title">PHP</h5>   
                                      </div>
                                      </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card" >
                                        <a href="">
                                      <img class="card-img-top px-3 py-1" src="<?=base_url()?>/assets/admin/img/logo_python.png" alt="Card image cap">
                                      <div class="card-body">
                                        <h5 class="card-title">Python</h5>   
                                      </div>
                                      </a>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                          
                    </div>   -->
                </div>
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>

        <!-- } -->
  
    <?php include_once( 'includes/site_bottom_scripts.php'); ?> 

</body>
<script>
    $('.abc_merchant_secret').append('<div class="view_more bg-cityg"><button class="btn btn-primary">view</button></div>');
    $(document).on('click', '.view_more', function(e) {
        e.preventDefault();
        $(this).hide(function() {
            setTimeout(function(){                
                $('.view_more').show();
            },5000);
            
        });
    });
</script>

</html>