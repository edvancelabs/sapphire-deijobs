<html>
<body>
	<div style="background:#8995db;height:200px;width:500px;padding: 20px;">
		<h3><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></h3>
		<p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
		<br><br>
		<p>
			Ezipik Services <br>
			For queries, contact your POC
		</p> 
	</div>
</body>
</html>