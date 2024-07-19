<html>
<body>
	<h1>Hi,</h1>
	<p>Your child <?=$user_d->first_name?> has registered on buddy application. we request you to please verify your email id to activate account. <br>
	Click on <a href='<?=base_url()?>auth/parent_verify/<?=$id?>/<?=$user_d->parent_activation_code?>'>this link</a> to verify.</p>	
</body>
</html>