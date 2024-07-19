<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('includes/head.php'); ?>
 
    <?php 
    foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
     
    <?php endforeach; ?>
    
    <script src="https://deijobs.in/admin/assets/admin/js/jquery-1.8.3.min.js" > </script>

    <style type="text/css">
        
        #field-desc{
            width: 500px;
            height: 200px;
        }
    </style>


</head>

<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
            
            </div>
            <!--logo start-->
            <a href="javascript:void(0);" class="logo"><b class="page-header-logo">Featured Jobs</b></a>
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
            <?php include_once( 'includes/sidebar_admin.php'); ?>
        </aside>
        <!--sidebar end-->

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
               
                <div class="row mt">
                    <div class="col-lg-12">
    				
    
<form method="POST" action="/admin/admin/saveFJobs">
						<div class="form-group">
            <div class="col-sm-10">
    			<!-- <h4>Featured Job posts</h4> -->
              <input type="text" name="product_name" value="" placeholder="Job Posts" id="input-product" class="form-control" />
              <div id="featured-product" class="well well-sm" style="height: 200px;overflow: auto;padding: 10px;background: #e8e8e8;">
               
				<?php 
            		foreach($jobs as $job){
                 ?>
                <div id="featured-product><?=$job->id?>" style=""><i class="fa fa-minus-circle"></i> <?=$job->job_title?> (<?=$job->city?>)
                  <input type="hidden" name="f_jobs[]" value="<?=$job->id?>" />
                </div>
                <?php } ?>
              </div>
            </div>
                    <div class="col-sm-10">
                    	<input id="form-button-save" type="submit" value="Update changes" class="btn btn-success mt-3">
                    </div>
                    
          </div>
</form>

                    </div>
                </div>
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>

    <?php foreach($js_files as $file){
        // if ($file != 'http://kreaserv-tech.com/mahindra_admin/assets/grocery_crud/themes/bootstrap-v4/js/common/common.min.js') {
    ?>
        <script src="<?php echo $file; ?>"></script>
    <?php } ?>
        <!-- } -->

    <?php include_once( 'includes/site_bottom_scripts.php'); ?> 
</body>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> 
  <script type="text/javascript">
$('input[name=\'product_name\']').autocomplete({
	source: function(request, response) {
    	console.log(request.term);
		$.ajax({
			url: '/admin/admin/searchJobs/' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json.jobs, function(item) {
					return {
						label: item.job_title+" ("+item.city+")",
						value: item.id
					}
				}));
			}
		});
	},
	select: function(event, values) {
    	item = values.item;
		$('input[name=\'product_name\']').val('');
		
		$('#featured-product' + item['value']).remove();
		
		$('#featured-product').append('<div id="featured-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="f_jobs[]" value="' + item['value'] + '" /></div>');	
    	    event.preventDefault();
	}
});
	
$('#featured-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
  $( "#featured-product" ).sortable();
</script>
</html>