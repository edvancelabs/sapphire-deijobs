<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once( 'includes/head.php'); ?>

    <?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

    <?php endforeach; ?>

    <style type="text/css">
        .site-min-height h1 {
            margin-bottom: 31px;
        }
        .go_back {
            font-weight: 500;
            line-height: 24px;
            font-size: 18px;
            color: #212121;
            margin-bottom: 15px;
            margin-left: -11px;
        }
    </style>
</head>

<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="javascript:void(0);" class="logo"><b></b></a>
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
        <section id="main-content">
            <section class="wrapper site-min-height">
                 <div class="col-md-12 go_back">
                    <div class="icon-holder"><a href="#"  onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</a></div>
                </div>
                <br>
                <h1><?=ucfirst($this->uri->segment(2, 0))?></h1>
                <hr>
                <div class="row mt">
                    <div class="col-lg-12">
                        <?php echo $output; ?>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <?php foreach($js_files as $file){
        // if ($file != 'http://kreaserv-tech.com/mahindra_admin/assets/grocery_crud/themes/bootstrap-v4/js/common/common.min.js') {
    ?>
        <script src="<?php echo $file; ?>"></script>
    <?php } ?>
        <!-- } -->

    <?php include_once( 'includes/site_bottom_scripts.php'); ?>
</body>
 <!-- <?php foreach($js_files as $file): ?>

    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?> -->
</html>