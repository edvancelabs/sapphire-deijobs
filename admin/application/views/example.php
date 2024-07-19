<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
</head>
<body>
	<div>
		<a href='<?php echo site_url('admin/user_management')?>'>Users</a> |
		<a href='<?php echo site_url('admin/mentor_management')?>'>Mentor</a> |
		<!-- <a href='<?php echo site_url('admin/user_group_management')?>'>Users Group Management</a> | -->
		<!-- <a href='<?php echo site_url('admin/user_interest_management')?>'>User Interest And Diagnosis</a> | -->
		<a href='<?php echo site_url('admin/subscription')?>'>Subscription</a> |
		<!-- <a href='<?php echo site_url('admin/interest_management')?>'>Interest Type</a> | 
		<a href='<?php echo site_url('admin/diagnosis_management')?>'>Diagnosis Type</a> | -->
		
	</div>
	<div style='height:20px;'></div>  
    <div style="padding: 10px">
		<?php echo $output; ?>
    </div>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
</body>
</html>
