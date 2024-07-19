<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--external css-->
    <link href="<?=base_url()?>assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>assets/admin/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin/css/style-2.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    	.modal-backdrop{background-color: #0000009e;}
    </style>
  </head>

  <body style="background-image: url('<?=base_url()?>assets/images/login-bg.jpeg') !important;background-repeat: no-repeat !important;background-size: cover !important;">

	  <div id="login-page pt-5">
	  	<div class="container pt-5  px-0 d-flex justify-content-sm-start justify-content-center" style="min-height:80vh;">
				
		      	<?php echo form_open('auth/login', array('class' => 'form-login align-self-center')); ?>
		        <h2 class="form-login-heading pb-1 pt-3">
		        	<img src="<?=base_url()?>assets/images/logo.png" style=" width:180px;">
		        	<p class="my-2 text-black mt-3">Login</p>
		        </h2>
		        <div class="login-wrap">
		        	<p><?=$message?></p>
		            <input name="identity" type="text" class="form-control" placeholder="User ID" autofocus>
		            <br>
		            <input name="password" type="password" class="form-control" placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
		                </span>
		            </label>
		            <button class="btn bg-cityg btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            
		         <?=form_close();?>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade1">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                  	<?php echo form_open("auth/forgot_password");?>
		                      <div class="modal-header" style="background: #0d27ff;">
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="identity" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn bg-cityg" type="submit">Submit</button>
		                      </div>
							  <?=form_close();?>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>assets/admin/js/jquery.js"></script>
    <script src="<?=base_url()?>assets/admin/js/bootstrap.min.js"></script>


  </body>
</html>
