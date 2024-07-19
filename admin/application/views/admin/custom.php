<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('includes/head.php'); ?>


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
        <!--sidebar end-->

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h1 class="page-header"><?=str_replace('_', " ", $this->uri->segment(2, 0))?></h1>
                <hr>
                <div class="row mt">
                    <div class="col-lg-12">

                        <textarea  onkeyup="countChar(this)" style="width:100%;height:200px;" id="sms"></textarea>
                        <div id="charNum"></div>
                        <br>
                        <button id="send">Send SMS</button>
                        

                    </div>
                </div>
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>

        <!-- } -->
  <script src="<?=base_url()?>assets/front/js/jquery.min.js"></script>
    <?php include_once( 'includes/site_bottom_scripts.php'); ?> 

</body>
<script >
    function countChar(val) {
        var len = val.value.length;
        if (len >= 140) {
          val.value = val.value.substring(0, 140);
        } else {
          $('#charNum').text(140 - len);
        }
      };


    $("#send").on("click",function(){
        $.ajax({
            url: '<?=base_url()?>admin/send_sms_to_all',
            type: 'POST',
            
            data: {message: $("#sms").val()},
        })
        .done(function(res) {
            alert(res);
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });
</script>

</html>