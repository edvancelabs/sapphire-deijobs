<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('includes/head.php'); ?>
 
    <?php 
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

    <style type="text/css">
        
        #field-desc{

            width: 500px;
            height: 200px;
        }
        
        #credits_input_box input{
        	width:200px;
        	margin-right:10px;
        }
        
        .delete_me{
        	color:red !important;
        }
        .new_fiels_container{
            margin-bottom: 10px;

        }
        .form-input-box input{
            height: 35px !important;
        }
    </style>


</head>

<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <!-- <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div> -->
            </div>
            <!--logo start-->
            <a href="javascript:void(0);" class="logo"><b class="page-header-logo"></b></a>
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
             
                <div class="row ">
                    <div class="col-lg-12">


                        <?php echo $output; ?>

                    </div>
                </div>
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>    

    <?php include_once( 'includes/site_bottom_scripts.php'); ?> 

</body>

<script>
$(".page-header-logo").text(subject);

</script>

</html>