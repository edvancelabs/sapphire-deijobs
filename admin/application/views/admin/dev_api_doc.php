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
                    <!-- <iframe src="<?=$page?>" frameborder="0" class="w-100" style="height:90vh"></iframe> -->
                    <?php include_once($page); ?>

                    
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